<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessLicenseModel extends Model
{
    protected $table            = 'businesses_application';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    
    // Core structure matching your form tracking requirements
    protected $allowedFields = [
        'application_code',
        'application_type',
        'current_stage',
        'submission_date',
        'business_name',
        'business_type',
        'business_category',
        'owner_name',
        'owner_national_id',
        'owner_id_image',
        'owner_phone',
        'traditional_authority',
        'village_or_area',
        'physical_address',
        'trading_name',
        'owner_email',
        'plot_number',
        'is_formal_sector',
        'mbrs_registration_number',
        'mra_tpin',
        'estimated_annual_turnover',
        'assigned_reviewer_id',
        'reviewer_remarks'
    ];

    // Meta dates timestamps management
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generates a completely unique tracking reference code for Council audit tracking
     */
    public function generateApplicationCode(): string
    {
        do {
            $code = 'APP-' . date('Y') . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
            $exists = $this->where('application_code', $code)->first();
        } while ($exists !== null);

        return $code;
    }
}