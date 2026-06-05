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
        'featured_image',
        'status',
        'author_id',
        'published_at'
    ];
}