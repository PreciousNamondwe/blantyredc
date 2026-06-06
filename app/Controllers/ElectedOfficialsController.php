<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ElectedOfficialModel;

class ElectedOfficialsController extends BaseController
{
    protected $officialModel;

    public function __construct()
    {
        $this->officialModel = new ElectedOfficialModel();
    }

    public function index()
    {
        $data['members'] = $this->officialModel->orderBy('sort_order', 'ASC')->findAll();
        return view('admin/elected_officials/index', $data);
    }

    public function store()
    {
        $rules = $this->officialModel->getValidationRules();
        
        if (!$this->validate($rules)) {
            return redirect()->to(base_url('admin/management'))->withInput()->with('error', $this->validator->listErrors());
        }

        $dbData = $this->request->getPost([
            'name', 'position', 'department', 'phone', 'email', 'bio', 'sort_order'
        ]);
        
        $dbData['is_active'] = $this->request->getPost('is_active') === '1' ? 1 : 0;
        $dbData['sort_order'] = empty($dbData['sort_order']) ? 0 : (int)$dbData['sort_order'];
        $dbData['social_media'] = json_encode([]); // Clear default container block

        // Direct photo upload pipeline
        $photoFile = $this->request->getFile('photo');
        if ($photoFile && $photoFile->isValid() && !$photoFile->hasMoved()) {
            $newName = $photoFile->getRandomName();
            if ($photoFile->move(FCPATH . 'uploads/officials/', $newName)) {
                $dbData['photo'] = 'uploads/officials/' . $newName;
            }
        }

        // Insert instantly to the database and redirect back cleanly
        if ($this->officialModel->insert($dbData)) {
            return redirect()->to(base_url('admin/management'))->with('success', 'Profile entry written to database.');
        }

        return redirect()->to(base_url('admin/management'))->with('error', 'Database write operation failed.');
    }

    public function delete($id = null)
    {
        $record = $this->officialModel->find($id);
        if ($record) {
            if (!empty($record['photo']) && file_exists(FCPATH . $record['photo'])) {
                @unlink(FCPATH . $record['photo']);
            }
            $this->officialModel->delete($id);
            return redirect()->to(base_url('admin/management'))->with('success', 'Profile deleted.');
        }
        return redirect()->to(base_url('admin/management'))->with('error', 'Profile not found.');
    }
}