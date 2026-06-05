<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
    use ResponseTrait;

    protected $userModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->sessionModel = new UserSessionModel();
    }

    /**
     * User login
     */
    public function login()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return $this->failUnauthorized('Invalid email or password');
        }

        if (!$user['is_active']) {
            return $this->failUnauthorized('Account is deactivated');
        }

        // Create session
        $token = $this->sessionModel->createSession(
            $user['id'],
            $this->request->getIPAddress(),
            $this->request->getUserAgent()
        );

        if (!$token) {
            return $this->failServerError('Failed to create session');
        }

        // Update last login
        $this->userModel->updateLastLogin($user['id']);

        // Remove sensitive data
        unset($user['password_hash']);

        return $this->respond([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
                'expires_at' => date('Y-m-d H:i:s', strtotime('+7 days'))
            ]
        ]);
    }

    /**
     * User logout
     */
    public function logout()
    {
        $token = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if ($token) {
            $this->sessionModel->expireSession($token);
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Get current user profile
     */
    public function profile()
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Not authenticated');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        unset($user['password_hash']);

        return $this->respond([
            'status' => 'success',
            'data' => $user
        ]);
    }

    /**
     * Validate session
     */
    public function validateSession()
    {
        $userId = $this->getCurrentUserId();
        if (!$userId) {
            return $this->failUnauthorized('Session expired or invalid');
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Session is valid'
        ]);
    }

    /**
     * Get current user ID from token
     */
    private function getCurrentUserId()
    {
        $token = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token) {
            return null;
        }

        $session = $this->sessionModel->validateSession($token);
        return $session ? $session['user_id'] : null;
    }
}