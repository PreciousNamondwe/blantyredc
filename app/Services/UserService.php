<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\UserSessionModel;

class UserService
{
    protected $userModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->sessionModel = new UserSessionModel();
    }

    /**
     * Create new user
     */
    public function createUser($userData)
    {
        // Hash password if provided
        if (isset($userData['password'])) {
            $userData['password_hash'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            unset($userData['password']);
        }

        $userData['created_at'] = date('Y-m-d H:i:s');

        return $this->userModel->insert($userData);
    }

    /**
     * Update user
     */
    public function updateUser($userId, $userData)
    {
        $userData['updated_at'] = date('Y-m-d H:i:s');

        // Hash password if provided
        if (isset($userData['password'])) {
            $userData['password_hash'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            unset($userData['password']);
        }

        return $this->userModel->update($userId, $userData);
    }

    /**
     * Get user by ID
     */
    public function getUser($userId)
    {
        return $this->userModel->find($userId);
    }

    /**
     * Get users by role
     */
    public function getUsersByRole($role, $departmentId = null)
    {
        $query = $this->userModel->where('role', $role)->where('status', 'active');

        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }

        return $query->findAll();
    }

    /**
     * Get available staff for assignment
     */
    public function getAvailableStaff($departmentId = null)
    {
        $query = $this->userModel
            ->whereIn('role', ['staff', 'reviewer'])
            ->where('status', 'active');

        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }

        return $query->findAll();
    }

    /**
     * Change user password
     */
    public function changePassword($userId, $currentPassword, $newPassword)
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            throw new \Exception('User not found');
        }

        if (!password_verify($currentPassword, $user['password_hash'])) {
            throw new \Exception('Current password is incorrect');
        }

        return $this->userModel->update($userId, [
            'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Reset user password
     */
    public function resetPassword($userId, $newPassword = null)
    {
        if (!$newPassword) {
            $newPassword = $this->generateRandomPassword();
        }

        $this->userModel->update($userId, [
            'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $newPassword;
    }

    /**
     * Deactivate user
     */
    public function deactivateUser($userId)
    {
        // End all active sessions
        $this->sessionModel->where('user_id', $userId)->delete();

        return $this->userModel->update($userId, [
            'status' => 'inactive',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get user dashboard statistics
     */
    public function getUserStats($userId)
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return null;
        }

        $stats = [
            'total_applications' => 0,
            'pending_applications' => 0,
            'completed_applications' => 0,
            'notifications_unread' => 0
        ];

        // Get application statistics based on role
        if ($user['role'] === 'admin') {
            // Admin sees all applications
            $stats['total_applications'] = $this->userModel->db->table('applications')->countAll();
            $stats['pending_applications'] = $this->userModel->db->table('applications')->where('status', 'pending')->countAllResults();
            $stats['completed_applications'] = $this->userModel->db->table('applications')->whereIn('status', ['approved', 'completed'])->countAllResults();
        } elseif ($user['role'] === 'department_head') {
            // Department head sees applications in their department
            $departmentApplications = $this->userModel->db->table('applications')
                ->join('services', 'services.id = applications.service_id')
                ->where('services.department_id', $user['department_id'])
                ->countAllResults();

            $pendingDeptApps = $this->userModel->db->table('applications')
                ->join('services', 'services.id = applications.service_id')
                ->where('services.department_id', $user['department_id'])
                ->where('applications.status', 'pending')
                ->countAllResults();

            $completedDeptApps = $this->userModel->db->table('applications')
                ->join('services', 'services.id = applications.service_id')
                ->where('services.department_id', $user['department_id'])
                ->whereIn('applications.status', ['approved', 'completed'])
                ->countAllResults();

            $stats['total_applications'] = $departmentApplications;
            $stats['pending_applications'] = $pendingDeptApps;
            $stats['completed_applications'] = $completedDeptApps;
        } else {
            // Staff/reviewer sees assigned applications
            $assignedApps = $this->userModel->db->table('applications')
                ->where('assigned_to', $userId)
                ->countAllResults();

            $pendingAssigned = $this->userModel->db->table('applications')
                ->where('assigned_to', $userId)
                ->where('status', 'pending')
                ->countAllResults();

            $completedAssigned = $this->userModel->db->table('applications')
                ->where('assigned_to', $userId)
                ->whereIn('status', ['approved', 'completed'])
                ->countAllResults();

            $stats['total_applications'] = $assignedApps;
            $stats['pending_applications'] = $pendingAssigned;
            $stats['completed_applications'] = $completedAssigned;
        }

        // Get unread notifications
        $stats['notifications_unread'] = $this->userModel->db->table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', false)
            ->countAllResults();

        return $stats;
    }

    /**
     * Generate random password
     */
    private function generateRandomPassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    /**
     * Search users
     */
    public function searchUsers($query, $role = null, $limit = 20)
    {
        $builder = $this->userModel;

        if ($role) {
            $builder->where('role', $role);
        }

        return $builder->groupStart()
            ->like('first_name', $query)
            ->orLike('last_name', $query)
            ->orLike('email', $query)
            ->groupEnd()
            ->limit($limit)
            ->findAll();
    }
}