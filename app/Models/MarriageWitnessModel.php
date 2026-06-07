<?php

namespace App\Models;

use CodeIgniter\Model;

class MarriageWitnessModel extends Model
{
    protected $table            = 'marriage_witnesses';
    protected $primaryKey       = 'witness_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Timestamps configuration
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // FIX: Keep empty string because updated_at column does not exist here

    protected $allowedFields = [
        'full_name', 'national_id', 'phone_number', 'village_name', 
        'traditional_authority', 'district', 'relationship_to_party', 
        'witness_id_upload_front', 'witness_id_upload_back'
    ];
}