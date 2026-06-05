<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessTypeModel extends Model
{
    protected $table = 'business_types';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'category',
        'is_active',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|max_length[255]|is_unique[business_types.name]'
    ];

    public function getActiveTypes()
    {
        return $this->where('is_active', true)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}
