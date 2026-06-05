<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProjectModel;
use App\Models\UserModel;

class DummyProjectSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        $adminUser = $userModel->where('role', 'admin')->first();

        if (!$adminUser) {
            echo "No admin user found. Please create an admin user first.\n";
            return;
        }

        $projectModel = new ProjectModel();

        $dummyProject = [
            'title' => 'Blantyre City Center Road Rehabilitation',
            'description' => 'Major road rehabilitation project for the central business district of Blantyre City. This project aims to improve infrastructure, reduce traffic congestion, and enhance the overall urban environment.',
            'location' => 'Blantyre City Center',
            'category' => 'Infrastructure',
            'status' => 'ongoing',
            'progress_percentage' => 45,
            'start_date' => '2026-01-15',
            'estimated_completion_date' => '2026-12-31',
            'budget' => 2500000.00,
            'contractor' => 'Malawi Construction Company Ltd',
            'fund_source' => 'Government Budget',
            'created_by' => $adminUser['id'],
            'is_active' => 1,
        ];

        if ($projectModel->insert($dummyProject)) {
            echo "Dummy project created successfully!\n";
            echo "Title: " . $dummyProject['title'] . "\n";
            echo "Status: " . $dummyProject['status'] . "\n";
            echo "Progress: " . $dummyProject['progress_percentage'] . "%\n";
            echo "Budget: MWK " . number_format($dummyProject['budget'], 2) . "\n";
        } else {
            echo "Failed to create dummy project.\n";
            $errors = $projectModel->errors();
            echo "Errors: " . json_encode($errors) . "\n";
        }
    }
}