<?php

namespace App\Controllers;

use App\Models\ProjectModel;

class TestProject extends BaseController
{
    public function index()
    {
        return view('test_project_form');
    }

    public function store()
    {
        $model = new ProjectModel();

        // 🔥 IMPORTANT (form data)
        $data = $this->request->getPost();

        // DEBUG: see what is coming from form
        // dd($data);

        if (!$model->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with('error', json_encode($model->errors()));
        }

        return redirect()->to('/admin/projects')
            ->with('success', 'Project created successfully!');
    }
        public function deleteProject($id)
    {
        $model = new ProjectModel();

        // 🔍 DEBUG: check ID
        // dd($id);

        // Check if POST request
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method');
        }

        // Check if project exists
        $project = $model->find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        // Try delete
        if ($model->delete($id)) {
            return redirect()->back()->with('success', 'Project deleted successfully');
        }

        return redirect()->back()->with('error', 'Delete failed');
    }
    // ✅ NEW METHODS FOR EDITING
    public function edit($id)
{
    $model = new ProjectModel();

    $project = $model->find($id);

    if (!$project) {
        return redirect()->back()->with('error', 'Project not found');
    }

    return view('test_edit_project_form', [
        'project' => $project
    ]);
}

public function update($id)
{
    $model = new ProjectModel();

    $project = $model->find($id);

    if (!$project) {
        return redirect()->back()->with('error', 'Project not found');
    }

    $data = $this->request->getPost();

    if (!$model->update($id, $data)) {
        return redirect()->back()
            ->withInput()
            ->with('error', json_encode($model->errors()));
    }

    return redirect()->to('/admin/projects')
        ->with('success', 'Project updated successfully!');
}
}