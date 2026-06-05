<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'reference_number',
        'service_key',
        'status',
        'priority',
        'assigned_to',
        'submitted_at',
        'review_started_at',
        'approved_at',
        'completed_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'service_key' => 'required|max_length[100]',
        'status'      => 'required|in_list[draft,submitted,under_review,approved,rejected,completed,cancelled]',
        'priority'    => 'required|in_list[low,normal,high,urgent]'
    ];

    // Callbacks
    protected $beforeInsert = ['generateReferenceNumber'];
    protected $afterInsert  = ['logStatusChange'];
    protected $afterUpdate  = ['logStatusChange'];

    /**
     * Generate unique reference number for application
     */
    protected function generateReferenceNumber(array $data)
    {
        if (!isset($data['data']['reference_number'])) {
            $prefix = strtoupper(substr($data['data']['service_key'] ?? 'APP', 0, 3));
            $timestamp = date('YmdHis');
            $random = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $data['data']['reference_number'] = "{$prefix}-{$timestamp}-{$random}";
        }
        return $data;
    }

    /**
     * Log status changes
     */
    protected function logStatusChange(array $data)
    {
        if (isset($data['data']['status']) && isset($data['id'])) {
            $statusLogModel = new ApplicationStatusLogModel();

            $applicationId = is_array($data['id']) ? ($data['id'][0] ?? null) : $data['id'];
            if (!$applicationId) {
                return $data;
            }

            // Get old status if updating
            $oldStatus = null;
            if (isset($data['result']) && $data['result']) {
                $oldApp = $this->find($applicationId);
                $oldStatus = $oldApp['status'] ?? null;
            }

            $statusLogModel->insert([
                'application_id' => $applicationId,
                'old_status'     => $oldStatus,
                'new_status'     => $data['data']['status'],
                'changed_by'     => session()->get('user_id') ?? null,
                'notes'          => 'Status updated via system'
            ]);
        }
        return $data;
    }

    /**
     * Get application with all related data
     */
    public function getWithDetails($id)
    {
        $application = $this->find($id);
        if (!$application) {
            return null;
        }

        // Get application data
        $dataModel = new ApplicationDataModel();
        $application['application_data'] = $dataModel->where('application_id', $id)->findAll();

        // Get documents
        $documentModel = new ApplicationDocumentModel();
        $application['documents'] = $documentModel->where('application_id', $id)->findAll();

        // Get status log
        $statusLogModel = new ApplicationStatusLogModel();
        $application['status_history'] = $statusLogModel->where('application_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Get service info
        $serviceModel = new ServiceModel();
        $application['service'] = $serviceModel->where('service_key', $application['service_key'])->first();

        // Get assigned user info
        if ($application['assigned_to']) {
            $userModel = new \App\Models\UserModel();
            $application['assigned_user'] = $userModel->find($application['assigned_to']);
        }

        return $application;
    }

    /**
     * Get application with documents, data and history
     */
    public function getWithDocuments($id)
    {
        return $this->getWithDetails($id);
    }

    /**
     * Get applications for a user by applicant email
     */
    public function getUserApplications($email)
    {
        return $this->select('applications.*')
                    ->join('application_data', 'application_data.application_id = applications.id')
                    ->where('application_data.data_type', 'applicant_info')
                    ->where('application_data.data_key', 'email')
                    ->where('application_data.data_value', $email)
                    ->groupBy('applications.id')
                    ->orderBy('applications.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get applications by status
     */
    public function getByStatus($status, $limit = 50, $offset = 0)
    {
        return $this->where('status', $status)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get applications assigned to user
     */
    public function getAssignedToUser($userId, $limit = 50, $offset = 0)
    {
        return $this->where('assigned_to', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get applications by service
     */
    public function getByService($serviceKey, $limit = 50, $offset = 0)
    {
        return $this->where('service_key', $serviceKey)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Update application status
     */
    public function updateStatus($id, $status, $notes = null)
    {
        $data = ['status' => $status];

        // Set timestamps based on status
        switch ($status) {
            case 'submitted':
                $data['submitted_at'] = date('Y-m-d H:i:s');
                break;
            case 'under_review':
                $data['review_started_at'] = date('Y-m-d H:i:s');
                break;
            case 'approved':
                $data['approved_at'] = date('Y-m-d H:i:s');
                break;
            case 'completed':
                $data['completed_at'] = date('Y-m-d H:i:s');
                break;
        }

        return $this->update($id, $data);
    }

    /**
     * Assign application to user
     */
    public function assignToUser($id, $userId)
    {
        return $this->update($id, ['assigned_to' => $userId]);
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        $stats = [];

        // Count by status
        $statusCounts = $this->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        foreach ($statusCounts as $stat) {
            $stats['status_' . $stat['status']] = $stat['count'];
        }

        // Total applications
        $stats['total'] = $this->countAll();

        // Recent applications (last 30 days)
        $stats['recent'] = $this->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->countAllResults();

        return $stats;
    }

    /**
     * Retrieves all applications with consolidated applicant details 
     * and service types compiled from EAV data keys.
     * * @return array
     */
    public function getDetailedApplicationsList()
    {
        // 1. Fetch applications sorted by newest submission
        $applications = $this->orderBy('created_at', 'DESC')->findAll();
        if (empty($applications)) {
            return [];
        }

        $compiled = [];
        $dataModel = new ApplicationDataModel();

        // 2. Map structural base information from applications table
        foreach ($applications as $app) {
            $appId = $app['id'];
            $compiled[$appId] = [
                'id'                    => $appId,
                'application_reference' => $app['reference_number'] ?? '—',
                'first_name'            => '',
                'last_name'             => '',
                'email'                 => '—',
                'service_name'          => $app['service_key'] ?? 'General Service',
                'status'                => $app['status'] ?? 'pending',
                'created_at'            => $app['created_at']
            ];
        }

        // 3. Query the EAV data rows tied to these applications
        $appIds = array_keys($compiled);
        $eavRows = $dataModel->whereIn('application_id', $appIds)->findAll();

        // 4. Overwrite defaults with explicitly defined EAV variables
        foreach ($eavRows as $row) {
            $appId = $row['application_id'];
            $key = $row['data_key'];
            $value = $row['data_value'];

            // Auto-decode values if they are arrays stored as JSON string arrays
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $value = $decoded;
            }

            if ($key === 'first_name') {
                $compiled[$appId]['first_name'] = $value;
            } elseif ($key === 'last_name') {
                $compiled[$appId]['last_name'] = $value;
            } elseif ($key === 'email') {
                $compiled[$appId]['email'] = $value;
            } elseif ($key === 'service_type' || $key === 'service_name') {
                $compiled[$appId]['service_name'] = $value;
            }
        }

        return array_values($compiled);
    }

    /**
     * Get statistics
     */
    public function getStatistics()
    {
        $db = \Config\Database::connect();
        
        // Count applications where payment_method was submitted or recorded in application_data EAV table
        $pendingPaymentCount = $db->table('application_data')
            ->where('data_key', 'payment_method')
            ->where('data_value', 'airtel_money')
            ->countAllResults();

        return [
            'total'           => $this->countAll(),
            'submitted'       => $this->where('status', 'submitted')->countAllResults(),
            'under_review'    => $this->where('status', 'under_review')->countAllResults(),
            'approved'        => $this->where('status', 'approved')->countAllResults(),
            'completed'       => $this->where('status', 'completed')->countAllResults(),
            'pending_payment' => $pendingPaymentCount,
        ];
    }
}