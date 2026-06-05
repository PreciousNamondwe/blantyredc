<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\AuthService;

class AdminFilter implements FilterInterface
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // First check authentication
        $token = $request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $token);

        if (!$token) {
            return \Config\Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Authorization token required'
                ]);
        }

        $session = $this->authService->validateSession($token);
        if (!$session) {
            return \Config\Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid or expired token'
                ]);
        }

        $user = $this->authService->getUserByToken($token);
        if (!$user) {
            return \Config\Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'User not found'
                ]);
        }

        // Check admin permissions
        if ($user['role'] !== 'admin') {
            return \Config\Services::response()
                ->setStatusCode(403)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Admin access required'
                ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}