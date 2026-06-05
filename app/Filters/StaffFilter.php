<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\AuthService;

class StaffFilter implements FilterInterface
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

        // Check staff permissions
        if ($user['role'] !== 'admin' && $user['role'] !== 'department_head' && $user['role'] !== 'staff') {
            return \Config\Services::response()
                ->setStatusCode(403)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Staff access required'
                ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}