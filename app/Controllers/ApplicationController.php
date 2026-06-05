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
     * Submit new application
     * POST /api/applications/submit
     */
    public function submit()
    {
        // 1. Get request data (JSON or POST)
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

        // 2. Normalize fields for validation mapping
        if (!isset($data['service_type']) && isset($data['service_key'])) { // This block is for backward compatibility if service_key is used instead of service_type
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
            'service_type' => 'required',
            'applicant_name' => 'required',
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

        $applicationModel = new ApplicationModel();
        $applicationId = $applicationModel->insert([
            'service_key' => $serviceKey,
            'status' => 'submitted',
            'priority' => 'normal',
            'submitted_at' => date('Y-m-d H:i:s')
        ]);

        if (!$applicationId) {
            return $this->failServerError('Failed to create application');
        }

        $dataModel = new ApplicationDataModel();
        $applicantInfo = [
            'name' => $data['applicant_name'],
            'first_name' => $data['firstname'] ?? null,
            'last_name' => $data['lastname'] ?? null,
            'email' => $data['applicant_email'],
            'phone' => $data['applicant_phone'],
            'id_type' => $data['id_type'] ?? null,
            'id_number' => $data['id_number'] ?? $data['applicant_id_number'] ?? null,
            'date_of_birth' => $data['dob'] ?? null,
            'gender' => $data['gender'] ?? null,
            'submitted_at' => date('Y-m-d H:i:s')
        ];
        $dataModel->saveData($applicationId, 'applicant_info', $this->removeEmptyValues($applicantInfo));

        if ($serviceKey === 'business_license') {
            $businessInfo = [
                'business_name' => $data['business_name'] ?? null,
                'business_type' => $data['business_type'] ?? null,
                'market' => $data['market'] ?? null,
                'code' => $data['code'] ?? null,
                'registering_date' => $data['registering_date'] ?? null,
            ];
            $dataModel->saveData($applicationId, 'business_details', $this->removeEmptyValues($businessInfo));
        } else {
            // Save the rest of the form fields for non-business services.
            $exclude = ['service_type', 'service_key', 'applicant_name', 'applicant_email', 'applicant_phone', 'firstname', 'lastname', 'email', 'contact'];
            $specificData = array_diff_key($data, array_flip($exclude));
            if (!empty($specificData)) {
                $dataModel->saveData($applicationId, 'service_form', $specificData);
            }
        }

        // 3. Handle File Uploads
        $files = $this->request->getFiles();
        if ($files) {
            $docModel = new ApplicationDocumentModel();
            $app = $applicationModel->find($applicationId);
            
            $uploadBasePath = WRITEPATH . 'uploads/applications/' . $app['reference_number'];
            
            // Ensure the directory exists
            if (!is_dir($uploadBasePath)) {
                mkdir($uploadBasePath, 0777, true);
            }

            foreach ($files as $key => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $relativeDir = 'uploads/applications/' . $app['reference_number'];
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
        }

        // 4. Auto-Assignment
        $assignmentModel = new ServiceAssignmentModel();
        $primaryAssignee = $assignmentModel->getPrimaryAssignee($serviceKey);
        if ($primaryAssignee) {
            $applicationModel->update($applicationId, ['assigned_to' => $primaryAssignee['assigned_user_id']]);
            
            $notificationModel = new NotificationModel();
            $notificationModel->notifyAssignment($applicationId, $primaryAssignee['assigned_user_id']);
        }

        // Fetch final app data to get the reference number generated by the model
        $finalApp = $applicationModel->find($applicationId);

        return $this->respondCreated([
            'status'    => 'success',
            'message'   => 'Application submitted successfully',
            'reference' => $finalApp['reference_number'],
            'data'      => [
                'id' => $applicationId,
                'application_id' => $applicationId
            ]
        ]);
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
