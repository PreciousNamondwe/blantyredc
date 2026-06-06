<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ApplicationModel;
use App\Models\ApplicationDataModel;
use App\Models\ApplicationDocumentModel;
use App\Models\NotificationModel;
use App\Models\ServiceAssignmentModel;
use App\Models\ServiceModel;

class ApplicationController extends ResourceController
{
    protected $modelName = 'App\Models\ApplicationModel';
    protected $format = 'json';

    /**
     * Get a comprehensive listing of applications
     * GET /api/applications
     */
    public function index()
    {
        $applicationModel = new ApplicationModel();
        
        // Optional query filter parameters
        $status = $this->request->getGet('status');
        $serviceKey = $this->request->getGet('service_key');

        $query = $applicationModel;

        if (!empty($status)) {
            $query = $query->where('status', $status);
        }
        if (!empty($serviceKey)) {
            $query = $query->where('service_key', $serviceKey);
        }

        $list = $query->orderBy('submitted_at', 'DESC')->findAll();

        return $this->respond([
            'status' => 'success',
            'count'  => count($list),
            'data'   => $list
        ]);
    }

    /**
     * Get a specific application workspace detail composite payload block
     * GET /api/applications/(:num) or GET /api/applications/show/(:num)
     */
    public function show($id = null)
    {
        if (empty($id)) {
            return $this->failValidationErrors('Master structural tracking application index reference key is required.');
        }

        $applicationModel = new ApplicationModel();
        $application = $applicationModel->find($id);

        if (!$application) {
            return $this->failNotFound('Application entry workspace tracking log index not found.');
        }

        $dataPayload = [];
        $complaintPayload = null;

        // If this entry belongs to the custom complaint reporting workflow, fetch from complaint_reports table
        if (isset($application['service_key']) && $application['service_key'] === 'complaint_reporting') {
            $complaintModel = new \App\Models\ComplaintReportModel();
            $complaintPayload = $complaintModel->where('application_id', $id)->first();
        } else {
            // Default EAV mapping for traditional form metadata configurations
            $dataModel = new ApplicationDataModel();
            $rawMetaData = $dataModel->where('application_id', $id)->findAll();
            
            foreach ($rawMetaData as $row) {
                $dataPayload[$row['group_name']] = json_decode($row['value_json'], true) ?? $row['value_json'];
            }
        }

        // Fetch any linked documents/attachments logs matching the core application tracking id
        $docModel = new ApplicationDocumentModel();
        $documents = $docModel->where('application_id', $id)->findAll();

        return $this->respond([
            'status'          => 'success',
            'id'              => $id,
            'application'     => $application,
            'complaint'       => $complaintPayload,
            'applicationData' => $dataPayload,
            'documents'       => $documents
        ]);
    }

    /**
     * Submit new application
     * POST /api/applications/submit
     */
    public function submit()
    {
        $contentType = strtolower($this->request->getHeaderLine('Content-Type'));
        $data = [];

        if (strpos($contentType, 'application/json') !== false) {
            try {
                $data = $this->request->getJSON(true) ?? [];
            } catch (\Throwable $e) {
                return $this->failValidationErrors([
                    'request' => 'Invalid JSON request body.'
                ]);
            }
        }

        if (empty($data)) {
            $data = $this->request->getPost();
        }

        if (!isset($data['service_type']) && isset($data['service_key'])) {
            $data['service_type'] = $data['service_key'];
        }
        if (!isset($data['applicant_name']) && isset($data['firstname'])) {
            $data['applicant_name'] = trim(($data['firstname'] ?? '') . ' ' . ($data['lastname'] ?? ''));
        }
        if ((!isset($data['applicant_email']) || empty($data['applicant_email'])) && isset($data['email'])) {
            $data['applicant_email'] = $data['email'];
        }
        if (!isset($data['applicant_phone']) && isset($data['contact'])) {
            $data['applicant_phone'] = $data['contact'];
        }
        
        $rules = [
            'service_type'    => 'required',
            'applicant_name'  => 'required',
            'applicant_email' => 'required|valid_email',
            'applicant_phone' => 'required'
        ];

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $serviceKey = $data['service_type'];
        $serviceModel = new ServiceModel();
        $service = $serviceModel->where('service_key', $serviceKey)->first();

        if (!$service) {
            return $this->failNotFound('Service not found');
        }

        $priorityMapping = [
            'low'       => 'low',
            'medium'    => 'normal',
            'high'      => 'high',
            'emergency' => 'urgent'
        ];
        $mappedPriority = $priorityMapping[$data['priority_level'] ?? 'medium'] ?? 'normal';

        $applicationModel = new ApplicationModel();
        $applicationId = $applicationModel->insert([
            'service_key'  => $serviceKey,
            'status'       => 'submitted',
            'priority'     => $mappedPriority,
            'submitted_at' => date('Y-m-d H:i:s')
        ]);

        if (!$applicationId) {
            return $this->failServerError('Failed to create application');
        }

        $dataModel = new ApplicationDataModel();
        $applicantInfo = [
            'name'          => $data['applicant_name'],
            'first_name'    => $data['firstname'] ?? null,
            'last_name'     => $data['lastname'] ?? null,
            'email'         => $data['applicant_email'],
            'phone'         => $data['applicant_phone'],
            'id_type'       => $data['id_type'] ?? null,
            'id_number'     => $data['id_number'] ?? $data['applicant_id_number'] ?? null,
            'date_of_birth' => $data['dob'] ?? null,
            'gender'        => $data['gender'] ?? null,
            'submitted_at'  => date('Y-m-d H:i:s')
        ];
        $dataModel->saveData($applicationId, 'applicant_info', $this->removeEmptyValues($applicantInfo));

        if ($serviceKey === 'business_license') {
            $businessInfo = [
                'business_name'    => $data['business_name'] ?? null,
                'business_type'    => $data['business_type'] ?? null,
                'market'           => $data['market'] ?? null,
                'code'             => $data['code'] ?? null,
                'registering_date' => $data['registering_date'] ?? null,
            ];
            $dataModel->saveData($applicationId, 'business_details', $this->removeEmptyValues($businessInfo));
        } else {
            $exclude = ['service_type', 'service_key', 'applicant_name', 'applicant_email', 'applicant_phone', 'firstname', 'lastname', 'email', 'contact'];
            $specificData = array_diff_key($data, array_flip($exclude));
            if (!empty($specificData)) {
                $dataModel->saveData($applicationId, 'service_form', $specificData);
            }
        }

        $files = $this->request->getFiles();
        if ($files) {
            $docModel = new ApplicationDocumentModel();
            $app = $applicationModel->find($applicationId);
            $uploadBasePath = WRITEPATH . 'uploads/applications/' . $app['reference_number'];
            
            if (!is_dir($uploadBasePath)) {
                mkdir($uploadBasePath, 0777, true);
            }

            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $singleFile) {
                        $this->saveUploadedFile($singleFile, $applicationId, $key, $app['reference_number'], $docModel);
                    }
                } else {
                    $this->saveUploadedFile($file, $applicationId, $key, $app['reference_number'], $docModel);
                }
            }
        }

        $assignmentModel = new ServiceAssignmentModel();
        $primaryAssignee = $assignmentModel->getPrimaryAssignee($serviceKey);
        if ($primaryAssignee) {
            $applicationModel->update($applicationId, ['assigned_to' => $primaryAssignee['assigned_user_id']]);
            $notificationModel = new NotificationModel();
            $notificationModel->notifyAssignment($applicationId, $primaryAssignee['assigned_user_id']);
        }

        $finalApp = $applicationModel->find($applicationId);

        return $this->respondCreated([
            'status'    => 'success',
            'message'   => 'Application submitted successfully',
            'reference' => $finalApp['reference_number'],
            'data'      => [
                'id'             => $applicationId,
                'application_id' => $applicationId
            ]
        ]);
    }

    /**
     * Helper to cleanly abstract multiple document writes
     */
    private function saveUploadedFile($file, $applicationId, $key, $referenceNumber, $docModel)
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadBasePath = WRITEPATH . 'uploads/applications/' . $referenceNumber;
            $relativeDir = 'uploads/applications/' . $referenceNumber;
            $newName = $file->getRandomName();
            
            if ($file->move($uploadBasePath, $newName)) {
                $docModel->insert([
                    'application_id' => $applicationId,
                    'document_type'  => esc($key),
                    'file_name'      => $file->getClientName(),
                    'file_path'      => $relativeDir . '/' . $newName,
                    'file_size'      => $file->getSize(),
                    'mime_type'      => $file->getClientMimeType(),
                    'uploaded_at'    => date('Y-m-d H:i:s')
                ]);
            }
        }
    }

    /**
     * Store a new complaint report directly into complaint_reports table
     * POST /applications/complaint
     */
    public function createComplaint()
    {
        $contentType = strtolower($this->request->getHeaderLine('Content-Type'));
        $data = [];

        if (strpos($contentType, 'application/json') !== false) {
            $data = $this->request->getJSON(true) ?? [];
        } else {
            $data = $this->request->getPost();
        }

        if (empty($data)) {
            return $this->failValidationErrors(['form' => 'No dataset parameters received.']);
        }

        $applicationModel = new ApplicationModel();
        $referenceNumber = 'COM-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));
        
        $priorityMapping = [
            'low'       => 'low',
            'medium'    => 'normal',
            'high'      => 'high',
            'emergency' => 'urgent'
        ];
        $mappedPriority = $priorityMapping[$data['priority_level'] ?? 'medium'] ?? 'normal';

        $applicationId = $applicationModel->insert([
            'reference_number' => $referenceNumber,
            'service_key'      => 'complaint_reporting',
            'status'           => 'submitted',
            'priority'         => $mappedPriority,
            'submitted_at'     => date('Y-m-d H:i:s')
        ]);

        if (!$applicationId) {
            return $this->failServerError('Failed to build core structural application tracker.');
        }

        $dbPayload = [
            'application_id'        => $applicationId,
            'complaint_category'    => $data['complaint_category'] ?? null,
            'complaint_subject'     => $data['complaint_subject'] ?? null,
            'complaint_description' => $data['complaint_description'] ?? null,
            'complaint_location'    => $data['complaint_location'] ?? null,
            'priority_level'        => $data['priority_level'] ?? 'medium',
            'anonymous'             => (isset($data['anonymous']) && $data['anonymous'] == '1') ? 1 : 0,
            'applicant_name'        => (isset($data['anonymous']) && $data['anonymous'] == '1') ? 'Anonymous' : ($data['applicant_name'] ?? null),
            'applicant_phone'       => $data['applicant_phone'] ?? null,
            'applicant_email'       => $data['applicant_email'] ?? null
        ];

        $complaintModel = new \App\Models\ComplaintReportModel();

        if (!$complaintModel->insert($dbPayload)) {
            $applicationModel->delete($applicationId);
            return $this->failValidationErrors($complaintModel->errors());
        }

        return $this->respondCreated([
            'status'    => 'success',
            'success'   => true,
            'reference' => $referenceNumber,
            'data'      => [
                'id'             => $applicationId,
                'complaint_id'   => $complaintModel->getInsertID()
            ]
        ]);
    }

    /**
     * Get complaint reports via direct parameter filtering
     * GET /api/applications/complaints
     */
    public function getComplaints()
    {
        $complaintModel = new \App\Models\ComplaintReportModel();
        $applicationId = $this->request->getGet('application_id');

        if ($applicationId) {
            $data = $complaintModel->where('application_id', $applicationId)->orderBy('created_at', 'DESC')->findAll();
        } else {
            $data = $complaintModel->orderBy('created_at', 'DESC')->findAll();
        }

        return $this->respond($data);
    }

    public function status($id = null)
    {
        $model = new ApplicationModel();
        $data = $model->getWithDetails($id);
        return $data ? $this->respond($data) : $this->failNotFound();
    }

    private function removeEmptyValues(array $data): array
    {
        return array_filter($data, static fn ($value) => $value !== null && $value !== '');
    }
}