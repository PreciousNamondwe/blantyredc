<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ApplicationModel;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\NotificationModel;
use App\Models\PaymentTransactionModel;
use App\Models\ApplicationStatusLogModel;
use App\Models\ProjectModel;
use App\Models\ElectedOfficialModel;
use App\Models\ManagementMemberModel;
use App\Models\NewsModel;
use App\Models\NoticesModel;
use App\Models\BusinessTypeModel;
use App\Libraries\SimplePdf;
use App\Models\ApplicationDataModel;
use App\Models\BusinessApplicationModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminController extends Controller
{
    protected $applicationModel;
    protected $userModel;
    protected $serviceModel;
    protected $notificationModel;
    protected $paymentModel;
    protected $statusLogModel;
    protected $projectModel;
    protected $officialModel;
    protected $managementMemberModel;
    protected $newsModel;
    protected $noticesModel;
    protected $businessTypeModel;

    public function __construct()
    {
        // Auto-load URL and Form Helpers for request handling 
        helper(['url', 'form']);

        $this->applicationModel      = new ApplicationModel();
        $this->businessTypeModel     = new BusinessTypeModel();
        $this->userModel             = new UserModel();
        $this->serviceModel          = new ServiceModel();
        $this->notificationModel     = new NotificationModel();
        $this->paymentModel          = new PaymentTransactionModel();
        $this->statusLogModel        = new ApplicationStatusLogModel();
        $this->projectModel          = new ProjectModel();
        $this->officialModel         = new ElectedOfficialModel();
        $this->managementMemberModel = new ManagementMemberModel();
        $this->newsModel             = new NewsModel();
        $this->noticesModel          = new NoticesModel();
    }

   /**
     * 1. ADMIN DASHBOARD METRICS OVERVIEW
     */
    public function dashboard()
    {
        $dashboardModel = new \App\Models\DashboardModel();
        $appStats = $dashboardModel->getApplicationStats();

        $stats = [
            'total_applications'        => $appStats['total_applications'],
            'pending_applications'      => $appStats['pending_applications'],
            'under_review_applications' => $appStats['under_review_applications'],
            'approved_applications'     => $appStats['approved_applications'],
            'total_users'               => $this->userModel->countAll(),
            'active_users'              => $this->userModel->where('is_active', true)->countAllResults(),
            'total_services'            => $this->serviceModel->countAll(),
            'active_services'           => $this->serviceModel->where('is_active', true)->countAllResults(),
            'total_notices'             => $this->noticesModel ? $this->noticesModel->countAll() : 0,
            'published_notices'         => $this->noticesModel ? $this->noticesModel->where('status', 'published')->countAllResults() : 0,
            'draft_notices'             => $this->noticesModel ? $this->noticesModel->where('status', 'draft')->countAllResults() : 0,
            'archived_notices'          => $this->noticesModel ? $this->noticesModel->where('status', 'archived')->countAllResults() : 0,
        ];

        $data = [
            'page_title'             => 'Admin Dashboard Overview',
            'page'                   => 'dashboard', 
            'stats'                  => $stats,
            'applications_by_status' => $dashboardModel->getApplicationsByStatus(),
            'recentApplications'     => $dashboardModel->getRecentSubmissions(6)
        ];

        return view('admin/layout/admin_master', $data);
    }
    
public function applications()
{
    $dashboardModel = new \App\Models\DashboardModel();
    
    $combinedData = [];
    try {
        $combinedData = $dashboardModel->getCombinedApplications();
    } catch (\Exception $e) {
        log_message('error', 'Applications Fetch Error: ' . $e->getMessage());
        return "Database Query Error Detected: " . $e->getMessage();
    }

    $data = [
        'page_title'   => 'All Service Applications',
        'page'         => 'applications',
        'applications' => $combinedData
    ];

    return view('admin/layout/admin_master', $data);
}
public function updateMarriageInline()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized Access Request'])->setStatusCode(403);
    }

    $json = $this->request->getJSON();
    $db = \Config\Database::connect();

    $updateFields = [
        'certificate_number'    => trim($json->certificate_number),
        'groom_national_id'     => trim($json->groom_national_id),
        'groom_first_name'      => trim($json->groom_first_name),
        'groom_last_name'       => trim($json->groom_last_name),
        'status'                => $json->status,
        'registration_fee_paid' => (float)$json->registration_fee_paid,
        'updated_at'            => date('Y-m-d H:i:s')
    ];

    $success = $db->table('marriage_certificates')->where('certificate_id', $json->certificate_id)->update($updateFields);

    return $this->response->setJSON($success 
        ? ['status' => 'success', 'message' => 'Marriage Profile Registry fields updated successfully!'] 
        : ['status' => 'error', 'message' => 'Database write failure encountered updating entity details.']);
}

public function updateBusinessInline()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Unauthorized Access Request'])->setStatusCode(403);
    }

    $json = $this->request->getJSON();
    $db = \Config\Database::connect();

    $updateFields = [
        'application_code'          => trim($json->application_code),
        'owner_national_id'         => trim($json->owner_national_id),
        'business_name'             => trim($json->business_name),
        'current_stage'             => $json->current_stage,
        'estimated_annual_turnover' => (float)$json->estimated_annual_turnover,
        'updated_at'                => date('Y-m-d H:i:s')
    ];

    $success = $db->table('businesses_application')->where('id', $json->id)->update($updateFields);

    return $this->response->setJSON($success 
        ? ['status' => 'success', 'message' => 'Business Profile Registry fields updated successfully!'] 
        : ['status' => 'error', 'message' => 'Database write failure encountered updating license details.']);
}
   /**
     * MAIN INDEX CATALOG LISTING
     */
    public function services()
    {
        $data = [
            'page_title' => 'Municipal Services Registry',
            'page'       => 'services', 
            'services'   => $this->serviceModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    

    /**
     * ACCEPTS NEW SUBMISSIONS FROM ENTRY MODAL
     */
    public function createService()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;

            if ($this->serviceModel->save($formData)) {
                return redirect()->to('admin/services')->with('success', 'Service pathway saved to database registry.');
            } else {
                return redirect()->to('admin/services')->withInput()->with('error', implode('<br>', $this->serviceModel->errors()));
            }
        }
        return redirect()->to('admin/services');
    }

/**
 * UNIFIED MODAL UPDATE TARGET ACTION
 */
public function editService($id = null)
{
    if ($id === null) {
        return redirect()->to(base_url('admin/services'))->with('error', 'Missing service identification key.');
    }

    $serviceModel = new \App\Models\ServiceModel(); 
    $service = $serviceModel->find($id);
    
    if (!$service) {
        return redirect()->to(base_url('admin/services'))->with('error', 'The target service registry key cannot be found.');
    }

    if ($this->request->is('post')) {
        $formData = $this->request->getPost();
        
        // Ensure standard toggle checkbox mapping
        $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;

        if (empty($formData['sort_order'])) {
            $formData['sort_order'] = 0;
        }

        // Trick CodeIgniter 4 validation into knowing the validation context ID
        $serviceModel->setValidationRule('service_key', "required|max_length[100]|is_unique[services.service_key,id,{$id}]");

        // Force explicit update targeting
        if ($serviceModel->update($id, $formData)) {
            return redirect()->to(base_url('admin/services'))->with('success', 'Changes updated cleanly onto database registry.');
        } else {
            // This will capture and display the exact validation errors on screen so you can see what failed
            $errorString = implode('<br>', $serviceModel->errors() ?: ['Database rejected write execution configuration.']);
            return redirect()->to(base_url('admin/services'))->withInput()->with('error', $errorString);
        }
    }
    
    return redirect()->to(base_url('admin/services'));
}

    public function deleteService($id = null)
    {
        // 1. Safety check to ensure an ID actually arrived
        if ($id === null) {
            return redirect()->to(base_url('admin/services'))->with('error', 'Invalid Service ID requested.');
        }

        // 2. Initialize your model (replace with your actual Model name)
        $serviceModel = new \App\Models\ServiceModel(); 

        // 3. Check if the record actually exists in your database
        $service = $serviceModel->find($id);
        if (!$service) {
            return redirect()->to(base_url('admin/services'))->with('error', 'Service pathway record not found.');
        }

        // 4. Perform the deletion block
        if ($serviceModel->delete($id)) {
            return redirect()->to(base_url('admin/services'))->with('success', 'Service pathway purged successfully.');
        } else {
            return redirect()->to(base_url('admin/services'))->with('error', 'Database restriction prevented deletion.');
        }
    }

/**
     * 5. CIVIL DEVELOPMENT INITIATIVES (PROJECTS)
     * LIST REGISTRY INDEX DISPLAY
     */
    public function projects()
    {
        $data = [
            'page_title' => 'District Development Projects',
            'page'       => 'projects', 
            'projects'   => $this->projectModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * PROCESS CREATION PATHWAY FROM MODAL ENGINES
     */
    public function createProject()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;

            if ($this->projectModel->save($formData)) {
                return redirect()->to('admin/projects')->with('success', 'Development baseline project initialized.');
            } else {
                return redirect()->to('admin/projects')->withInput()->with('error', 'Failed to initialize project entry parameters.');
            }
        }
        return redirect()->to('admin/projects');
    }

    /**
     * UNIFIED MODAL ACTION HOOK TARGET FOR RECORD MODIFICATION
     */
    public function editProject($id)
    {
        $project = $this->projectModel->find($id);
        if (!$project) {
            return redirect()->to('admin/projects')->with('error', 'Target system project node trace unavailable.');
        }

        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;

            if ($this->projectModel->update($id, $formData)) {
                return redirect()->to('admin/projects')->with('success', 'Project specifications recalibrated.');
            } else {
                return redirect()->to('admin/projects')->withInput()->with('error', 'Failed to save updated system tracking metrics.');
            }
        }
        return redirect()->to('admin/projects');
    }

    /**
     * PURGE SYSTEM PROJECT SPECIFICATION RECORDS
     */
    public function deleteProject($id)
    {   
        if ($this->projectModel->find($id)) {
            $this->projectModel->delete($id);
            return redirect()->to('admin/projects')->with('success', 'Project execution node scrubbed.');
        }
        return redirect()->to('admin/projects')->with('error', 'Unable to trace target operational project element.');
    }
    /**
     * 6. ELECTED OFFICIALS & MANAGEMENT STRUCTURES
     */
    public function officials()
    {
        $data = [
            'page_title' => 'Civic Leadership Council',
            'page'       => 'officials', 
            'officials'  => $this->officialModel->orderBy('sort_order', 'ASC')->findAll(),
            'members'    => $this->managementMemberModel->orderBy('sort_order', 'ASC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * Create elected official via Modal Context
     */
    public function createOfficial()
    {
        if ($this->request->is('post')) {
            log_message('debug', 'AdminController::createOfficial POST received via Modal');

            $photoFile = $this->request->getFile('photo');
            $rules = [
                'name'       => 'required|max_length[255]',
                'position'   => 'required|max_length[255]',
                'department' => 'permit_empty|max_length[100]',
                'bio'        => 'permit_empty',
                'is_active'  => 'permit_empty|in_list[0,1]',
            ];

            if ($photoFile && $photoFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,5120]';
            }

            if (!$this->validate($rules)) {
                return redirect()
                    ->to(base_url('admin/officials?tab=officials'))
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $photoPath = null;
            if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
                $photoPath = $this->saveOfficialPhoto($photoFile);

                if ($photoPath === false) {
                    return redirect()
                        ->to(base_url('admin/officials?tab=officials'))
                        ->withInput()
                        ->with('error', 'Photo upload failed. Please try again.');
                }
            }

            $officialData = [
                'name'       => $this->request->getPost('name'),
                'position'   => $this->request->getPost('position'),
                'department' => $this->request->getPost('department'),
                'bio'        => $this->request->getPost('bio'),
                'sort_order' => $this->getNextSortOrder($this->officialModel),
                'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
            ];

            if ($photoPath) {
                $officialData['photo'] = $photoPath;
            }

            $insertId = $this->officialModel->insert($officialData);

            if ($insertId) {
                return redirect()
                    ->to(base_url('admin/officials?tab=officials'))
                    ->with('success', 'Official profile added successfully.');
            }

            $errors = $this->officialModel->errors();
            if (!empty($errors)) {
                return redirect()
                    ->to(base_url('admin/officials?tab=officials'))
                    ->withInput()
                    ->with('errors', $errors);
            }

            $dbError = $this->officialModel->db->error()['message'] ?? 'Unknown database error';
            return redirect()
                ->to(base_url('admin/officials?tab=officials'))
                ->withInput()
                ->with('error', 'Failed to create official: ' . $dbError);
        }

        return redirect()->to(base_url('admin/officials?tab=officials'));
    }

    /**
     * Edit elected official from Modal processing endpoint
     */
    public function editOfficial($id)
    {
        $official = $this->officialModel->find($id);

        if (!$official) {
            return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Official profile missing.');
        }

        if ($this->request->is('post')) {
            $photoFile = $this->request->getFile('photo');

            $rules = [
                'name'       => 'required|max_length[255]',
                'position'   => 'required|max_length[255]',
                'department' => 'permit_empty|max_length[100]',
                'phone'      => 'permit_empty|max_length[20]',
                'email'      => 'permit_empty|valid_email|max_length[255]',
                'bio'        => 'permit_empty',
                'sort_order' => 'permit_empty|integer',
                'is_active'  => 'permit_empty|in_list[0,1]',
            ];

            if ($photoFile && $photoFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,5120]';
            }

            if (!$this->validate($rules)) {
                return redirect()
                    ->to(base_url('admin/officials?tab=officials'))
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $data = [
                'name'       => $this->request->getPost('name'),
                'position'   => $this->request->getPost('position'),
                'department' => $this->request->getPost('department'),
                'phone'      => $this->request->getPost('phone'),
                'email'      => $this->request->getPost('email'),
                'bio'        => $this->request->getPost('bio'),
                'sort_order' => $this->request->getPost('sort_order') ?? $official['sort_order'],
                'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
            ];

            if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
                $photoPath = $this->saveOfficialPhoto($photoFile);

                if ($photoPath) {
                    $data['photo'] = $photoPath;
                    
                    // Cleanup previous photo to save space
                    if (!empty($official['photo']) && file_exists(FCPATH . $official['photo'])) {
                        @unlink(FCPATH . $official['photo']);
                    }
                }
            }

            $updated = $this->officialModel->update($id, $data);

            if ($updated) {
                return redirect()
                    ->to(base_url('admin/officials?tab=officials'))
                    ->with('success', 'Official metrics profile updated successfully.');
            }

            return redirect()
                ->to(base_url('admin/officials?tab=officials'))
                ->withInput()
                ->with('error', 'Failed to update official profiles configurations.');
        }

        return redirect()->to(base_url('admin/officials?tab=officials'));
    }

    /**
     * Delete elected official via Modal Trigger
     */
 public function deleteOfficial($id = null)
{
    // 1. Instantly check if an ID was passed at all
    if ($id === null) {
        return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Missing official identifier asset key.');
    }

    // 2. Safeguard request context verification
    $method = strtolower($this->request->getMethod());
    if ($method !== 'post') {
        return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Invalid request method context submission.');
    }

    // 3. FIXED: Explicitly load the model matching your exact class name
    $electedOfficialModel = new \App\Models\ElectedOfficialModel();

    // 4. FIXED: Use the local variable instead of $this->officialModel
    $official = $electedOfficialModel->find($id);
    if (!$official) {
        return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Official data asset missing.');
    }

    try {
        // 5. Clean up associated profile image file from the disk if present
        if (!empty($official['photo']) && file_exists(FCPATH . $official['photo'])) {
            @unlink(FCPATH . $official['photo']);
        }
        
        // 6. FIXED: Execute deletion on the local model instance
        $electedOfficialModel->delete($id);
        
        return redirect()->to(base_url('admin/officials?tab=officials'))->with('success', 'Official profile removed safely.');
    } catch (\Exception $e) {
        log_message('error', 'Failed to delete official: ' . $e->getMessage());
        return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Failed to complete deletion routing workflow.');
    }
}

    /**
     * Create Management Profile Member via Modal Context
     */
    public function createManagement()
    {
        if ($this->request->is('post')) {
            $photoFile = $this->request->getFile('photo');
            $rules = [
                'name'     => 'required|max_length[255]',
                'position' => 'required|max_length[255]',
            ];

            if ($photoFile && $photoFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,5120]';
            }

            if (!$this->validate($rules)) {
                return redirect()
                    ->to(base_url('admin/officials?tab=management'))
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $data = [
                'name'       => $this->request->getPost('name'),
                'position'   => $this->request->getPost('position'),
                'email'      => $this->request->getPost('email'),
                'phone'      => $this->request->getPost('phone'),
                'bio'        => $this->request->getPost('bio'),
                'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
                'sort_order' => $this->getNextSortOrder($this->managementMemberModel),
            ];

            if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
                $photoPath = $this->saveOfficialPhoto($photoFile);
                if ($photoPath) {
                    $data['photo'] = $photoPath;
                }
            }

            $this->managementMemberModel->insert($data);
            return redirect()->to(base_url('admin/officials?tab=management'))->with('success', 'Management profile generated successfully.');
        }
        return redirect()->to(base_url('admin/officials?tab=management'));
    }

    /**
     * Edit Management Profile Member from Modal Form
     */
    public function editManagement($id)
    {
        $member = $this->managementMemberModel->find($id);
        if (!$member) {
            return redirect()->to(base_url('admin/officials?tab=management'))->with('error', 'Target member record profile missing.');
        }

        if ($this->request->is('post')) {
            $photoFile = $this->request->getFile('photo');
            $rules = [
                'name'     => 'required|max_length[255]',
                'position' => 'required|max_length[255]',
            ];

            if ($photoFile && $photoFile->getError() !== UPLOAD_ERR_NO_FILE) {
                $rules['photo'] = 'is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,5120]';
            }

            if (!$this->validate($rules)) {
                return redirect()
                    ->to(base_url('admin/officials?tab=management'))
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            $updateData = [
                'name'       => $this->request->getPost('name'),
                'position'   => $this->request->getPost('position'),
                'email'      => $this->request->getPost('email'),
                'phone'      => $this->request->getPost('phone'),
                'bio'        => $this->request->getPost('bio'),
                'sort_order' => $this->request->getPost('sort_order') ?? $member['sort_order'],
                'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
            ];

            if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
                $photoPath = $this->saveOfficialPhoto($photoFile);
                if ($photoPath) {
                    $updateData['photo'] = $photoPath;
                    
                    if (!empty($member['photo']) && file_exists(FCPATH . $member['photo'])) {
                        @unlink(FCPATH . $member['photo']);
                    }
                }
            }

            $this->managementMemberModel->update($id, $updateData);
            return redirect()->to(base_url('admin/officials?tab=management'))->with('success', 'Management profile record updated successfully.');
        }
        return redirect()->to(base_url('admin/officials?tab=management'));
    }

    /**
     * Delete Management Profile Member via Modal Context Form
     */
    public function deleteManagement($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->to(base_url('admin/officials?tab=management'))->with('error', 'Invalid request method');
        }

        $member = $this->managementMemberModel->find($id);
        if ($member) {
            if (!empty($member['photo']) && file_exists(FCPATH . $member['photo'])) {
                @unlink(FCPATH . $member['photo']);
            }
            $this->managementMemberModel->delete($id);
            return redirect()->to(base_url('admin/officials?tab=management'))->with('success', 'Management record completely removed.');
        }
        return redirect()->to(base_url('admin/officials?tab=management'))->with('error', 'Deletion context execution node failure.');
    }
     public function news()
    {
        $data = [
            'page_title' => 'Press Release Ledger',
            'page'       => 'news', 
            'news'       => $this->newsModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * Create/Insert a new News Entry
     */
    public function createNews()
    {
        // 1. Gather all fields matching your NewsModel $allowedFields
        $data = [
            'title'          => $this->request->getPost('title'),
            'slug'           => $this->request->getPost('slug'),
            'content'        => $this->request->getPost('content'),
            'excerpt'        => $this->request->getPost('excerpt'),
            'featured_image' => $this->request->getPost('featured_image'),
            'status'         => $this->request->getPost('status'),
            'published_at'   => $this->request->getPost('published_at') ?: null,
            'author_id'      => session()->get('user_id') ?? 1, // Fallback safely if auth isn't setup
        ];

        // 2. Perform the save operation
        if ($this->newsModel->insert($data)) {
            return redirect()->to(base_url('admin/news'))
                             ->with('success', 'Press release successfully drafted and saved into registry.');
        } else {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Failed to save news entry. Please check validation limits.');
        }
    }

    /**
     * Update/Edit an existing News Entry
     */
    public function editNews($id)
    {
        // 1. Confirm the record actually exists before attempting changes
        $newsItem = $this->newsModel->find($id);
        if (!$newsItem) {
            return redirect()->to(base_url('admin/news'))
                             ->with('error', 'The targeted news record could not be found.');
        }

        // 2. Gather modified values from the unified inline form
        $data = [
            'title'          => $this->request->getPost('title'),
            'slug'           => $this->request->getPost('slug'),
            'content'        => $this->request->getPost('content'),
            'excerpt'        => $this->request->getPost('excerpt'),
            'featured_image' => $this->request->getPost('featured_image'),
            'status'         => $this->request->getPost('status'),
            'published_at'   => $this->request->getPost('published_at') ?: null,
        ];

        // 3. Process database update
        if ($this->newsModel->update($id, $data)) {
            return redirect()->to(base_url('admin/news'))
                             ->with('success', 'News publication schema has been successfully recalibrated.');
        } else {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Failed to update changes. Verify your inputs.');
        }
    }


    /**
     * Delete a News Entry
     */
    public function deleteNews($id)
    {
        // 1. Verify existence before deletion
        if (!$this->newsModel->find($id)) {
            return redirect()->to(base_url('admin/news'))
                             ->with('error', 'Target record does not exist or has already been dropped.');
        }

        // 2. Clear out row from storage
        if ($this->newsModel->delete($id)) {
            return redirect()->to(base_url('admin/news'))
                             ->with('success', 'The news announcement has been permanently purged from the index.');
        } else {
            return redirect()->to(base_url('admin/news'))
                             ->with('error', 'An operational error occurred while trying to delete this item.');
        }
    }
   
    /**
     * View Modal Target Component Data
     */
    public function viewModal($id = null)
    {
        if (empty($id) || !is_numeric($id)) {
            return $this->response
                        ->setStatusCode(400)
                        ->setBody('<div class="alert alert-danger m-3">Missing or invalid Application ID parameter.</div>');
        }

        try {
            $dataModel = new ApplicationDataModel();
            $rawApplicationData = $dataModel->getApplicationData($id);

            $processedData = [];
            $detectedApplicationType = '';

            $blacklistedGroups = ['form_data', 'form_fields', 'form_config', 'structural_state', 'service_form'];
            $blacklistedKeys   = ['id', 'id_copy', 'document_hash'];

            if (!empty($rawApplicationData) && is_array($rawApplicationData)) {
                foreach ($rawApplicationData as $groupName => $fields) {
                    $normalizedGroup = strtolower(trim($groupName));
                    
                    if (in_array($normalizedGroup, $blacklistedGroups)) {
                        continue;
                    }

                    if (!is_array($fields)) {
                        continue;
                    }

                    $filteredGroupFields = [];
                    foreach ($fields as $key => $value) {
                        $normalizedKey = strtolower(trim($key));

                        if (in_array($normalizedKey, $blacklistedKeys)) {
                            continue;
                        }

                        if (empty($detectedApplicationType) && in_array($normalizedKey, ['application_type', 'type', 'form_type', 'service_type', 'service_key'])) {
                            if (!is_array($value)) {
                                $detectedApplicationType = (string)$value;
                            }
                        }

                        $filteredGroupFields[$key] = $value;
                    }

                    if (!empty($filteredGroupFields)) {
                        $processedData[$groupName] = $filteredGroupFields;
                    }
                }
            }

            $data = [
                'page_title'      => 'Application Details Dossier Context',
                'page'            => 'application_details', 
                'id'              => $id,
                'applicationType' => $detectedApplicationType, 
                'applicationData' => $processedData
            ];

            return view('admin/layout/admin_master', $data);

        } catch (\Exception $e) {
            log_message('error', 'Modal Loading Exception: ' . $e->getMessage());
            return $this->response
                        ->setStatusCode(500)
                        ->setBody('<div class="alert alert-danger m-3">Internal server error loading application details.</div>');
        }
    }

    /**
     * Save elected official & management photo upload safely
     */
    private function saveOfficialPhoto($file)
    {
        $uploadPath = FCPATH . 'image/officials/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $newName = $file->getRandomName();

        try {
            $file->move($uploadPath, $newName);
        } catch (\Exception $e) {
            log_message('error', 'Official/Management photo upload failed: ' . $e->getMessage());
            return false;
        }

        return 'image/officials/' . $newName;
    }

   /**
     * 10. PUBLIC NOTICES CRUD WORKFLOW (Rendered as Notifications)
     * READ: Display all notices in a registry queue
     */
    public function notices()
    {
        $data = [
            'page_title' => 'Public Notices & Bulletins Registry',
            'page'       => 'notifications', // <-- Crucial: This tells admin_master to load admin/notifications.php
            'notices'    => $this->noticesModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

   public function createNotice()
    {
        if ($this->request->is('post')) {
            $formData = [
                'title'         => $this->request->getPost('title'),
                'content'       => $this->request->getPost('content'),
                'reference'     => $this->request->getPost('reference'),
                'category'      => $this->request->getPost('category'),
                'urgency_level' => $this->request->getPost('urgency_level'),
                'status'        => $this->request->getPost('status'),
                'published_at'  => $this->request->getPost('status') === 'published' ? date('Y-m-d H:i:s') : null,
                'author_id'     => session()->get('user_id') ?? 1
            ];

            // The model auto-validates via protected $validationRules matrix
            if ($this->noticesModel->insert($formData)) {
                return redirect()->to(base_url('admin/notifications'))
                                 ->with('success', 'Public board alert bulletin successfully initialized.');
            } else {
                return redirect()->back()
                                 ->withInput()
                                 ->with('errors', $this->noticesModel->errors());
            }
        }
        return redirect()->to(base_url('admin/notifications'));
    }

    public function editNotice($id = null)
    {
        $notice = $this->noticesModel->find($id);
        if (!$notice) {
            return redirect()->to(base_url('admin/notifications'))->with('error', 'Registry entry missing.');
        }

        if ($this->request->is('post')) {
            $formData = [
                'title'         => $this->request->getPost('title'),
                'content'       => $this->request->getPost('content'),
                'reference'     => $this->request->getPost('reference'),
                'category'      => $this->request->getPost('category'),
                'urgency_level' => $this->request->getPost('urgency_level'),
                'status'        => $this->request->getPost('status'),
            ];

            if ($this->request->getPost('status') === 'published' && $notice['status'] !== 'published') {
                $formData['published_at'] = date('Y-m-d H:i:s');
            }

            if ($this->noticesModel->update($id, $formData)) {
                return redirect()->to(base_url('admin/notifications'))->with('success', 'Specifications updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->noticesModel->errors());
            }
        }
        return redirect()->to(base_url('admin/notifications'));
    }
    /**
 * UNIFIED PUBLIC NOTICE DELETION ENGINE ACTION
 */
public function deleteNotice($id = null)
{
    // 1. Fallback barrier if no ID is passed
    if ($id === null) {
        return redirect()->to(base_url('admin/notifications'))->with('error', 'Missing notice identification asset key.');
    }

    // 2. Safeguard request context verification (Ensures POST submission execution)
    $method = strtolower($this->request->getMethod());
    if ($method !== 'post') {
        return redirect()->to(base_url('admin/notifications'))->with('error', 'Invalid request method context submission.');
    }

    // 3. Fallback: Initialize model locally if $this->noticesModel is ever uninstantiated
    $noticesModel = $this->noticesModel ?? new \App\Models\NoticeModel(); // Adjust namespace if your model has a different name

    // 4. Locate the existing entry registry row to make sure it exists
    $notice = $noticesModel->find($id);
    if (!$notice) {
        return redirect()->to(base_url('admin/notifications'))->with('error', 'The target bulletin registry entry cannot be found.');
    }

    try {
        // 5. Execute deletion on the target record row
        $noticesModel->delete($id);
        
        return redirect()->to(base_url('admin/notifications'))->with('success', 'Public board alert bulletin removed safely.');
    } catch (\Exception $e) {
        // Log the exact database or processing problem quietly behind the scenes
        log_message('error', 'Failed to delete notice registry item: ' . $e->getMessage());
        return redirect()->to(base_url('admin/notifications'))->with('error', 'System internal constraint rejected deletion routing workflow.');
    }
}

    /**
     * 3. USER MANAGEMENT CONTROLS
     */
   /**
     * 3. USER MANAGEMENT CONTROLS
     */
    public function users()
    {
        // 1. Pull current user identity context directly from database/session check
        $currentUserId = session()->get('user_id') ?? 1; // Fallback default to matching admin entry id
        $currentUser = $this->userModel->find($currentUserId);
        
        // 2. Extract accurate role designation directly from the data row array
        $currentUserRole = $currentUser ? $currentUser['role'] : 'staff';

        // 3. RBAC PERMISSION GATE: Block unrecognized identities from entering this space completely
        if (!in_array($currentUserRole, ['admin', 'department_head', 'staff', 'reviewer'])) {
            return redirect()->to('admin/dashboard')->with('errors', ['Access Denied: Insufficient infrastructure clearance.']);
        }

        // 4. Fetch user list array matrix ordered by registration timestamp sequence
        $userData = $this->userModel->orderBy('id', 'DESC')->findAll();

        $data = [
            'page_title'   => 'System Identity Profiles',
            'page'         => 'users', 
            'users'        => $userData,
            'members'      => $userData,
            'current_role' => $currentUserRole // Passed explicitly so the view layer can read it instantly
        ];
        
        return view('admin/layout/admin_master', $data);
    }
/**
 * ADMINISTRATIVE SECURITY USER CREATION LOGIC
 */
public function createUser()
{
    // 1. Guard check access permissions
    if (session()->get('role') !== 'admin') {
        return redirect()->to(base_url('admin/users'))->with('error', 'Unauthorized administrative clearance access.');
    }

    if ($this->request->is('post')) {
        $userModel = new \App\Models\UserModel();

        // 2. Map all standard incoming view data items
        $formData = [
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'password'   => $this->request->getPost('password'), // Validated by updated Model rule
            'full_name'  => $this->request->getPost('full_name'),
            'role'       => $this->request->getPost('role'),
            'department' => $this->request->getPost('department') ?: null,
            'phone'      => $this->request->getPost('phone') ?: null,
            'is_active'  => 1 // Default status active on initial instantiation
        ];

        // 3. Fire database insert action execution
        if ($userModel->insert($formData)) {
            return redirect()->to(base_url('admin/users'))->with('success', 'Security profile node provisioned successfully into core directory matrix.');
        } else {
            // Send back errors cleanly if the values violate uniqueness or size checks
            return redirect()->back()->withInput()->with('errors', $userModel->errors());
        }
    }

    return redirect()->to(base_url('admin/users'));
}
    public function editUser($id = null)
    {
        // STRICT RBAC GATE: Only 'admin' can overwrite identity vectors
        if (session()->get('role') !== 'admin') {
            return redirect()->to('admin/users')->with('errors', ['Unauthorized Action: Administrative privileges required to mutate security tokens.']);
        }

        if (!$user = $this->userModel->find($id)) {
            return redirect()->to('admin/users')->with('errors', ['Target security profile record signature not found.']);
        }

        if ($this->request->is('post')) {
            $formData = [
                'full_name'  => $this->request->getPost('full_name'),
                'username'   => $this->request->getPost('username'),
                'email'      => $this->request->getPost('email'),
                'role'       => $this->request->getPost('role'),
                'department' => $this->request->getPost('department'),
                'phone'      => $this->request->getPost('phone'),
                'is_active'  => $this->request->getPost('is_active')
            ];

            $newPassword = $this->request->getPost('password');
            if (!empty($newPassword)) {
                $formData['password'] = $newPassword;
            }

            // Adjust validation rules constraints dynamically to prevent self-uniqueness collisions
            $this->userModel->setValidationRule('username', "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]");
            $this->userModel->setValidationRule('email', "required|valid_email|max_length[255]|is_unique[users.email,id,{$id}]");
            $this->userModel->setValidationRule('password_hash', 'permit_empty');

            if ($this->userModel->update($id, $formData)) {
                return redirect()->to('admin/users')->with('success', 'Security authentication tokens updated successfully.');
            } else {
                return redirect()->to('admin/users')->withInput()->with('errors', $this->userModel->errors());
            }
        }

        $data = [
            'page_title' => 'Configure Security Account Profile',
            'page'       => 'users_edit',
            'user'       => $user
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function deleteUser($id = null)
    {
        // STRICT RBAC GATE: Only 'admin' can evict system items
        if (session()->get('role') !== 'admin') {
            return redirect()->to('admin/users')->with('errors', ['Unauthorized Action: Administrative privileges required to execute purge protocols.']);
        }

        // Prevent self-destruction tracking routines
        if (session()->get('user_id') == $id) {
            return redirect()->to('admin/users')->with('errors', ['Security rule triggered: Self-deletion parameter blocks execution.']);
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('admin/users')->with('success', 'Target security node unprovisioned from operational records.');
        }

        return redirect()->to('admin/users')->with('errors', ['Failed verification sequence during profile eviction processing routine.']);
    }

    /**
     * Utility method to safely get the incremented sorting target index variable sequence
     */
    private function getNextSortOrder($model)
    {
        $maxOrderRow = $model->selectMax('sort_order')->first();
        $maxOrder = isset($maxOrderRow['sort_order']) ? (int)$maxOrderRow['sort_order'] : 0;
        return $maxOrder + 1;
    }

    
}