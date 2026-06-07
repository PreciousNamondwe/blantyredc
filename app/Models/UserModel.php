<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'role',
        'department',
        'phone',
        'is_active',
        'last_login'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        // Cleaned up validation strings to handle both inserts and updates safely
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'email'    => 'required|valid_email|max_length[255]|is_unique[users.email,id,{id}]',
        
        // VALIDATION TARGET CHANGED FROM 'password_hash' TO 'password'
        'password' => 'required|min_length[8]', 
        
        'full_name'  => 'required|max_length[255]',
        'role'       => 'required|in_list[admin,department_head,staff,reviewer]',
        'department' => 'permit_empty|max_length[100]',
        'phone'      => 'permit_empty|max_length[20]'
    ];

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before saving
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
        }
        return $data;
    }

    /**
     * Get user by username or email
     */
    public function getUserByCredential($credential)
    {
        return $this->where('username', $credential)
                    ->orWhere('email', $credential)
                    ->first();
    }

    /**
     * Get all staff in department
     */
    public function getStaffByDepartment($department)
    {
        return $this->where('department', $department)
                    ->whereIn('role', ['staff', 'department_head'])
                    ->where('is_active', true)
                    ->findAll();
    }

    /**
     * Get department heads
     */
    public function getDepartmentHeads()
    {
        return $this->where('role', 'department_head')
                    ->where('is_active', true)
                    ->findAll();
    }

    /**
     * Get users by role
     */
    public function getUsersByRole($role)
    {
        return $this->where('role', $role)
                    ->where('is_active', true)
                    ->findAll();
    }

    /**
     * Update last login
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }

    /**
     * Check if user has permission for action
     */
    public function hasPermission($userId, $permission)
    {
        $user = $this->find($userId);
        if (!$user) {
            return false;
        }

        $rolePermissions = [
            'admin' => ['all'],
            'department_head' => ['view_department', 'manage_staff', 'approve_applications'],
            'staff' => ['view_assigned', 'update_status'],
            'reviewer' => ['review_applications']
        ];

        $userPermissions = $rolePermissions[$user['role']] ?? [];

        return in_array('all', $userPermissions) || in_array($permission, $userPermissions);
    }

    /**
     * Get user dashboard stats
     */
    public function getDashboardStats($userId)
    {
        $user = $this->find($userId);
        if (!$user) {
            return [];
        }

        $stats = [];

        if ($user['role'] === 'admin') {
            // Admin sees all stats
            $applicationModel = new ApplicationModel();
            $stats = $applicationModel->getDashboardStats();

            $stats['total_users'] = $this->countAll();
            $stats['active_users'] = $this->where('is_active', true)->countAllResults();
        } elseif ($user['role'] === 'department_head') {
            // Department head sees department stats
            $serviceModel = new ServiceModel();
            $services = $serviceModel->where('department', $user['department'])->findAll();
            $serviceKeys = array_column($services, 'service_key');

            $applicationModel = new ApplicationModel();
            $stats['department_applications'] = $applicationModel->whereIn('service_key', $serviceKeys)->countAllResults();

            $stats['department_staff'] = $this->where('department', $user['department'])
                ->whereIn('role', ['staff', 'department_head'])
                ->countAllResults();
        } else {
            // Staff/reviewer sees assigned applications
            $applicationModel = new ApplicationModel();
            $stats['assigned_applications'] = $applicationModel->where('assigned_to', $userId)->countAllResults();
            $stats['pending_review'] = $applicationModel->where('assigned_to', $userId)
                ->where('status', 'under_review')
                ->countAllResults();
        }

        return $stats;
    }
}