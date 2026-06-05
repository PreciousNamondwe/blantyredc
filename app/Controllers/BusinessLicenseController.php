<?php

namespace App\Controllers;

use App\Services\BusinessLicenseService;
use App\Models\BusinessLicenseModel;
use App\Models\ApplicationModel;
use App\Models\BusinessTypeModel;
use CodeIgniter\API\ResponseTrait;

class BusinessLicenseController extends BaseController
{
    use ResponseTrait;

    protected $licenseService;
    protected $licenseModel;
    protected $applicationModel;

    public function __construct()
    {
        $this->licenseService = new BusinessLicenseService();
        $this->licenseModel = new BusinessLicenseModel();
        $this->applicationModel = new ApplicationModel();
    }

    /**
     * Display business license application form
     * GET /business-license
     */
    public function index()
    {
        $businessTypeModel = new BusinessTypeModel();
        return view('business-license/index', [
            'businessTypes' => $businessTypeModel->getActiveTypes(),
        ]);
    }

    /**
     * Submit business license application
     * POST /api/business-license/submit
     */
    public function submit()
    {
        // Get form data
        $formData = $this->request->getPost();
        
        // Get uploaded files
        $files = $this->request->getFiles();

        try {
            $result = $this->licenseService->createApplication($formData, $files);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Business license application submitted successfully',
                'reference' => $result['reference_number'],
                'data' => [
                    'application_id' => $result['application_id'],
                    'license_id' => $result['license_id']
                ]
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Get business license by application ID
     * GET /api/business-license/:applicationId
     */
    public function getLicense($applicationId)
    {
        try {
            $license = $this->licenseService->getLicenseByApplicationId($applicationId);

            if (!$license) {
                return $this->failNotFound('Business license not found');
            }

            return $this->respond($license);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Update business license status (Admin only)
     * POST /api/business-license/:id/status
     */
    public function updateStatus($id)
    {
        // Check if user is admin
        if (!session()->get('role') === 'admin') {
            return $this->failForbidden('Insufficient permissions');
        }

        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');
        $userId = session()->get('user_id');

        if (!$status) {
            return $this->failValidationErrors(['status' => 'Status is required']);
        }

        try {
            $this->licenseService->updateLicenseStatus($id, $status, $notes, $userId);

            return $this->respond([
                'status' => 'success',
                'message' => 'Business license status updated successfully'
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Search business licenses
     * GET /api/business-license/search?q=query
     */
    public function search()
    {
        $query = $this->request->getGet('q');
        $limit = $this->request->getGet('limit') ?? 50;
        $offset = $this->request->getGet('offset') ?? 0;

        if (!$query) {
            return $this->failValidationErrors(['q' => 'Search query is required']);
        }

        try {
            $licenses = $this->licenseService->searchLicenses($query, $limit, $offset);

            return $this->respond([
                'status' => 'success',
                'data' => $licenses,
                'count' => count($licenses)
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Get business license statistics (Admin dashboard)
     * GET /api/business-license/stats
     */
    public function stats()
    {
        try {
            $stats = $this->licenseService->getDashboardStats();
            $businessTypes = $this->licenseService->getBusinessTypeStats();
            $markets = $this->licenseService->getMarketStats();
            $expiringSoon = $this->licenseService->getExpiringLicenses(30);

            return $this->respond([
                'status' => 'success',
                'data' => [
                    'overview' => $stats,
                    'business_types' => $businessTypes,
                    'markets' => $markets,
                    'expiring_soon' => count($expiringSoon),
                    'expiring_licenses' => $expiringSoon
                ]
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Get licenses expiring soon (Admin dashboard widget)
     * GET /api/business-license/expiring
     */
    public function expiring()
    {
        $days = $this->request->getGet('days') ?? 30;

        try {
            $licenses = $this->licenseService->getExpiringLicenses($days);

            return $this->respond([
                'status' => 'success',
                'data' => $licenses,
                'count' => count($licenses)
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }

    /**
     * Process license renewal
     * POST /api/business-license/renew
     */
    public function renew()
    {
        $previousLicenseNumber = $this->request->getPost('previous_license_number');
        $formData = $this->request->getPost();

        if (!$previousLicenseNumber) {
            return $this->failValidationErrors(['previous_license_number' => 'Previous license number is required']);
        }

        try {
            $result = $this->licenseService->renewLicense($previousLicenseNumber, $formData);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Business license renewal application submitted successfully',
                'reference' => $result['reference_number']
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 400);
        }
    }
}