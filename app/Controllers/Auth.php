<?php

namespace App\Controllers;

use App\Services\AuthService;

class Auth extends BaseController
{
    public function login()
    {
        helper('form');
        $data = [
            'pageTitle' => 'Admin Login',
        ];

        return view('auth/login', $data);
    }

    public function loginPost()
    {
        helper('form');

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'pageTitle'  => 'Admin Login',
                'validation' => $this->validator,
            ]);
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $authService = new AuthService();

        try {
            $user = $authService->authenticate($email, $password);
            $token = $authService->createSession(
                $user['id'], 
                $this->request->getIPAddress(), 
                $this->request->getUserAgent()
            );

            if (!$token) {
                return redirect()->back()->withInput()->with('error', 'Unable to create session. Please try again.');
            }

            $authService->updateLastLogin($user['id']);

            session()->set('auth_token', $token);

            // Redirect matches exactly with your routes.php file entry
            return redirect()->to('admin/dashboard');

        } catch (\Exception $ex) {
            return redirect()->back()->withInput()->with('error', $ex->getMessage());
        }
    }

    public function logout()
    {
        $token = session()->get('auth_token');

        if ($token) {
            $authService = new AuthService();
            $authService->destroySession($token);
        }

        session()->remove('auth_token');
        session()->setFlashdata('success', 'You have been logged out successfully.');

        return redirect()->to('login');
    }
}