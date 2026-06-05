<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'application_id',
        'type',
        'title',
        'message',
        'is_read'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'type' => 'required|in_list[status_change,assignment,payment,reminder,system]',
        'title' => 'required|max_length[255]',
        'message' => 'required'
    ];

    /**
     * Create notification
     */
    public function createNotification($userId, $type, $title, $message, $applicationId = null)
    {
        return $this->insert([
            'user_id' => $userId,
            'application_id' => $applicationId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'is_read' => false
        ]);
    }

    /**
     * Get user notifications
     */
    public function getUserNotifications($userId, $limit = 50, $unreadOnly = false)
    {
        $query = $this->where('user_id', $userId);

        if ($unreadOnly) {
            $query->where('is_read', false);
        }

        return $query->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId, $userId = null)
    {
        $query = $this->where('id', $notificationId);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->set(['is_read' => true])->update();
    }

    /**
     * Mark all user notifications as read
     */
    public function markAllAsRead($userId)
    {
        return $this->where('user_id', $userId)
                    ->set(['is_read' => true])
                    ->update();
    }

    /**
     * Get unread count for user
     */
    public function getUnreadCount($userId)
    {
        return $this->where('user_id', $userId)
                    ->where('is_read', false)
                    ->countAllResults();
    }

    /**
     * Send status change notification
     */
    public function notifyStatusChange($applicationId, $oldStatus, $newStatus)
    {
        $applicationModel = new ApplicationModel();
        $application = $applicationModel->find($applicationId);

        if (!$application) {
            return false;
        }

        $serviceModel = new ServiceModel();
        $service = $serviceModel->where('service_key', $application['service_key'])->first();

        $title = "Application Status Updated";
        $message = "Your {$service['service_name']} application ({$application['reference_number']}) status changed from {$oldStatus} to {$newStatus}.";

        // Get applicant email from application data
        $dataModel = new ApplicationDataModel();
        $applicantData = $dataModel->getDataByType($applicationId, 'applicant_info');

        if (isset($applicantData['email'])) {
            // In a real system, you'd send email here
            // For now, we'll create a notification for assigned staff
            if ($application['assigned_to']) {
                return $this->createNotification(
                    $application['assigned_to'],
                    'status_change',
                    $title,
                    $message,
                    $applicationId
                );
            }
        }

        return false;
    }

    /**
     * Send assignment notification
     */
    public function notifyAssignment($applicationId, $assignedUserId)
    {
        $applicationModel = new ApplicationModel();
        $application = $applicationModel->find($applicationId);

        if (!$application) {
            return false;
        }

        $serviceModel = new ServiceModel();
        $service = $serviceModel->where('service_key', $application['service_key'])->first();

        $title = "New Application Assigned";
        $message = "You have been assigned a new {$service['service_name']} application ({$application['reference_number']}).";

        return $this->createNotification(
            $assignedUserId,
            'assignment',
            $title,
            $message,
            $applicationId
        );
    }

    /**
     * Clean old notifications
     */
    public function cleanOldNotifications($days = 90)
    {
        $cutoffDate = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        return $this->where('created_at <', $cutoffDate)
                    ->where('is_read', true)
                    ->delete();
    }
}