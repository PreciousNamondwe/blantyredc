<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $existing = $userModel->where('email', 'admin@blantyredc.gov.mw')->first();
        if ($existing) {
            return;
        }

        $userModel->insert([
            'username' => 'admin',
            'email' => 'admin@blantyredc.gov.mw',
            'password_hash' => password_hash('Admin@1234', PASSWORD_DEFAULT),
            'full_name' => 'Admin User',
            'role' => 'admin',
            'department' => null,
            'phone' => '0000000000',
            'is_active' => true,
        ]);
    }
}
