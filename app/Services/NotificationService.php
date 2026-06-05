<?php

namespace App\Services;

use App\Models\NotificationModel;
use App\Models\UserModel;
use App\Libraries\Phpmailer_lib;

class NotificationService
{
    protected $notificationModel;
    protected $userModel;
    protected $emailLib;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
        $this->userModel = new UserModel();
        $this->emailLib = new Phpmailer_lib();
    }

    /**
     * Send notification to user
     */
    public function sendNotification($userId, $title, $message, $type = 'info', $data = null)
    {
        $notificationData = [
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'data' => json_encode($data),
            'is_read' => false,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->notificationModel->insert($notificationData);
    }

    /**
     * Send email notification
     */
    public function sendEmailNotification($userId, $subject, $message, $template = null)
    {
        $user = $this->userModel->find($userId);
        if (!$user || !$user['email']) {
            return false;
        }

        try {
            $this->emailLib->sendMail($user['email'], $subject, $message);
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Email notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send application status update notification
     */
    public function notifyApplicationStatusUpdate($applicationId, $oldStatus, $newStatus, $userId = null)
    {
        $message = "Your application status has been updated from {$oldStatus} to {$newStatus}.";

        if ($userId) {
            $this->sendNotification($userId, 'Application Status Update', $message, 'info', [
                'application_id' => $applicationId,
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);
        }
    }

    /**
     * Send assignment notification to staff
     */
    public function notifyAssignment($staffId, $applicationId, $serviceName)
    {
        $message = "You have been assigned to review a new {$serviceName} application.";

        $this->sendNotification($staffId, 'New Assignment', $message, 'info', [
            'application_id' => $applicationId,
            'service_name' => $serviceName
        ]);
    }

    /**
     * Send payment notification
     */
    public function notifyPayment($userId, $applicationId, $amount, $status)
    {
        $message = "Payment of MWK {$amount} for your application has been {$status}.";

        $this->sendNotification($userId, 'Payment Update', $message, 'info', [
            'application_id' => $applicationId,
            'amount' => $amount,
            'status' => $status
        ]);
    }

    /**
     * Get unread notifications for user
     */
    public function getUnreadNotifications($userId, $limit = 10)
    {
        return $this->notificationModel
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    /**
     * Mark notification as read
     */
    public function markAsRead($notificationId, $userId)
    {
        return $this->notificationModel
            ->where('id', $notificationId)
            ->where('user_id', $userId)
            ->set(['is_read' => true, 'read_at' => date('Y-m-d H:i:s')])
            ->update();
    }

    /**
     * Send bulk notifications
     */
    public function sendBulkNotifications($userIds, $title, $message, $type = 'info', $data = null)
    {
        $notifications = [];
        foreach ($userIds as $userId) {
            $notifications[] = [
                'user_id' => $userId,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'data' => json_encode($data),
                'is_read' => false,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        return $this->notificationModel->insertBatch($notifications);
    }
}