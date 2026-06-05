<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceAssignmentModel extends Model
{
    protected $table = 'service_assignments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'service_key',
        'assigned_user_id',
        'is_primary'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'service_key' => 'required|max_length[100]',
        'assigned_user_id' => 'required|integer'
    ];

    /**
     * Get primary assignee for service
     */
    public function getPrimaryAssignee($serviceKey)
    {
        return $this->select('service_assignments.*, users.full_name, users.email, users.role')
                    ->join('users', 'users.id = service_assignments.assigned_user_id')
                    ->where('service_key', $serviceKey)
                    ->where('is_primary', true)
                    ->where('users.is_active', true)
                    ->first();
    }

    /**
     * Get all assignees for service
     */
    public function getServiceAssignees($serviceKey)
    {
        return $this->select('service_assignments.*, users.full_name, users.email, users.role, users.department')
                    ->join('users', 'users.id = service_assignments.assigned_user_id')
                    ->where('service_key', $serviceKey)
                    ->where('users.is_active', true)
                    ->findAll();
    }

    /**
     * Get services assigned to user
     */
    public function getUserAssignments($userId)
    {
        return $this->select('service_assignments.*, services.service_name, services.department')
                    ->join('services', 'services.service_key = service_assignments.service_key')
                    ->where('assigned_user_id', $userId)
                    ->where('services.is_active', true)
                    ->findAll();
    }

    /**
     * Assign user to service
     */
    public function assignUserToService($serviceKey, $userId, $isPrimary = false)
    {
        // If setting as primary, remove other primaries for this service
        if ($isPrimary) {
            $this->where('service_key', $serviceKey)->set(['is_primary' => false])->update();
        }

        // Check if assignment already exists
        $existing = $this->where('service_key', $serviceKey)
                        ->where('assigned_user_id', $userId)
                        ->first();

        if ($existing) {
            return $this->update($existing['id'], ['is_primary' => $isPrimary]);
        } else {
            return $this->insert([
                'service_key' => $serviceKey,
                'assigned_user_id' => $userId,
                'is_primary' => $isPrimary
            ]);
        }
    }

    /**
     * Remove user assignment
     */
    public function removeAssignment($serviceKey, $userId)
    {
        return $this->where('service_key', $serviceKey)
                    ->where('assigned_user_id', $userId)
                    ->delete();
    }
}