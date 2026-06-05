<?php

namespace App\Services;

use App\Models\BusinessLicenseModel;
use App\Models\ApplicationModel;
use App\Models\ApplicationDataModel;
use App\Models\NotificationModel;
use App\Models\ServiceModel;
use Exception;

class BusinessLicenseService
{
    protected $licenseModel;
    protected $applicationModel;
    protected $dataModel;
    protected $notificationModel;
    protected $serviceModel;

    public function __construct()
    {
        $this->licenseModel = new BusinessLicenseModel();
        $this->applicationModel = new ApplicationModel();
        $this->dataModel = new ApplicationDataModel();
        $this->notificationModel = new NotificationModel();
        $this->serviceModel = new ServiceModel();
    }

    /**
     * Create a new business license application
     * This is called when a user submits the business license form
     */
    public function createApplication($formData, $files = null)
    {
        // Validate required fields
        $this->validateApplicationData($formData);

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // 1. Create the main application record
            $applicationId = $this->applicationModel->insert([
                'service_key' => 'business_license',
                'status' => 'submitted',
                'priority' => 'normal'
            ]);

            if (!$applicationId) {
                throw new Exception('Failed to create application record');
            }

            $application = $this->applicationModel->find($applicationId);

            // 2. Extract and save applicant information
            $applicantInfo = [
                'name' => ($formData['firstname'] ?? '') . ' ' . ($formData['lastname'] ?? ''),
                'email' => $formData['email'] ?? '',
                'phone' => $formData['contact'] ?? '',
                'id_type' => $formData['id_type'] ?? '',
                'id_number' => $formData['id_number'] ?? '',
                'dob' => $formData['dob'] ?? '',
                'gender' => $formData['gender'] ?? '',
                'submitted_at' => date('Y-m-d H:i:s')
            ];
            $this->dataModel->saveData($applicationId, 'applicant_info', $applicantInfo);

            // 3. Extract and save business information
            $businessInfo = [
                'business_name' => $formData['business_name'] ?? '',
                'business_type' => $formData['business_type'] ?? '',
                'market' => $formData['market'] ?? '',
                'code' => $formData['code'] ?? '',
                'registering_date' => $formData['registering_date'] ?? '',
                'payment_method' => $formData['payment_method'] ?? '',
            ];
            $this->dataModel->saveData($applicationId, 'business_info', $businessInfo);

            // 4. Create business license record
            $locationType = $this->extractLocationType($formData['business_type'] ?? '');
            $businessCategory = $this->extractBusinessCategory($formData['business_type'] ?? '');
            
            $licenseData = [
                'application_id' => $applicationId,
                'business_name' => $formData['business_name'] ?? '',
                'business_type' => $formData['business_type'] ?? '',
                'business_category' => $businessCategory,
                'market' => $formData['market'] ?? '',
                'code' => $formData['code'] ?? '',
                'registration_date' => $formData['registering_date'] ?? date('Y-m-d'),
                'location_type' => $locationType,
                'owner_name' => $applicantInfo['name'],
                'owner_id_type' => $formData['id_type'] ?? '',
                'owner_id_number' => $formData['id_number'] ?? '',
                'owner_phone' => $formData['contact'] ?? '',
                'owner_email' => $formData['email'] ?? '',
                'status' => 'pending',
                'is_renewal' => 0,
                'inspection_required' => $this->requiresInspection($formData['business_type'] ?? ''),
            ];

            // Get fee amount from service configuration
            $service = $this->serviceModel->getByKey('business_license');
            if ($service) {
                $licenseData['fee_amount'] = $service['fee_amount'];
            }

            $licenseId = $this->licenseModel->insert($licenseData);

            if (!$licenseId) {
                throw new Exception('Failed to create business license record');
            }

            // 5. Handle file uploads
            if ($files) {
                $this->handleFileUploads($applicationId, $files, $application['reference_number']);
            }

            // 6. Auto-assign to finance department
            $this->autoAssignApplication($applicationId);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new Exception('Database transaction failed');
            }

            return [
                'success' => true,
                'application_id' => $applicationId,
                'license_id' => $licenseId,
                'reference_number' => $application['reference_number']
            ];

        } catch (Exception $e) {
            $db->transRollback();
            throw $e;
        }
    }

    /**
     * Validate application data
     */
    protected function validateApplicationData($formData)
    {
        $errors = [];

        // Personal details validation
        if (empty($formData['firstname'])) {
            $errors[] = 'First name is required';
        }
        if (empty($formData['lastname'])) {
            $errors[] = 'Last name is required';
        }
        if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }
        if (empty($formData['contact'])) {
            $errors[] = 'Contact number is required';
        }
        if (empty($formData['id_number'])) {
            $errors[] = 'ID number is required';
        }

        // Business details validation
        if (empty($formData['business_name'])) {
            $errors[] = 'Business name is required';
        }
        if (empty($formData['business_type'])) {
            $errors[] = 'Business type is required';
        }
        if (empty($formData['market'])) {
            $errors[] = 'Market selection is required';
        }
        if (empty($formData['registering_date'])) {
            $errors[] = 'Registration date is required';
        }

        if (!empty($errors)) {
            throw new Exception('Validation failed: ' . implode(', ', $errors));
        }
    }

    /**
     * Extract location type from business type string
     */
    protected function extractLocationType($businessType)
    {
        if (strpos($businessType, '(Rural)') !== false) {
            return 'Rural';
        } elseif (strpos($businessType, '(Peri-Urban)') !== false) {
            return 'Peri-Urban';
        }
        return 'Urban';
    }

    /**
     * Extract business category from business type
     */
    protected function extractBusinessCategory($businessType)
    {
        $categories = [
            'Agriculture / Food' => ['Butcher', 'Fish Den', 'Groceries', 'Restaurant', 'Tea Room'],
            'Education / Health' => ['School', 'Hospital', 'Pharmacy', 'Drug Shop'],
            'Manufacturing / Industrial' => ['Manufacturing', 'Factory', 'Welding', 'Carpentry', 'Coffin', 'Cement Blocks'],
            'Retail / Shops' => ['Retail', 'Wholesaler', 'Supermarket', 'Boutique', 'Stationery', 'Hardware', 'Filling Station'],
            'Transport / Mobile' => ['Kabaza', 'Motorcycle', 'Bicycle', 'Transport', 'Logistics', 'Mobile Retailing', 'Van'],
            'ICT / Financial' => ['Mobile Money', 'Computer Cafe', 'Phone Repair', 'Telephone Bureau', 'Banks'],
            'Energy / Utilities' => ['LPG', 'Battery Charging'],
            'Hospitality / Recreation' => ['Lodge', 'Rest House', 'Liquor', 'Gaming', 'Pool Table', 'Recreational'],
            'Construction / Services' => ['Maize Mill', 'Burning Centre', 'Tyre Fitter', 'Watch Repair', 'Tailoring', 'Barbershop'],
            'Mining' => ['Mining'],
            'Other' => ['Herbalist', 'Cooperatives', 'VSL', 'Studio', 'Seasonal', 'Warehousing', 'Cold Storage', 'Cobra'],
        ];

        foreach ($categories as $category => $keywords) {
            foreach ($keywords as $keyword) {
                if (stripos($businessType, $keyword) !== false) {
                    return $category;
                }
            }
        }

        return 'Other';
    }

    /**
     * Check if business type requires inspection
     */
    protected function requiresInspection($businessType)
    {
        $requiresInspection = [
            'Butcher', 'Restaurant', 'Tea Room', 'Hospital', 'Pharmacy', 'Drug Shop',
            'Liquor', 'Lodge', 'Rest House', 'Manufacturing', 'Factory', 'LPG',
            'School', 'Supermarket', 'Banks'
        ];

        foreach ($requiresInspection as $keyword) {
            if (stripos($businessType, $keyword) !== false) {
                return 1;
            }
        }

        return 0;
    }

    /**
     * Handle file uploads
     */
    protected function handleFileUploads($applicationId, $files, $referenceNumber)
    {
        $uploadPath = WRITEPATH . 'uploads/applications/' . $referenceNumber;
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $docModel = new \App\Models\ApplicationDocumentModel();

        foreach ($files as $key => $fileArray) {
            if (!is_array($fileArray)) {
                $fileArray = [$fileArray];
            }

            foreach ($fileArray as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    
                    if ($file->move($uploadPath, $newName)) {
                        $docModel->insert([
                            'application_id' => $applicationId,
                            'document_type' => $key,
                            'file_name' => $file->getClientName(),
                            'file_path' => 'uploads/applications/' . $referenceNumber . '/' . $newName,
                            'file_size' => $file->getSize(),
                            'mime_type' => $file->getClientMimeType(),
                            'uploaded_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Auto-assign application to appropriate department
     */
    protected function autoAssignApplication($applicationId)
    {
        $assignmentModel = new \App\Models\ServiceAssignmentModel();
        $primaryAssignee = $assignmentModel->getPrimaryAssignee('business_license');
        
        if ($primaryAssignee) {
            $this->applicationModel->update($applicationId, [
                'assigned_to' => $primaryAssignee['assigned_user_id']
            ]);

            $this->notificationModel->notifyAssignment($applicationId, $primaryAssignee['assigned_user_id']);
        }
    }

    /**
     * Get business license by application ID
     */
    public function getLicenseByApplicationId($applicationId)
    {
        return $this->licenseModel->getWithApplicationDetails($applicationId);
    }

    /**
     * Update license status
     */
    public function updateLicenseStatus($applicationId, $status, $notes = null, $userId = null)
    {
        $license = $this->licenseModel->getByApplicationId($applicationId);
        
        if (!$license) {
            throw new Exception('Business license not found');
        }

        // Update license status
        $this->licenseModel->updateLicenseStatus($license['id'], $status, $notes);

        // Update application status
        $this->applicationModel->updateStatus($applicationId, $status, $notes);

        // Send notifications
        $this->notificationModel->notifyStatusChange($applicationId, $license['status'], $status);

        // If approved, generate license certificate
        if ($status === 'approved') {
            $this->generateLicenseCertificate($applicationId);
        }

        return true;
    }

    /**
     * Generate license certificate (placeholder for PDF generation)
     */
    protected function generateLicenseCertificate($applicationId)
    {
        $license = $this->licenseModel->getByApplicationId($applicationId);
        
        if ($license && $license['license_number']) {
            // Here you would generate a PDF certificate
            // For now, we'll just log that a certificate should be generated
            log_message('info', "Business License Certificate should be generated for: {$license['license_number']}");
        }
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        return $this->licenseModel->getDashboardStats();
    }

    /**
     * Search business licenses
     */
    public function searchLicenses($query, $limit = 50, $offset = 0)
    {
        return $this->licenseModel->search($query, $limit, $offset);
    }

    /**
     * Get business type statistics
     */
    public function getBusinessTypeStats()
    {
        return $this->licenseModel->getBusinessTypeStats();
    }

    /**
     * Get market statistics
     */
    public function getMarketStats()
    {
        return $this->licenseModel->getMarketStats();
    }

    /**
     * Get licenses expiring soon
     */
    public function getExpiringLicenses($days = 30)
    {
        return $this->licenseModel->getExpiringSoon($days);
    }

    /**
     * Process license renewal
     */
    public function renewLicense($previousLicenseNumber, $formData)
    {
        // Find the previous license
        $previousLicense = $this->licenseModel
            ->where('license_number', $previousLicenseNumber)
            ->first();

        if (!$previousLicense) {
            throw new Exception('Previous license not found');
        }

        if ($previousLicense['status'] !== 'approved') {
            throw new Exception('Previous license must be approved to renew');
        }

        // Create new application for renewal
        $formData['is_renewal'] = 1;
        $formData['previous_license_number'] = $previousLicenseNumber;

        return $this->createApplication($formData);
    }
}