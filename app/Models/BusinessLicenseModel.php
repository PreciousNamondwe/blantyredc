<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessLicenseModel extends Model
{
    protected $table = 'business_licenses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'application_id',
        'business_name',
        'business_type',
        'business_category',
        'market',
        'code',
        'registration_date',
        'expiry_date',
        'license_number',
        'status',
        'fee_amount',
        'location_type', // Rural, Peri-Urban
        'owner_name',
        'owner_id_type',
        'owner_id_number',
        'owner_phone',
        'owner_email',
        'business_address',
        'business_location',
        'number_of_employees',
        'annual_turnover',
        'previous_license_number',
        'is_renewal',
        'inspection_required',
        'inspection_date',
        'inspection_report',
        'approved_by',
        'approved_at',
        'rejected_at',
        'rejection_reason',
        'completed_at',
        'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'application_id' => 'required|integer',
        'business_name' => 'required|max_length[255]',
        'business_type' => 'required|max_length[255]',
        'owner_name' => 'required|max_length[255]',
        'owner_id_number' => 'required|max_length[100]',
        'owner_phone' => 'required|max_length[20]',
        'owner_email' => 'required|valid_email|max_length[255]',
        'market' => 'permit_empty|max_length[100]',
        'location_type' => 'permit_empty|in_list[Rural,Peri-Urban,Urban]',
        'status' => 'in_list[pending,under_review,approved,rejected,expired,cancelled]',
        'fee_amount' => 'permit_empty|decimal',
    ];

    /**
     * Get business license by application ID
     */
    public function getByApplicationId($applicationId)
    {
        return $this->where('application_id', $applicationId)->first();
    }

    /**
     * Get business licenses by status
     */
    public function getByStatus($status, $limit = 50, $offset = 0)
    {
        return $this->where('status', $status)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get business licenses by business type
     */
    public function getByBusinessType($businessType, $limit = 50, $offset = 0)
    {
        return $this->where('business_type', $businessType)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get business licenses by market
     */
    public function getByMarket($market, $limit = 50, $offset = 0)
    {
        return $this->where('market', $market)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get business licenses expiring soon
     */
    public function getExpiringSoon($days = 30)
    {
        return $this->where('status', 'approved')
                    ->where('expiry_date <=', date('Y-m-d H:i:s', strtotime("+{$days} days")))
                    ->orderBy('expiry_date', 'ASC')
                    ->findAll();
    }

    /**
     * Get expired business licenses
     */
    public function getExpired()
    {
        return $this->where('status', 'approved')
                    ->where('expiry_date <', date('Y-m-d H:i:s'))
                    ->orderBy('expiry_date', 'ASC')
                    ->findAll();
    }

    /**
     * Get business license with application details
     */
    public function getWithApplicationDetails($applicationId)
    {
        $license = $this->getByApplicationId($applicationId);
        
        if (!$license) {
            return null;
        }

        // Get related application
        $applicationModel = new ApplicationModel();
        $license['application'] = $applicationModel->getWithDetails($applicationId);

        return $license;
    }

    /**
     * Generate license number
     */
    public function generateLicenseNumber($businessType = null)
    {
        $prefix = 'BL';
        $year = date('Y');
        $random = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        return "{$prefix}/{$year}/{$random}";
    }

    /**
     * Update license status
     */
    public function updateLicenseStatus($id, $status, $notes = null)
    {
        $data = ['status' => $status];

        switch ($status) {
            case 'approved':
                $data['approved_at'] = date('Y-m-d H:i:s');
                $data['license_number'] = $this->generateLicenseNumber();
                // Set expiry date (1 year from approval)
                $data['expiry_date'] = date('Y-m-d H:i:s', strtotime('+1 year'));
                break;
            case 'rejected':
                $data['rejected_at'] = date('Y-m-d H:i:s');
                $data['rejection_reason'] = $notes;
                break;
            case 'completed':
                $data['completed_at'] = date('Y-m-d H:i:s');
                break;
        }

        if ($notes && $status !== 'rejected') {
            $data['notes'] = $notes;
        }

        return $this->update($id, $data);
    }

    /**
     * Get dashboard statistics for business licenses
     */
    public function getDashboardStats()
    {
        $stats = [];

        // Count by status
        $statusCounts = $this->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        foreach ($statusCounts as $stat) {
            $stats['status_' . ($stat['status'] ?? 'unknown')] = $stat['count'];
        }

        // Total licenses
        $stats['total'] = $this->countAll();

        // Active licenses (approved and not expired)
        $stats['active'] = $this->where('status', 'approved')
            ->where('expiry_date >', date('Y-m-d H:i:s'))
            ->countAllResults();

        // Expiring soon (within 30 days)
        $now = date('Y-m-d H:i:s');
        $future = date('Y-m-d H:i:s', strtotime('+30 days'));
        $stats['expiring_soon'] = $this->where('status', 'approved')
            ->where("expiry_date BETWEEN '$now' AND '$future'", null, false)
            ->countAllResults();

        // Expired
        $stats['expired'] = $this->where('status', 'approved')
            ->where('expiry_date <', date('Y-m-d H:i:s'))
            ->countAllResults();

        // Pending
        $stats['pending'] = $this->where('status', 'pending')
            ->countAllResults();

        // Under review
        $stats['under_review'] = $this->where('status', 'under_review')
            ->countAllResults();

        // Revenue (sum of fee_amount for approved licenses)
        $revenue = $this->selectSum('fee_amount')
            ->where('status', 'approved')
            ->get()
            ->getRow();
        $stats['total_revenue'] = $revenue->fee_amount ?? 0;

        // Recent applications (last 30 days)
        $stats['recent'] = $this->where('created_at >=', date('Y-m-d H:i:s', strtotime('-30 days')))
            ->countAllResults();

        return $stats;
    }

    /**
     * Get business licenses by owner email
     */
    public function getByOwnerEmail($email, $limit = 50, $offset = 0)
    {
        return $this->where('owner_email', $email)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Search business licenses
     */
    public function search($query, $limit = 50, $offset = 0)
    {
        return $this->groupStart()
                    ->like('business_name', $query)
                    ->orLike('owner_name', $query)
                    ->orLike('license_number', $query)
                    ->orLike('business_type', $query)
                    ->groupEnd()
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get business types statistics
     */
    public function getBusinessTypeStats()
    {
        return $this->select('business_type, COUNT(*) as count')
            ->groupBy('business_type')
            ->orderBy('count', 'DESC')
            ->findAll();
    }

    /**
     * Get market statistics
     */
    public function getMarketStats()
    {
        return $this->select('market, COUNT(*) as count')
            ->groupBy('market')
            ->orderBy('count', 'DESC')
            ->findAll();
    }
}