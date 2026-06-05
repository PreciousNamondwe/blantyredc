<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\UserSessionModel;

class AuthService
{
    protected $userModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->sessionModel = new UserSessionModel();
    }

    /**
     * Authenticate user
     */
    public function authenticate($email, $password)
    {
        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            throw new \Exception('Invalid email or password');
        }

        if (!$user['is_active']) {
            throw new \Exception('Account is deactivated');
        }

        return $user;
    }

    /**
     * Create user session
     */
    public function createSession($userId, $ipAddress, $userAgent = null)
    {
        return $this->sessionModel->createSession($userId, $ipAddress, $userAgent);
    }

    /**
     * Get current authenticated user from header or session token
     */
    public function getCurrentUser()
    {
        $request = service('request');

        $token = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (empty($token)) {
            $token = session()->get('auth_token');
        }

        if (!$token) {
            return null;
        }

        if (!$this->validateSession($token)) {
            return null;
        }

        return $this->getUserByToken($token);
    }

    /**
     * Validate session token
     */
    public function validateSession($token)
    {
        return $this->sessionModel->validateSession($token);
    }

    /**
     * Destroy session
     */
    public function destroySession($token)
    {
        return $this->sessionModel->expireSession($token);
    }

    /**
     * Get user by session token
     */
    public function getUserByToken($token)
    {
        $session = $this->validateSession($token);
        if (!$session) {
            return null;
        }

        return $this->userModel->find($session['user_id']);
    }

    /**
     * Check if user has permission
     */
    public function hasPermission($userId, $permission)
    {
        return $this->userModel->hasPermission($userId, $permission);
    }

    /**
     * Get user dashboard data
     */
    public function getUserDashboard($userId)
    {
        $user = $this->userModel->find($userId);
        if (!$user) {
            return null;
        }

        return [
            'user' => $user,
            'stats' => $this->userModel->getDashboardStats($userId),
            'permissions' => $this->getUserPermissions($user)
        ];
    }

    /**
     * Get user permissions array
     */
    private function getUserPermissions($user)
    {
        $permissions = [];

        switch ($user['role']) {
            case 'admin':
                $permissions = ['all'];
                break;
            case 'department_head':
                $permissions = [
                    'view_department',
                    'manage_staff',
                    'approve_applications',
                    'view_reports'
                ];
                break;
            case 'staff':
                $permissions = [
                    'view_assigned',
                    'update_status',
                    'communicate_applicants'
                ];
                break;
            case 'reviewer':
                $permissions = [
                    'review_applications',
                    'update_status'
                ];
                break;
        }

        return $permissions;
    }

    /**
     * Update user last login
     */
    public function updateLastLogin($userId)
    {
        return $this->userModel->updateLastLogin($userId);
    }

    /**
     * Clean expired sessions
     */
    public function cleanExpiredSessions()
    {
        return $this->sessionModel->cleanExpiredSessions();
    }
}