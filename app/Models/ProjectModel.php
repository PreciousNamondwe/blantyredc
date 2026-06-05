<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $protectFields = true;

    // ✅ ONLY fields from your working test form
    protected $allowedFields = [
        'title',
        'description',
        'location',
        'category',
        'status',
        'progress_percentage',
        'start_date',
        'estimated_completion_date',
        'budget',
        'spent_amount',
        'contractor',
        'fund_source',
        'created_by',
        'is_active',
    ];

    // ✅ timestamps
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ✅ validation (matches form EXACTLY)
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'description' => 'required',
        'location' => 'required|max_length[255]',
        'category' => 'required|max_length[100]',
        'status' => 'required|in_list[planning,ongoing,completed]',
        'progress_percentage' => 'required|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
        'start_date' => 'required|valid_date',
        'estimated_completion_date' => 'required|valid_date',
        'budget' => 'required|decimal',
        'spent_amount' => 'permit_empty|decimal',
        'contractor' => 'permit_empty|max_length[255]',
        'fund_source' => 'permit_empty|max_length[100]',
        'created_by' => 'permit_empty|integer',
        'is_active' => 'required|in_list[0,1]',
    ];

    /**
     * ✅ CREATE PROJECT (CLEAN)
     */
    public function createProject(array $data)
    {
        if (!$this->insert($data)) {
            return [
                'status' => false,
                'errors' => $this->errors()
            ];
        }

        return [
            'status' => true,
            'id' => $this->getInsertID()
        ];
    }
        /**
     * ✅ GET ACTIVE PROJECTS
     */
    public function getActiveProjects()
    {
        return $this->where('is_active', 1)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
    /**
     * Get projects by status
     */
    public function getProjectsByStatus($status, $limit = null, $offset = 0)
    {
        $query = $this->where('is_active', 1)
                      ->where('status', $status)
                      ->orderBy('created_at', 'DESC');

        return $limit ? $query->findAll($limit, $offset) : $query->findAll();
    }

    /**
     * Get projects by category
     */
    public function getProjectsByCategory($category, $limit = null, $offset = 0)
    {
        $query = $this->where('is_active', 1)
                      ->where('category', $category)
                      ->orderBy('created_at', 'DESC');

        return $limit ? $query->findAll($limit, $offset) : $query->findAll();
    }

    /**
     * Get all unique categories
     */
    public function getCategories()
    {
        return $this->distinct()
                    ->where('is_active', 1)
                    ->select('category')
                    ->orderBy('category', 'ASC')
                    ->findAll();
    }

    /**
     * Search projects
     */
    public function searchProjects($keyword, $limit = 20, $offset = 0)
    {
        return $this->where('is_active', 1)
                    ->groupStart()
                        ->like('title', $keyword)
                        ->orLike('description', $keyword)
                        ->orLike('location', $keyword)
                    ->groupEnd()
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get project statistics
     */
    public function getProjectStats()
    {
        $db = \Config\Database::connect();

        $totalBudget = $db->table($this->table)
                          ->selectSum('budget')
                          ->where('is_active', 1)
                          ->get()
                          ->getRow()->budget ?? 0;

        $totalSpent = $db->table($this->table)
                         ->selectSum('spent_amount')
                         ->where('is_active', 1)
                         ->get()
                         ->getRow()->spent_amount ?? 0;

        return [
            'total_projects' => $this->where('is_active', 1)->countAllResults(),
            'ongoing_projects' => $this->where('is_active', 1)->where('status', 'ongoing')->countAllResults(),
            'completed_projects' => $this->where('is_active', 1)->where('status', 'completed')->countAllResults(),
            'planning_projects' => $this->where('is_active', 1)->where('status', 'planning')->countAllResults(),
            'total_budget' => $totalBudget,
            'total_spent' => $totalSpent,
        ];
    }
}