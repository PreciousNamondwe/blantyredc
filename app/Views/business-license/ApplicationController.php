<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use App\Models\ApplicationDataModel;
use App\Models\ApplicationDocumentModel;
use CodeIgniter\API\ResponseTrait;

class ApplicationController extends BaseController
{
    use ResponseTrait;

    public function submit()
    {
        $appModel = new ApplicationModel();
        $dataModel = new ApplicationDataModel();
        $docModel = new ApplicationDocumentModel();

        // 1. Prepare Base Application
        $serviceKey = $this->request->getPost('service_key') ?? 'business_license';
        
        $applicationData = [
            'service_key' => $serviceKey,
            'status'      => 'submitted',
            'priority'    => 'normal',
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        if (!$appModel->insert($applicationData)) {
            return $this->fail($appModel->errors());
        }

        $applicationId = $appModel->getInsertID();
        $app = $appModel->find($applicationId);

        // 2. Save Form Data to application_data table
        $rawPost = $this->request->getPost();
        
        // Group data into types
        $applicantInfo = [
            'first_name' => $rawPost['firstname'] ?? '',
            'last_name'  => $rawPost['lastname'] ?? '',
            'email'      => $rawPost['email'] ?? '',
            'phone'      => $rawPost['contact'] ?? '',
            'id_type'    => $rawPost['id_type'] ?? '',
            'id_number'  => $rawPost['id_number'] ?? '',
        ];

        $businessInfo = [
            'business_name' => $rawPost['business_name'] ?? '',
            'business_type' => $rawPost['business_type'] ?? '',
            'market'        => $rawPost['market'] ?? '',
            'code'          => $rawPost['code'] ?? '',
            'reg_date'      => $rawPost['registering_date'] ?? '',
        ];

        $dataModel->saveData($applicationId, 'applicant_info', $applicantInfo);
        $dataModel->saveData($applicationId, 'service_specific', $businessInfo);

        // 3. Handle File Uploads
        $files = $this->request->getFiles();
        if ($files) {
            foreach ($files as $key => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $uploadPath = 'uploads/applications/' . $app['reference_number'];
                    
                    if ($file->move(WRITEPATH . $uploadPath, $newName)) {
                        $docModel->insert([
                            'application_id' => $applicationId,
                            'document_type'  => $key,
                            'file_name'      => $file->getClientName(),
                            'file_path'      => $uploadPath . '/' . $newName,
                            'file_size'      => $file->getSize(),
                            'mime_type'      => $file->getClientMimeType()
                        ]);
                    }
                }
            }
        }

        return $this->respondCreated([
            'status'    => 'success',
            'message'   => 'Application submitted successfully',
            'reference' => $app['reference_number']
        ]);
    }

    public function track()
    {
        return view('track_application');
    }
}