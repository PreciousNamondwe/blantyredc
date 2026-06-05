<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function applications()
    {
        $model = new ApplicationModel();
        
        $data['applications'] = $model->select('applications.*, services.service_name')
            ->join('services', 'services.service_key = applications.service_key')
            ->orderBy('created_at', 'DESC')
            ->findAll();
            
        return view('admin/applications/index', $data);
    }

    public function applicationDetails($id)
    {
        $model = new ApplicationModel();
        $userModel = new UserModel();
        
        $application = $model->getWithDetails($id);
        
        if (!$application) {
            return redirect()->to('/admin/applications')->with('error', 'Application not found');
        }

        $data['app'] = $application;
        $data['staff'] = $userModel->getUsersByRole('staff');
        
        return view('admin/applications/details', $data);
    }

    public function updateApplicationStatus($id)
    {
        $model = new ApplicationModel();
        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');

        if ($model->updateStatus($id, $status, $notes)) {
            return redirect()->back()->with('message', 'Status updated successfully');
        }

        return redirect()->back()->with('error', 'Failed to update status');
    }

    public function assignApplication($id)
    {
        $model = new ApplicationModel();
        $userId = $this->request->getPost('user_id');
        $model->assignToUser($id, $userId);
        return redirect()->back()->with('message', 'Application assigned');
    }
}