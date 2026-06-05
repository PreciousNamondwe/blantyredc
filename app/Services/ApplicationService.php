<?php

namespace App\Services;

use App\Models\ApplicationModel;
use App\Models\ApplicationDataModel;
use App\Models\ServiceAssignmentModel;
use App\Models\NotificationModel;
use App\Models\ApplicationStatusLogModel;

class ApplicationService
{
    protected $applicationModel;
    protected $dataModel;
    protected $assignmentModel;
    protected $notificationModel;
    protected $statusLogModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
        $this->dataModel = new ApplicationDataModel();
        $this->assignmentModel = new ServiceAssignmentModel();
        $this->notificationModel = new NotificationModel();
        $this->statusLogModel = new ApplicationStatusLogModel();
    }

    /**
     * Create new application
     */
    public function createApplication($serviceKey, $applicantData, $formData)
    {
        // Create application record
        $applicationId = $this->applicationModel->insert([
            'service_key' => $serviceKey,
            'status' => 'draft',
            'priority' => 'normal'
        ]);

        if (!$applicationId) {
            throw new \Exception('Failed to create application');
        }

        // Save applicant information
        $this->dataModel->saveData($applicationId, 'applicant_info', $applicantData);

        // Save service-specific data
        $this->dataModel->saveData($applicationId, 'service_specific', $formData);

        return $applicationId;
    }

    /**
     * Submit application
     */
    public function submitApplication($applicationId)
    {
        $application = $this->applicationModel->find($applicationId);
        if (!$application) {
            throw new \Exception('Application not found');
        }

        if ($application['status'] !== 'draft') {
            throw new \Exception('Application already submitted');
        }

        // Update status
        $this->applicationModel->updateStatus($applicationId, 'submitted');

        // Auto-assign
        $this->autoAssignApplication($applicationId);

        return true;
    }

    /**
     * Update application status
     */
    public function updateStatus($applicationId, $newStatus, $userId = null, $notes = null)
    {
        $application = $this->applicationModel->find($applicationId);
        if (!$application) {
            throw new \Exception('Application not found');
        }

        $oldStatus = $application['status'];

        // Update status with timestamps
        $this->applicationModel->updateStatus($applicationId, $newStatus);

        // Log status change
        $this->statusLogModel->logStatusChange($applicationId, $oldStatus, $newStatus, $userId, $notes);

        // Send notifications
        $this->notificationModel->notifyStatusChange($applicationId, $oldStatus, $newStatus);

        return true;
    }

    /**
     * Assign application to user
     */
    public function assignToUser($applicationId, $userId)
    {
        $this->applicationModel->assignToUser($applicationId, $userId);
        $this->notificationModel->notifyAssignment($applicationId, $userId);
    }

    /**
     * Auto-assign application based on service
     */
    public function autoAssignApplication($applicationId)
    {
        $application = $this->applicationModel->find($applicationId);
        if (!$application) {
            return false;
        }

        $primaryAssignee = $this->assignmentModel->getPrimaryAssignee($application['service_key']);

        if ($primaryAssignee) {
            $this->assignToUser($applicationId, $primaryAssignee['assigned_user_id']);
            return true;
        }

        return false;
    }

    /**
     * Get application with full details
     */
    public function getApplicationDetails($applicationId)
    {
        return $this->applicationModel->getWithDetails($applicationId);
    }

    /**
     * Get applications for user based on role
     */
    public function getApplicationsForUser($userId, $userRole, $userDepartment = null, $filters = [])
    {
        $query = $this->applicationModel;

        // Apply role-based filtering
        switch ($userRole) {
            case 'admin':
                // Admin sees all
                break;
            case 'department_head':
                // Department head sees department applications
                $serviceModel = new \App\Models\ServiceModel();
                $services = $serviceModel->where('department', $userDepartment)->findAll();
                $serviceKeys = array_column($services, 'service_key');
                $query->whereIn('service_key', $serviceKeys);
                break;
            case 'staff':
            case 'reviewer':
                // Staff/reviewer see assigned applications
                $query->where('assigned_to', $userId);
                break;
        }

        // Apply filters
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['service_key'])) {
            $query->where('service_key', $filters['service_key']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('created_at >=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('created_at <=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'DESC')->findAll();
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats($userId = null, $userRole = null, $userDepartment = null)
    {
        if ($userRole === 'admin') {
            return $this->applicationModel->getDashboardStats();
        }

        // For other roles, get filtered stats
        $applications = $this->getApplicationsForUser($userId, $userRole, $userDepartment);

        $stats = [
            'total' => count($applications),
            'recent' => count(array_filter($applications, function($app) {
                return strtotime($app['created_at']) > strtotime('-30 days');
            }))
        ];

        // Count by status
        $statusCounts = [];
        foreach ($applications as $app) {
            $status = $app['status'];
            $statusCounts[$status] = ($statusCounts[$status] ?? 0) + 1;
        }

        foreach ($statusCounts as $status => $count) {
            $stats['status_' . $status] = $count;
        }

        return $stats;
    }

    /**
     * Validate application data
     */
    public function validateApplicationData($serviceKey, $data)
    {
        $serviceModel = new \App\Models\ServiceModel();
        $service = $serviceModel->getByKey($serviceKey);

        if (!$service) {
            throw new \Exception('Invalid service');
        }

        // Basic validation - can be extended based on service requirements
        $errors = [];

        if (empty($data['applicant_email']) || !filter_var($data['applicant_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required';
        }

        if (empty($data['applicant_name'])) {
            $errors[] = 'Applicant name is required';
        }

        if (!empty($errors)) {
            throw new \Exception('Validation failed: ' . implode(', ', $errors));
        }

        return true;
    }
}