<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagementMemberModel extends Model
{
    protected $table = 'management_members';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'name',
        'position',
        'email',
        'phone',
        'bio',
        'photo',
        'is_active',
        'sort_order',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
