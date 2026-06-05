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
            'page'       => 'dashboard', // Loads app/Views/admin/dashboard.php
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
            'page'         => 'applications', // Loads app/Views/admin/applications.php
            'applications' => $this->applicationModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function businessApplications()
    {
        $data = [
            'page_title'   => 'Commercial Business Applications',
            'page'         => 'business-applications', // Loads app/Views/admin/business-applications.php
            'applications' => $this->applicationModel->where('category', 'business')->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function applicationDetails($id)
    {
        $data = [
            'page_title'  => 'Application Dossier #' . $id,
            'page'        => 'application_detail', // Loads app/Views/admin/application_detail.php
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
            'page'       => 'users', // Loads app/Views/admin/users.php
            'users'      => $this->userModel->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function createUser()
    {
        if ($this->request->getMethod() === 'post') {
            $this->userModel->save($this->request->getPost());
            return redirect()->to('admin/users')->with('success', 'User access context instantiated successfully.');
        }

        $data = [
            'page_title' => 'Register System Account',
            'page'       => 'users_create' // Loads app/Views/admin/users_create.php
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * 4. PUBLIC MUNICIPAL SERVICES CATALOG
     */
    public function services()
    {
        $data = [
            'page_title' => 'Municipal Services Registry',
            'page'       => 'services', // Loads app/Views/admin/services.php
            'services'   => $this->serviceModel->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function createService()
    {
        if ($this->request->getMethod() === 'post') {
            $this->serviceModel->save($this->request->getPost());
            return redirect()->to('admin/services')->with('success', 'Service option mapped into public index catalog.');
        }

        $data = [
            'page_title' => 'Register Public Service Pathway',
            'page'       => 'services_create' // Loads app/Views/admin/services_create.php
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * 5. CIVIL DEVELOPMENT INITIATIVES (PROJECTS)
     */
    public function projects()
    {
        $data = [
            'page_title' => 'District Development Projects',
            'page'       => 'projects', // Loads app/Views/admin/projects.php
            'projects'   => $this->projectModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function createProject()
    {
        if ($this->request->getMethod() === 'post') {
            $this->projectModel->save($this->request->getPost());
            return redirect()->to('admin/projects')->with('success', 'Development baseline project initialized.');
        }

        $data = [
            'page_title' => 'Publish Corporate Development Initiative',
            'page'       => 'projects_create' // Loads app/Views/admin/projects_create.php
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function editProject($id)
    {
        if ($this->request->getMethod() === 'post') {
            $this->projectModel->update($id, $this->request->getPost());
            return redirect()->to('admin/projects')->with('success', 'Project specifications recalibrated.');
        }

        $data = [
            'page_title' => 'Modify Development Profile',
            'page'       => 'projects_edit', // Loads app/Views/admin/projects_edit.php
            'project'    => $this->projectModel->find($id)
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function deleteProject($id)
    {
        $this->projectModel->delete($id);
        return redirect()->to('admin/projects')->with('success', 'Project execution node scrubbed.');
    }

    /**
     * 6. ELECTED OFFICIALS & MANAGEMENT STRUCTURES
     */
    public function officials()
    {
        $data = [
            'page_title' => 'Civic Leadership Council',
            'page'       => 'officials', // Loads app/Views/admin/officials.php
            'officials'  => $this->officialModel->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function management()
    {
        $data = [
            'page_title' => 'Executive Secretarial Management Core',
            'page'       => 'management', // Loads app/Views/admin/management.php
            'members'    => $this->managementMemberModel->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    /**
     * 7. PRESS RELEASES, COMMUNICATIONS, & BOARD NOTICES
     */
    public function news()
    {
        $data = [
            'page_title' => 'Press Release Ledger',
            'page'       => 'news', // Loads app/Views/admin/news.php
            'news'       => $this->newsModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

    public function notices()
    {
        $data = [
            'page_title' => 'Gazette Board Notices & Tenders',
            'page'       => 'notices', // Loads app/Views/admin/notices.php
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
            'page'         => 'payments', // Loads app/Views/admin/payments.php
            'transactions' => $this->paymentModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }

public function viewModal($id = null)
{
    if (empty($id) || !is_numeric($id)) {
        return $this->response
                    ->setStatusCode(400)
                    ->setBody('<div class="alert alert-danger m-3">Missing or invalid Application ID parameter.</div>');
    }

    try {
        $dataModel = new ApplicationDataModel();
        
        // 1. Fetch raw matrix key-value pairs grouped by data_type
        $rawApplicationData = $dataModel->getApplicationData($id);

        $processedData = [];
        $detectedApplicationType = '';

        // Definitive blacklist of structural database components or private keys
        $blacklistedGroups = ['form_data', 'form_fields', 'form_config', 'structural_state', 'service_form'];
        $blacklistedKeys   = ['id', 'id_copy', 'document_hash'];

        if (!empty($rawApplicationData) && is_array($rawApplicationData)) {
            foreach ($rawApplicationData as $groupName => $fields) {
                $normalizedGroup = strtolower(trim($groupName));
                
                // Skip structural configuration blocks entirely
                if (in_array($normalizedGroup, $blacklistedGroups)) {
                    continue;
                }

                if (!is_array($fields)) {
                    continue;
                }

                $filteredGroupFields = [];
                foreach ($fields as $key => $value) {
                    $normalizedKey = strtolower(trim($key));

                    // Skip specific sensitive or non-presentable system parameters
                    if (in_array($normalizedKey, $blacklistedKeys)) {
                        continue;
                    }

                    // Dynamically extract the underlying application service key context if present
                    if (empty($detectedApplicationType) && in_array($normalizedKey, ['application_type', 'type', 'form_type', 'service_type', 'service_key'])) {
                        if (!is_array($value)) {
                            $detectedApplicationType = (string)$value;
                        }
                    }

                    $filteredGroupFields[$key] = $value;
                }

                // Push sanitized dataset block back only if it has valid display keys
                if (!empty($filteredGroupFields)) {
                    $processedData[$groupName] = $filteredGroupFields;
                }
            }
        }

        // 2. Packaging the data for the frontend
        $viewData = [
            'id'              => $id,
            'applicationType' => $detectedApplicationType, 
            'applicationData' => $processedData
        ];

        return view('admin/application_details', $viewData);

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
            'page'          => 'notifications', // Loads app/Views/admin/notifications.php
            'notifications' => $this->notificationModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('admin/layout/admin_master', $data);
    }
}
