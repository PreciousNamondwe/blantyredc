<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    public function index()
    {
        $model = new NewsModel();

        $now = date('Y-m-d H:i:s');

        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');

        $data = [
            'pageTitle' => 'News',
            'newsArticles' => $model
                ->where('status', 'published')
                ->groupStart()
                    ->where('published_at <=', $now)
                    ->orWhere('published_at', null)
                ->groupEnd()
                ->orderBy('published_at', 'DESC')
                ->findAll(),
        ];

        return view('news/index', $data);
    }

    public function create()
    {
        return view('news/create', ['pageTitle' => 'Create News']);
    }

    public function store()
    {
        $model = new NewsModel();
        $title = trim($this->request->getPost('title'));
        $content = trim($this->request->getPost('content'));

        $model->save([
            'title' => $title,
            'slug' => $this->generateUniqueSlug($title),
            'content' => $content,
            'excerpt' => $this->generateExcerpt($content),
            'status' => 'published',
            'author_id' => session()->get('user_id') ?? 1,
            'published_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/news');
    }

    public function delete($id)
    {
        $model = new NewsModel();

        $model->delete($id);

        
    return redirect()->to('/admin/news')
                     ->with('success', 'News deleted successfully');

    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($title)));
        $slug = trim($slug, '-');
        $slug = $slug === '' ? 'news-item' : $slug;

        $model = new NewsModel();
        $baseSlug = $slug;
        $counter = 1;

        while ($model->where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    private function generateExcerpt(string $content, int $length = 150): string
    {
        $clean = trim(strip_tags($content));

        if (strlen($clean) <= $length) {
            return $clean;
        }

        return substr($clean, 0, $length) . '...';
    }
}