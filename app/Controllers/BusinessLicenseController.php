<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BusinessLicenseModel; // Updated class link reference location

class BusinessLicenseController extends BaseController
{
    /**
     * Renders the primary application layout form page
     */
    public function index()
    {
        return view('business-license/index');
    }

    /**
     * Processes submission data sent from the online portal form
     */
    public function submit()
    {
        // Block direct URL GET processing attempts
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to(base_url('business-license'));
        }

        $model = new BusinessLicenseModel();

        // 1. Process the Mandatory National ID File Stream upload
        $idImageFile = $this->request->getFile('owner_id_image');
        $idImagePath = '';

        if ($idImageFile && $idImageFile->isValid() && !$idImageFile->hasMoved()) {
            $validatedExtension = $idImageFile->getExtension();
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

            if (in_array(strtolower($validatedExtension), $allowedExtensions)) {
                $ownerNID = strtoupper(trim($this->request->getPost('owner_national_id')));
                $newFileName = 'ID_' . $ownerNID . '_' . time() . '.' . $validatedExtension;
                
                // Save onto the server disk under public/uploads/national_ids/
                $idImageFile->move(FCPATH . 'uploads/national_ids', $newFileName);
                $idImagePath = 'uploads/national_ids/' . $newFileName;
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid ID document format. Only JPG, PNG, and PDF are acceptable.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Mandatory National ID image copy upload is missing or corrupt.');
        }

        // 2. Map payload array metrics directly to table expectations
        $isFormal = $this->request->getPost('is_formal_sector') ? 1 : 0;
        $appCode  = $model->generateApplicationCode();

        $formData = [
            'application_code'          => $appCode,
            'application_type'          => $this->request->getPost('application_type'),
            'current_stage'             => 'submitted', // Triggers processing pipeline routing state
            'submission_date'           => date('Y-m-d H:i:s'),
            'business_name'             => strip_tags(trim($this->request->getPost('business_name'))),
            'business_type'             => strip_tags(trim($this->request->getPost('business_type'))),
            'business_category'         => $this->request->getPost('business_category'),
            'owner_name'                => strip_tags(trim($this->request->getPost('owner_name'))),
            'owner_national_id'         => $ownerNID,
            'owner_id_image'            => $idImagePath,
            'owner_phone'               => strip_tags(trim($this->request->getPost('owner_phone'))),
            'traditional_authority'     => strip_tags(trim($this->request->getPost('traditional_authority'))),
            'village_or_area'           => strip_tags(trim($this->request->getPost('village_or_area'))),
            'physical_address'          => strip_tags(trim($this->request->getPost('physical_address'))),
            'trading_name'              => $this->request->getPost('trading_name') ?: null,
            'owner_email'               => $this->request->getPost('owner_email') ?: null,
            'plot_number'               => $this->request->getPost('plot_number') ?: null,
            'is_formal_sector'          => $isFormal,
            'mbrs_registration_number'  => ($isFormal) ? strip_tags(trim($this->request->getPost('mbrs_registration_number'))) : null,
            'mra_tpin'                  => ($isFormal) ? strip_tags(trim($this->request->getPost('mra_tpin'))) : null,
            'estimated_annual_turnover' => ($isFormal) ? floatval($this->request->getPost('estimated_annual_turnover')) : 0.00,
        ];

        // 3. Persist down to database layer
        if ($model->insert($formData)) {
            return redirect()->to(base_url('business-license'))->with('success', 'Application submitted successfully! Your tracking reference code is: ' . $appCode);
        } else {
            return redirect()->back()->withInput()->with('error', 'Database layer transaction failure. Please retry.');
        }
    }
}