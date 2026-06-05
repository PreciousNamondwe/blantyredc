<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\AuthService;

class WebAdminFilter implements FilterInterface
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in via session
        $session = session();
        $token = $session->get('auth_token');

        if (!$token) {
            return redirect()->to('/login')->with('error', 'Please login to access admin area');
        }

        $sessionValid = $this->authService->validateSession($token);
        if (!$sessionValid) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again');
        }

        $user = $this->authService->getUserByToken($token);
        if (!$user) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'User not found');
        }

        // Check admin permissions
        if ($user['role'] !== 'admin') {
            return redirect()->to('/')->with('error', 'Admin access required');
        }

        // Store user data in session
        $session->set('user_id', $user['id']);
        $session->set('user_name', $user['full_name']);
        $session->set('user_email', $user['email']);
        $session->set('user_role', $user['role']);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}