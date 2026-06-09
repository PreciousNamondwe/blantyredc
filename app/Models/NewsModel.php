<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;

    protected $allowedFields = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image', // This will now store a JSON string or serialized array of multiple image files
        'status',
        'author_id',
        'published_at'
    ];

    // Optional helper to decode images array when reading data entries
    public function getImagesArray($featured_image)
    {
        if (empty($featured_image)) {
            return [];
        }
        
        $decoded = json_decode($featured_image, true);
        return is_array($decoded) ? $decoded : [$featured_image];
    }
}