<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;
use App\Models\ApplicationDataModel;
use App\Models\ServiceModel;
use App\Models\ServiceAssignmentModel;
use App\Models\NotificationModel;
use CodeIgniter\API\ResponseTrait;

class ApplicationController extends BaseController
{
    use ResponseTrait;

    protected $applicationModel;
    protected $dataModel;
    protected $serviceModel;
    protected $assignmentModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
        $this->dataModel = new ApplicationDataModel();
        $this->serviceModel = new ServiceModel();
        $this->assignmentModel = new ServiceAssignmentModel();
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Create new application
     */
    public function create()
    {
        $rules = [
            'service_key' => 'required|max_length[100]',
            'applicant_email' => 'required|valid_email',
            'data' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $serviceKey = $this->request->getVar('service_key');
        $applicantEmail = $this->request->getVar('applicant_email');
        $formData = $this->request->getVar('data');

        // Validate service exists and is active
        $service = $this->serviceModel->getByKey($serviceKey);
        if (!$service || !$service['is_active']) {
            return $this->failNotFound('Service not found or inactive');
        }

        // Create application
        $applicationId = $this->applicationModel->insert([
            'service_key' => $serviceKey,
            'status' => 'draft',
            'priority' => 'normal'
        ]);

        if (!$applicationId) {
            return $this->failServerError('Failed to create application');
        }

        // Save applicant info
        $this->dataModel->saveData($applicationId, 'applicant_info', [
            'email' => $applicantEmail,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent(),
            'submitted_at' => date('Y-m-d H:i:s')
        ]);

        // Save service-specific data
        $this->dataModel->saveData($applicationId, 'service_specific', $formData);

        $application = $this->applicationModel->find($applicationId);

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Application created successfully',
            'data' => [
                'application_id' => $applicationId,
                'reference_number' => $application['reference_number'],
                'status' => $application['status'],
                'service' => $service
            ]
        ]);
    }

    /**
     * Get application details
     */
    public function show($id = null)
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Authentication required');
        }

        $application = $this->applicationModel->getWithDetails($id);

        if (!$application) {
            return $this->failNotFound('Application not found');
        }

        // Check permissions
        if (!$this->canAccessApplication($userId, $application)) {
            return $this->failForbidden('Access denied');
        }

        return $this->respond([
            'status' => 'success',
            'data' => $application
        ]);
    }

    /**
     * Submit application
     */
    public function update($id = null)
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Authentication required');
        }

        $application = $this->applicationModel->find($id);
        if (!$application) {
            return $this->failNotFound('Application not found');
        }

        // Check permissions
        if (!$this->canAccessApplication($userId, $application)) {
            return $this->failForbidden('Access denied');
        }

        // Update status to submitted
        $updated = $this->applicationModel->updateStatus($id, 'submitted');

        if (!$updated) {
            return $this->failServerError('Failed to submit application');
        }

        // Auto-assign to responsible user
        $this->autoAssignApplication($id);

        return $this->respondUpdated([
            'status' => 'success',
            'message' => 'Application submitted successfully',
            'data' => [
                'application_id' => $id,
                'reference_number' => $application['reference_number'],
                'status' => 'submitted'
            ]
        ]);
    }

    /**
     * Get applications list (for staff/admin)
     */
    public function index()
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Authentication required');
        }

        $user = $this->getCurrentUser();
        $page = $this->request->getVar('page') ?? 1;
        $limit = $this->request->getVar('limit') ?? 20;
        $status = $this->request->getVar('status');
        $service = $this->request->getVar('service');

        $query = $this->applicationModel;

        // Filter by user permissions
        if ($user['role'] === 'staff' || $user['role'] === 'reviewer') {
            $query->where('assigned_to', $userId);
        } elseif ($user['role'] === 'department_head') {
            // Get services in department
            $services = $this->serviceModel->where('department', $user['department'])->findAll();
            $serviceKeys = array_column($services, 'service_key');
            $query->whereIn('service_key', $serviceKeys);
        }
        // Admin can see all

        if ($status) {
            $query->where('status', $status);
        }

        if ($service) {
            $query->where('service_key', $service);
        }

        $applications = $query->orderBy('created_at', 'DESC')
                             ->findAll($limit, ($page - 1) * $limit);

        $total = $query->countAllResults(false);

        return $this->respond([
            'status' => 'success',
            'data' => [
                'applications' => $applications,
                'pagination' => [
                    'page' => (int)$page,
                    'limit' => (int)$limit,
                    'total' => $total,
                    'pages' => ceil($total / $limit)
                ]
            ]
        ]);
    }

    /**
     * Update application status (staff only)
     */
    public function updateStatus($id = null)
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Authentication required');
        }

        $rules = [
            'status' => 'required|in_list[draft,submitted,under_review,approved,rejected,completed,cancelled]',
            'notes' => 'max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $application = $this->applicationModel->find($id);
        if (!$application) {
            return $this->failNotFound('Application not found');
        }

        // Check permissions
        if (!$this->canModifyApplication($userId, $application)) {
            return $this->failForbidden('Access denied');
        }

        $newStatus = $this->request->getVar('status');
        $notes = $this->request->getVar('notes');

        $updated = $this->applicationModel->updateStatus($id, $newStatus);

        if (!$updated) {
            return $this->failServerError('Failed to update status');
        }

        // Send notification
        $this->notificationModel->notifyStatusChange($id, $application['status'], $newStatus);

        return $this->respondUpdated([
            'status' => 'success',
            'message' => 'Application status updated successfully'
        ]);
    }

    /**
     * Update/Modify applicant details fields (EAV format grouping)
     */
    public function updateApplicantDetails($id = null)
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Authentication required');
        }

        $application = $this->applicationModel->find($id);
        if (!$application) {
            return $this->failNotFound('Application not found');
        }

        // Validate administrative access modifications security profiles
        if (!$this->canModifyApplication($userId, $application)) {
            return $this->failForbidden('Access denied');
        }

        // Accept dynamic JSON parameters payload input or standard form fields
        $rawPayload = $this->request->getVar('applicant_details') ?? $this->request->getJSON(true)['applicant_details'] ?? null;

        if (empty($rawPayload) || !is_array($rawPayload)) {
            return $this->failValidationErrors('Applicant details payload information missing or invalid');
        }

        // Loop through key pairs and dynamically sync using ApplicationDataModel method rules matching schema
        foreach ($rawPayload as $dataKey => $dataValue) {
            $this->dataModel->updateDataField($id, 'applicant_details', $dataKey, $dataValue);
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Applicant details matrix synchronized successfully'
        ]);
    }

    /**
     * Track application by reference number
     */
    public function trackApplication()
    {
        $data = $this->request->getJSON(true);
        $reference = $data['reference_number'] ?? $this->request->getVar('reference_number');

        if (!$reference) {
            return $this->failValidationErrors('Reference number is required');
        }

        $application = $this->applicationModel->where('reference_number', $reference)->first();
        if (!$application) {
            return $this->failNotFound('Application not found');
        }

        $application = $this->applicationModel->getWithDetails($application['id']);

        return $this->respond([
            'status' => 'success',
            'data' => [
                'application' => $application
            ]
        ]);
    }

    /**
     * Auto-assign application to responsible user
     */
    private function autoAssignApplication($applicationId)
    {
        $application = $this->applicationModel->find($applicationId);
        $primaryAssignee = $this->assignmentModel->getPrimaryAssignee($application['service_key']);

        if ($primaryAssignee) {
            $this->applicationModel->assignToUser($applicationId, $primaryAssignee['assigned_user_id']);
            $this->notificationModel->notifyAssignment($applicationId, $primaryAssignee['assigned_user_id']);
        }
    }

    /**
     * Check if user can access application
     */
    private function canAccessApplication($userId, $application)
    {
        $user = $this->getCurrentUser();

        // Admin can access all
        if ($user['role'] === 'admin') {
            return true;
        }

        // Department head can access department applications
        if ($user['role'] === 'department_head') {
            $service = $this->serviceModel->getByKey($application['service_key']);
            return $service && $service['department'] === $user['department'];
        }

        // Staff/reviewer can only access assigned applications
        return $application['assigned_to'] == $userId;
    }

    /**
     * Check if user can modify application
     */
    private function canModifyApplication($userId, $application)
    {
        $user = $this->getCurrentUser();

        // Admin can modify all
        if ($user['role'] === 'admin') {
            return true;
        }

        // Department head can modify department applications
        if ($user['role'] === 'department_head') {
            $service = $this->serviceModel->getByKey($application['service_key']);
            return $service && $service['department'] === $user['department'];
        }

        // Staff can modify assigned applications
        return ($user['role'] === 'staff' || $user['role'] === 'reviewer') &&
               $application['assigned_to'] == $userId;
    }

    /**
     * Get current user ID from session
     */
    private function getCurrentUserId()
    {
        $token = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token) {
            return null;
        }

        $sessionModel = new \App\Models\UserSessionModel();
        $session = $sessionModel->validateSession($token);
        return $session ? $session['user_id'] : null;
    }

    /**
     * Get current user
     */
    private function getCurrentUser()
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return null;
        }

        $userModel = new \App\Models\UserModel();
        return $userModel->find($userId);
    }
}