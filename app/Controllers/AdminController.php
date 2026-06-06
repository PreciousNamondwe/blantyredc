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
        $stats = [
            'total_applications'        => $this->applicationModel->countAll(),
            'pending_applications'      => $this->applicationModel->where('status', 'submitted')->countAllResults(),
            'under_review_applications' => $this->applicationModel->where('status', 'under_review')->countAllResults(),
            'approved_applications'     => $this->applicationModel->where('status', 'approved')->countAllResults(),
            'completed_applications'    => $this->applicationModel->where('status', 'completed')->countAllResults(),
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
            'page_title' => 'Admin Dashboard Overview',
            'page'       => 'dashboard', 
            'stats'      => $stats
        ];

        return view('admin/layout/admin_master', $data);
    }

    /**
     * 2. APPLICATION MANAGEMENT WORKFLOWS
     */
    public function applications()
    {
        $data = [
            'page_title'   => 'General Applications Queue',
            'page'         => 'applications', 
            'applications' => $this->applicationModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function businessApplications()
    {
        $data = [
            'page_title'   => 'Commercial Business Applications',
            'page'         => 'business-applications', 
            'applications' => $this->applicationModel->where('category', 'business')->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function applicationDetails($id)
    {
        $data = [
            'page_title'  => 'Application Dossier #' . $id,
            'page'        => 'application_detail', 
            'application' => $this->applicationModel->find($id),
            'logs'        => $this->statusLogModel->where('application_id', $id)->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function updateApplicationStatus($id)
    {
        $status = $this->request->getPost('status');
        $comment = $this->request->getPost('comment');

        $this->applicationModel->update($id, ['status' => $status]);
        $this->statusLogModel->insert([
            'application_id' => $id,
            'status'         => $status,
            'comment'        => $comment,
            'changed_by'     => session()->get('user_id') ?? 1
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    /**
     * 3. USER MANAGEMENT CONTROLS
     */
    public function users()
    {
        $data = [
            'page_title' => 'System Identity Profiles',
            'page'       => 'users', 
            'users'      => $this->userModel->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function createUser()
    {
        if ($this->request->is('post')) {
            $this->userModel->save($this->request->getPost());
            return redirect()->to('admin/users')->with('success', 'User access context instantiated successfully.');
        }

        $data = [
            'page_title' => 'Register System Account',
            'page'       => 'users_create' 
        ];
        return view('admin/layout/admin_master', $data);
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
        $service = $this->serviceModel->find($id);
        if (!$service) {
            return redirect()->to('admin/services')->with('error', 'The target service registry key cannot be loaded.');
        }

        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            $formData['id'] = $id; // Force update constraint match
            $formData['is_active'] = isset($formData['is_active']) ? 1 : 0;

            if ($this->serviceModel->save($formData)) {
                return redirect()->to('admin/services')->with('success', 'Changes updated cleanly onto current dashboard record.');
            } else {
                return redirect()->to('admin/services')->withInput()->with('error', implode('<br>', $this->serviceModel->errors()));
            }
        }
        return redirect()->to('admin/services');
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
    public function deleteOfficial($id)
    {
        if (!$this->request->is('post')) {
            return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Invalid request method');
        }

        $official = $this->officialModel->find($id);
        if (!$official) {
            return redirect()->to(base_url('admin/officials?tab=officials'))->with('error', 'Official data asset missing.');
        }

        try {
            if (!empty($official['photo']) && file_exists(FCPATH . $official['photo'])) {
                @unlink(FCPATH . $official['photo']);
            }
            $this->officialModel->delete($id);
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

    /**
     * 7. PRESS RELEASES, COMMUNICATIONS, & BOARD NOTICES
     */
    public function news()
    {
        $data = [
            'page_title' => 'Press Release Ledger',
            'page'       => 'news', 
            'news'       => $this->newsModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function notices()
    {
        $data = [
            'page_title' => 'Gazette Board Notices & Tenders',
            'page'       => 'notices', 
            'notices'    => $this->noticesModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * 8. FINANCE & REVENUE AUDIT BLOCK
     */
    public function payments()
    {
        $data = [
            'page_title'   => 'Transactional Invoicing Logs',
            'page'         => 'payments', 
            'transactions' => $this->paymentModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
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
     * 9. DISPATCH PIPELINES & ALERTS
     */
    public function notifications()
    {
        $data = [
            'page_title'    => 'Alert Notifications Stream',
            'page'          => 'notifications', 
            'notifications' => $this->notificationModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
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
     * Utility method to safely get the incremented sorting target index variable sequence
     */
    private function getNextSortOrder($model)
    {
        $maxOrderRow = $model->selectMax('sort_order')->first();
        $maxOrder = isset($maxOrderRow['sort_order']) ? (int)$maxOrderRow['sort_order'] : 0;
        return $maxOrder + 1;
    }
}