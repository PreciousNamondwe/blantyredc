<?php

namespace App\Models;

use CodeIgniter\Model;

class ElectedOfficialModel extends Model
{
    protected $table = 'elected_officials';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'position',
        'department',
        'phone',
        'email',
        'bio',
        'photo',
        'social_media',
        'is_active',
        'sort_order',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
