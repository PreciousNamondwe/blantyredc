<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationStatusLogModel extends Model
{
    protected $table = 'application_status_log';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'application_id',
        'old_status',
        'new_status',
        'changed_by',
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
        'new_status' => 'required|max_length[50]'
    ];

    /**
     * Get status history for application
     */
    public function getStatusHistory($applicationId)
    {
        return $this->select('application_status_log.*, users.full_name as changed_by_name')
                    ->join('users', 'users.id = application_status_log.changed_by', 'left')
                    ->where('application_id', $applicationId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Log status change
     */
    public function logStatusChange($applicationId, $oldStatus, $newStatus, $changedBy = null, $notes = null)
    {
        return $this->insert([
            'application_id' => $applicationId,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'changed_by' => $changedBy,
            'notes' => $notes
        ]);
    }

    /**
     * Get recent status changes
     */
    public function getRecentChanges($limit = 50)
    {
        return $this->select('application_status_log.*, applications.reference_number, services.service_name, users.full_name as changed_by_name')
                    ->join('applications', 'applications.id = application_status_log.application_id')
                    ->join('services', 'services.service_key = applications.service_key')
                    ->join('users', 'users.id = application_status_log.changed_by', 'left')
                    ->orderBy('application_status_log.created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get status change statistics
     */
    public function getStatusChangeStats($days = 30)
    {
        $startDate = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        return $this->select('new_status, COUNT(*) as count')
                    ->where('created_at >=', $startDate)
                    ->groupBy('new_status')
                    ->findAll();
    }
}
