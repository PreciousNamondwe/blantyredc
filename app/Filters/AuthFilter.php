<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Services\AuthService;

class AuthFilter implements FilterInterface
{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Get token from Authorization header
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

        // Validate token
        $session = $this->authService->validateSession($token);
        if (!$session) {
            return \Config\Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid or expired token'
                ]);
        }

        // Authentication passed; controller should retrieve the current user as needed.
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}