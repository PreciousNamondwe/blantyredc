<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessApplicationModel extends Model
{
    protected $table            = 'businesses_application';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = false; // Set to true if your table uses created_at/updated_at fields

    // Comprehensive list of all actual columns present in your database table schema
    protected $allowedFields    = [
        'composite_id',
        'application_code', 
        'application_type', 
        'current_stage', 
        'submission_date', 
        'business_name', 
        'trading_name',
        'business_type',
        'business_category',
        'is_formal_sector',
        'mbrs_registration_number',
        'mra_tpin',
        'estimated_annual_turnover',
        'owner_name',
        'owner_national_id',
        'owner_phone',
        'owner_email',
        'traditional_authority',
        'village_or_area',
        'plot_number',
        'physical_address',
        'assigned_reviewer_id',
        'reviewer_remarks'
    ];

    /**
     * Fetch complete application details using the composite_id string passed from the view link
     *
     * @param string $composite_id
     * @return array|null
     */
    public function getByCompositeId($composite_id)
    {
        return $this->where('composite_id', $composite_id)->first();
    }
}