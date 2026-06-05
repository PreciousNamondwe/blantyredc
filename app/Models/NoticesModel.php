<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticesModel extends Model
{
    protected $table = 'notices';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title',
        'slug',
        'content',
        'reference',
        'category',
        'urgency_level',
        'status',
        'author_id',
        'published_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'content' => 'required',
        'category' => 'required|max_length[100]',
        'urgency_level' => 'required|in_list[low,medium,high,urgent]',
        'status' => 'required|in_list[draft,published,archived]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get all published notices
     */
    public function getPublishedNotices($limit = 20, $offset = 0)
    {
        return $this->where('status', 'published')
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->orderBy('published_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get notices by category
     */
    public function getNoticesByCategory($category, $limit = 20, $offset = 0)
    {
        return $this->where('status', 'published')
                    ->where('category', $category)
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->orderBy('published_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get urgent notices
     */
    public function getUrgentNotices($limit = 10)
    {
        return $this->where('status', 'published')
                    ->whereIn('urgency_level', ['urgent', 'high'])
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->orderBy('urgency_level', 'ASC')
                    ->orderBy('published_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get notice by slug
     */
    public function getNoticeBySlug($slug)
    {
        return $this->where('slug', $slug)
                    ->where('status', 'published')
                    ->first();
    }

    /**
     * Get recent notices
     */
    public function getRecentNotices($limit = 5)
    {
        return $this->where('status', 'published')
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->orderBy('published_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get total published notices count
     */
    public function getPublishedCount()
    {
        return $this->where('status', 'published')
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->countAllResults();
    }

    /**
     * Get categories with count
     */
    public function getCategoriesWithCount()
    {
        return $this->select('category, COUNT(*) as count')
                    ->where('status', 'published')
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->groupBy('category')
                    ->orderBy('count', 'DESC')
                    ->findAll();
    }

    /**
     * Search notices
     */
    public function searchNotices($keyword, $limit = 20, $offset = 0)
    {
        return $this->where('status', 'published')
                    ->where('published_at <=', date('Y-m-d H:i:s'))
                    ->groupStart()
                        ->like('title', $keyword)
                        ->orLike('content', $keyword)
                        ->orLike('reference', $keyword)
                    ->groupEnd()
                    ->orderBy('published_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Generate slug from title
     */
    public function generateSlug($title)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $originalSlug = $slug;
        $counter = 1;

        while ($this->where('slug', $slug)->countAllResults() > 0) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
