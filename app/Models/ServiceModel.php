<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'service_key',
        'service_name',
        'description',
        'department',
        'fee_amount',
        'processing_days',
        'is_active',
        'sort_order'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'service_key' => 'required|max_length[100]|is_unique[services.service_key,id,{id}]',
        'service_name' => 'required|max_length[255]',
        'department' => 'required|max_length[100]',
        'fee_amount' => 'required|decimal',
        'processing_days' => 'required|integer|greater_than[0]',
        'sort_order' => 'integer'
    ];

    /**
     * Get active services
     */
    public function getActiveServices()
    {
        return $this->where('is_active', true)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    /**
     * Get services by department
     */
    public function getServicesByDepartment($department)
    {
        return $this->where('department', $department)
                    ->where('is_active', true)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    /**
     * Get service by key
     */
    public function getByKey($serviceKey)
    {
        return $this->where('service_key', $serviceKey)->first();
    }

    /**
     * Get departments list
     */
    public function getDepartments()
    {
        return $this->select('department')
                    ->distinct()
                    ->where('is_active', true)
                    ->findAll();
    }

    /**
     * Get service statistics
     */
    public function getServiceStats()
    {
        $stats = [];

        // Applications per service
        $applicationModel = new ApplicationModel();
        $services = $this->getActiveServices();

        foreach ($services as $service) {
            $count = $applicationModel->where('service_key', $service['service_key'])->countAllResults();
            $stats[$service['service_key']] = [
                'name' => $service['service_name'],
                'count' => $count,
                'fee' => $service['fee_amount']
            ];
        }

        return $stats;
    }
}