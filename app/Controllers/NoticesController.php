<?php

namespace App\Controllers;

use App\Models\NoticesModel;
use CodeIgniter\HTTP\ResponseInterface;

class NoticesController extends BaseController
{
    protected $noticesModel;
    protected $perPage = 10;

    public function __construct()
    {
        $this->noticesModel = new NoticesModel();
    }

    /**
     * Display list of notices
     */
    public function index()
    {
        try {
            // Get pagination
            $page = (int)($this->request->getGet('page') ?? 1);
            $offset = ($page - 1) * $this->perPage;

            // Get category filter if provided
            $category = $this->request->getGet('category');
            $search = $this->request->getGet('search');

            // Fetch notices based on filters
            if ($search) {
                $notices = $this->noticesModel->searchNotices($search, $this->perPage, $offset);
                $total = $this->noticesModel->where('status', 'published')
                                            ->where('published_at <=', date('Y-m-d H:i:s'))
                                            ->groupStart()
                                                ->like('title', $search)
                                                ->orLike('content', $search)
                                                ->orLike('reference', $search)
                                            ->groupEnd()
                                            ->countAllResults();
            } elseif ($category) {
                $notices = $this->noticesModel->getNoticesByCategory($category, $this->perPage, $offset);
                $total = $this->noticesModel->where('status', 'published')
                                            ->where('category', $category)
                                            ->where('published_at <=', date('Y-m-d H:i:s'))
                                            ->countAllResults();
            } else {
                $notices = $this->noticesModel->getPublishedNotices($this->perPage, $offset);
                $total = $this->noticesModel->getPublishedCount();
            }

            // Calculate pagination
            $totalPages = ceil($total / $this->perPage);

            // Get urgent notices for sidebar
            $urgentNotices = $this->noticesModel->getUrgentNotices(5);

            // Get categories
            $categories = $this->noticesModel->getCategoriesWithCount();

            $data = [
                'pageTitle' => 'Tenders',
                'notices' => $notices,
                'urgent_notices' => $urgentNotices,
                'categories' => $categories,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_notices' => $total,
                'per_page' => $this->perPage,
                'current_category' => $category,
                'search_query' => $search,
            ];

            return view('notices/index', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in NoticesController::index - ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display single notice
     */
    public function detail($slug = '')
    {
        try {
            if (!$slug) {
                throw new \Exception('Notice slug is required');
            }

            $notice = $this->noticesModel->getNoticeBySlug($slug);

            if (!$notice) {
                throw new \Exception('Notice not found', 404);
            }

            // Get related notices from same category
            $relatedNotices = $this->noticesModel->where('status', 'published')
                                                 ->where('category', $notice['category'])
                                                 ->where('id !=', $notice['id'])
                                                 ->where('published_at <=', date('Y-m-d H:i:s'))
                                                 ->orderBy('published_at', 'DESC')
                                                 ->limit(5)
                                                 ->findAll();

            // Get urgent notices for sidebar
            $urgentNotices = $this->noticesModel->getUrgentNotices(5);

            $data = [
                'pageTitle' => $notice['title'],
                'notice' => $notice,
                'related_notices' => $relatedNotices,
                'urgent_notices' => $urgentNotices,
            ];

            return view('notices/detail', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in NoticesController::detail - ' . $e->getMessage());
            
            if ($e->getCode() === 404) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            
            throw $e;
        }
    }

    /**
     * API: Get urgent notices
     */
    public function getUrgentNotices()
    {
        try {
            $notices = $this->noticesModel->getUrgentNotices(10);
            
            return $this->response
                        ->setStatusCode(200)
                        ->setContentType('application/json')
                        ->setJSON(['success' => true, 'data' => $notices]);
        } catch (\Exception $e) {
            log_message('error', 'Error in NoticesController::getUrgentNotices - ' . $e->getMessage());
            
            return $this->response
                        ->setStatusCode(500)
                        ->setContentType('application/json')
                        ->setJSON(['success' => false, 'message' => 'Error fetching notices']);
        }
    }

    /**
     * API: Get recent notices
     */
    public function getRecentNotices()
    {
        try {
            $limit = (int)($this->request->getGet('limit') ?? 5);
            $notices = $this->noticesModel->getRecentNotices($limit);
            
            return $this->response
                        ->setStatusCode(200)
                        ->setContentType('application/json')
                        ->setJSON(['success' => true, 'data' => $notices]);
        } catch (\Exception $e) {
            log_message('error', 'Error in NoticesController::getRecentNotices - ' . $e->getMessage());
            
            return $this->response
                        ->setStatusCode(500)
                        ->setContentType('application/json')
                        ->setJSON(['success' => false, 'message' => 'Error fetching notices']);
        }
    }

    /**
     * API: Search notices
     */
    public function search()
    {
        try {
            $keyword = $this->request->getGet('q');
            
            if (!$keyword) {
                return $this->response
                            ->setStatusCode(400)
                            ->setContentType('application/json')
                            ->setJSON(['success' => false, 'message' => 'Search keyword is required']);
            }

            $page = (int)($this->request->getGet('page') ?? 1);
            $offset = ($page - 1) * $this->perPage;
            
            $notices = $this->noticesModel->searchNotices($keyword, $this->perPage, $offset);
            $total = $this->noticesModel->where('status', 'published')
                                        ->where('published_at <=', date('Y-m-d H:i:s'))
                                        ->groupStart()
                                            ->like('title', $keyword)
                                            ->orLike('content', $keyword)
                                            ->orLike('reference', $keyword)
                                        ->groupEnd()
                                        ->countAllResults();
            
            return $this->response
                        ->setStatusCode(200)
                        ->setContentType('application/json')
                        ->setJSON([
                            'success' => true,
                            'data' => $notices,
                            'total' => $total,
                            'page' => $page,
                            'per_page' => $this->perPage,
                            'total_pages' => ceil($total / $this->perPage)
                        ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in NoticesController::search - ' . $e->getMessage());
            
            return $this->response
                        ->setStatusCode(500)
                        ->setContentType('application/json')
                        ->setJSON(['success' => false, 'message' => 'Error searching notices']);
        }
    }
}
