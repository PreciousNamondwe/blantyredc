<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Services\ApplicationService;
use App\Services\AuthService;
use App\Services\UserService;
use App\Services\NotificationService;
use App\Services\PaymentService;
use App\Models\ApplicationModel;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\PaymentTransactionModel;

class AdminController extends ResourceController
{
    protected $applicationService;
    protected $authService;
    protected $userService;
    protected $notificationService;
    protected $paymentService;
    protected $applicationModel;
    protected $userModel;
    protected $serviceModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->applicationService = new ApplicationService();
        $this->authService = new AuthService();
        $this->userService = new UserService();
        $this->notificationService = new NotificationService();
        $this->paymentService = new PaymentService();
        $this->applicationModel = new ApplicationModel();
        $this->userModel = new UserModel();
        $this->serviceModel = new ServiceModel();
        $this->paymentModel = new PaymentTransactionModel();
    }

    /**
     * Get dashboard statistics
     */
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'total_applications' => $this->applicationModel->countAll(),
            'pending_applications' => $this->applicationModel->where('status', 'pending')->countAllResults(),
            'approved_applications' => $this->applicationModel->where('status', 'approved')->countAllResults(),
            'rejected_applications' => $this->applicationModel->where('status', 'rejected')->countAllResults(),
            'total_users' => $this->userModel->countAll(),
            'active_users' => $this->userModel->where('status', 'active')->countAllResults(),
            'total_payments' => $this->paymentModel->where('status', 'completed')->countAllResults(),
            'total_revenue' => $this->paymentModel->where('status', 'completed')->selectSum('amount')->first()['amount'] ?? 0
        ];

        // Get recent applications
        $recentApplications = $this->applicationModel
            ->select('applications.*, users.first_name, users.last_name, services.name as service_name')
            ->join('users', 'users.id = applications.user_id')
            ->join('services', 'services.id = applications.service_id')
            ->orderBy('applications.created_at', 'DESC')
            ->limit(10)
            ->findAll();

        // Get applications by status
        $applicationsByStatus = $this->applicationModel
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        // Get monthly statistics for the last 12 months
        $monthlyStats = $this->getMonthlyStats();

        return $this->respond([
            'status' => 'success',
            'data' => [
                'stats' => $stats,
                'recent_applications' => $recentApplications,
                'applications_by_status' => $applicationsByStatus,
                'monthly_stats' => $monthlyStats
            ]
        ]);
    }

    /**
     * Get all applications with filtering
     */
    public function applications()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = $this->request->getGet('per_page') ?? 20;
        $status = $this->request->getGet('status');
        $serviceId = $this->request->getGet('service_id');
        $search = $this->request->getGet('search');

        $query = $this->applicationModel
            ->select('applications.*, users.first_name, users.last_name, users.email, services.name as service_name, assigned_users.first_name as assigned_first_name, assigned_users.last_name as assigned_last_name')
            ->join('users', 'users.id = applications.user_id')
            ->join('services', 'services.id = applications.service_id')
            ->join('users as assigned_users', 'assigned_users.id = applications.assigned_to', 'left');

        if ($status) {
            $query->where('applications.status', $status);
        }

        if ($serviceId) {
            $query->where('applications.service_id', $serviceId);
        }

        if ($search) {
            $query->groupStart()
                ->like('users.first_name', $search)
                ->orLike('users.last_name', $search)
                ->orLike('applications.reference_number', $search)
                ->groupEnd();
        }

        $total = $query->countAllResults(false);
        $applications = $query->orderBy('applications.created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        return $this->respond([
            'status' => 'success',
            'data' => [
                'applications' => $applications,
                'pagination' => [
                    'current_page' => (int)$page,
                    'per_page' => (int)$perPage,
                    'total' => $total,
                    'total_pages' => ceil($total / $perPage)
                ]
            ]
        ]);
    }

    /**
     * Update application status
     */
    public function updateApplicationStatus($applicationId)
    {
        $rules = [
            'status' => 'required|in_list[pending,under_review,approved,rejected,completed]',
            'comments' => 'permit_empty|string|max_length[1000]',
            'assigned_to' => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);
        $user = $this->authService->getCurrentUser();
        if (!$user) {
            return $this->failUnauthorized('Unauthenticated');
        }

        try {
            $result = $this->applicationService->updateStatus(
                $applicationId,
                $data['status'],
                $user['id'],
                $data['comments'] ?? null,
                $data['assigned_to'] ?? null
            );

            return $this->respond([
                'status' => 'success',
                'message' => 'Application status updated successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get all users
     */
    public function users()
    {
        $page = $this->request->getGet('page') ?? 1;
        $perPage = $this->request->getGet('per_page') ?? 20;
        $role = $this->request->getGet('role');
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $query = $this->userModel;

        if ($role) {
            $query->where('role', $role);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->groupStart()
                ->like('first_name', $search)
                ->orLike('last_name', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $total = $query->countAllResults(false);
        $users = $query->orderBy('created_at', 'DESC')
            ->paginate($perPage, 'default', $page);

        return $this->respond([
            'status' => 'success',
            'data' => [
                'users' => $users,
                'pagination' => [
                    'current_page' => (int)$page,
                    'per_page' => (int)$perPage,
                    'total' => $total,
                    'total_pages' => ceil($total / $perPage)
                ]
            ]
        ]);
    }

    /**
     * Create new user
     */
    public function createUser()
    {
        $rules = [
            'first_name' => 'required|string|max_length[100]',
            'last_name' => 'required|string|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'permit_empty|string|max_length[20]',
            'role' => 'required|in_list[admin,department_head,staff,reviewer]',
            'department_id' => 'permit_empty|integer',
            'status' => 'required|in_list[active,inactive,suspended]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);
        $user = $this->authService->getCurrentUser();
        if (!$user) {
            return $this->failUnauthorized('Unauthenticated');
        }

        try {
            $userData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'role' => $data['role'],
                'department_id' => $data['department_id'] ?? null,
                'status' => $data['status'],
                'password_hash' => password_hash('password123', PASSWORD_DEFAULT), // Default password
                'created_by' => $user['id'],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $userId = $this->userModel->insert($userData);

            // Send notification
            $this->notificationService->sendNotification(
                $userId,
                'Account Created',
                'Your account has been created. Please change your password.',
                'info'
            );

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'User created successfully',
                'data' => $this->userModel->find($userId)
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Update user
     */
    public function updateUser($userId)
    {
        $rules = [
            'first_name' => 'required|string|max_length[100]',
            'last_name' => 'required|string|max_length[100]',
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'phone' => 'permit_empty|string|max_length[20]',
            'role' => 'required|in_list[admin,department_head,staff,reviewer]',
            'department_id' => 'permit_empty|integer',
            'status' => 'required|in_list[active,inactive,suspended]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);

        try {
            $updateData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'role' => $data['role'],
                'department_id' => $data['department_id'] ?? null,
                'status' => $data['status'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->userModel->update($userId, $updateData);

            return $this->respond([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $this->userModel->find($userId)
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get services
     */
    public function services()
    {
        $services = $this->serviceModel->findAll();

        return $this->respond([
            'status' => 'success',
            'data' => $services
        ]);
    }

    /**
     * Create service
     */
    public function createService()
    {
        $rules = [
            'name' => 'required|string|max_length[255]',
            'description' => 'permit_empty|string',
            'fee' => 'required|numeric|greater_than[0]',
            'processing_time_days' => 'required|integer|greater_than[0]',
            'is_active' => 'required|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getJSON(true);

        try {
            $serviceData = [
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'fee' => $data['fee'],
                'processing_time_days' => $data['processing_time_days'],
                'is_active' => $data['is_active'],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $serviceId = $this->serviceModel->insert($serviceData);

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Service created successfully',
                'data' => $this->serviceModel->find($serviceId)
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * Get payment statistics
     */
    public function paymentStats()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $stats = $this->paymentService->getPaymentStats($startDate, $endDate);

        return $this->respond([
            'status' => 'success',
            'data' => $stats
        ]);
    }

    /**
     * Get monthly statistics for dashboard
     */
    private function getMonthlyStats()
    {
        $stats = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-{$i} months"));
            $startDate = $date . '-01';
            $endDate = date('Y-m-t', strtotime($startDate));

            $applications = $this->applicationModel
                ->where('created_at >=', $startDate . ' 00:00:00')
                ->where('created_at <=', $endDate . ' 23:59:59')
                ->countAllResults();

            $payments = $this->paymentModel
                ->where('status', 'completed')
                ->where('transaction_date >=', $startDate . ' 00:00:00')
                ->where('transaction_date <=', $endDate . ' 23:59:59')
                ->selectSum('amount')
                ->first()['amount'] ?? 0;

            $stats[] = [
                'month' => date('M Y', strtotime($startDate)),
                'applications' => $applications,
                'revenue' => $payments
            ];
        }

        return $stats;
    }
}