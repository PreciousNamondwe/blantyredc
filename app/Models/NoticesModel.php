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

    // Model Event Hooks for Automation
    protected $beforeInsert = ['generateReferenceId', 'initializeSlug'];
    protected $beforeUpdate = ['initializeSlug'];

    protected $validationRules = [
        'title'         => 'required|max_length[255]',
        'content'       => 'required',
        'category'      => 'required|max_length[100]',
        'urgency_level' => 'required|in_list[low,medium,high,urgent]',
        'status'        => 'required|in_list[draft,published,archived]',
    ];

    /**
     * Hook to handle Reference ID generation seamlessly before saving
     */
    protected function generateReferenceId(array $data)
    {
        // If the user left it blank or didn't supply it, auto-generate it
        if (empty($data['data']['reference'])) {
            $year = date('Y'); // Will dynamically evaluate to 2026
            
            do {
                // Generates a clean identifier like: NTC-2026-X8B2
                $randomSuffix = strtoupper(bin2hex(random_bytes(2))); 
                $candidateRef = "NTC-{$year}-{$randomSuffix}";
            } while ($this->where('reference', $candidateRef)->countAllResults() > 0);

            $data['data']['reference'] = $candidateRef;
        }
        return $data;
    }

    /**
     * Hook to handle slug compilation automatically
     */
    protected function initializeSlug(array $data)
    {
        if (isset($data['data']['title'])) {
            $data['data']['slug'] = $this->generateSlug($data['data']['title'], $data['id'][0] ?? null);
        }
        return $data;
    }

    /**
     * Generate unique slug matching structural records
     */
    public function generateSlug($title, $excludeId = null)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $builder = $this->where('slug', $slug);
            if ($excludeId) {
                $builder->where('id !=', $excludeId);
            }
            if ($builder->countAllResults() === 0) {
                break;
            }
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /* Keep all other helper query methods underneath here unchanged... */
    public function getPublishedNotices($limit = 20, $offset = 0) { return $this->where('status', 'published')->where('published_at <=', date('Y-m-d H:i:s'))->orderBy('published_at', 'DESC')->findAll($limit, $offset); }
    public function getNoticesByCategory($category, $limit = 20, $offset = 0) { return $this->where('status', 'published')->where('category', $category)->where('published_at <=', date('Y-m-d H:i:s'))->orderBy('published_at', 'DESC')->findAll($limit, $offset); }
    public function getUrgentNotices($limit = 10) { return $this->where('status', 'published')->whereIn('urgency_level', ['urgent', 'high'])->where('published_at <=', date('Y-m-d H:i:s'))->orderBy('urgency_level', 'ASC')->orderBy('published_at', 'DESC')->findAll($limit); }
    public function getNoticeBySlug($slug) { return $this->where('slug', $slug)->where('status', 'published')->first(); }
    public function getRecentNotices($limit = 5) { return $this->where('status', 'published')->where('published_at <=', date('Y-m-d H:i:s'))->orderBy('published_at', 'DESC')->findAll($limit); }
    public function getPublishedCount() { return $this->where('status', 'published')->where('published_at <=', date('Y-m-d H:i:s'))->countAllResults(); }
    public function getCategoriesWithCount() { return $this->select('category, COUNT(*) as count')->where('status', 'published')->where('published_at <=', date('Y-m-d H:i:s'))->groupBy('category')->orderBy('count', 'DESC')->findAll(); }
    public function searchNotices($keyword, $limit = 20, $offset = 0) { return $this->where('status', 'published')->where('published_at <=', date('Y-m-d H:i:s'))->groupStart()->like('title', $keyword)->orLike('content', $keyword)->orLike('reference', $keyword)->groupEnd()->orderBy('published_at', 'DESC')->findAll($limit, $offset); }
}