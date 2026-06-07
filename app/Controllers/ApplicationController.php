<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ApplicationModel;

class ApplicationController extends BaseController
{
    protected $applicationModel;

    public function __construct()
    {
        $this->applicationModel = new ApplicationModel();
    }

    public function index()
    {
        $data = [
            'page_title'   => 'Unified Applications Portal',
            'page'         => 'applications', // Injects into layout frame components
            'applications' => $this->applicationModel->getApplicationsWithInvolvedUsers()
        ];

        return view('admin/layout/admin_master', $data);
    }

    public function viewDetails($id, $type)
    {
        $recordData = $this->applicationModel->fetchFullTypeRecord($id, $type);

        if (!$recordData) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Record not located.']);
        }

        return view('admin/partials/application_modal_body', [
            'record' => $recordData,
            'type'   => $type
        ]);
    }

    public function delete($id, $type)
    {
        if ($this->applicationModel->dropTypeRecord($id, $type)) {
            session()->setFlashdata('success', 'Profile entry removed successfully from active tables.');
        } else {
            session()->setFlashdata('error', 'Unable to execute removal on selected type table target.');
        }

        return redirect()->to(base_url('admin/applications'));
    }
}