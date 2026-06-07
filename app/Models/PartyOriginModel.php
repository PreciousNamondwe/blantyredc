<?php

namespace App\Models;

use CodeIgniter\Model;

class PartyOriginModel extends Model
{
    protected $table            = 'party_origins';
    protected $primaryKey       = 'origin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['village_name', 'traditional_authority', 'district'];
}