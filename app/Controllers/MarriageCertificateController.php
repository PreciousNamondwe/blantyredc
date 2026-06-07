<?php

namespace App\Controllers;

use App\Models\MarriageCertificateModel;
use App\Models\MarriageWitnessModel;
use App\Models\PartyOriginModel;

class MarriageCertificateController extends BaseController
{
    public function index()
    {
        return view('marriage-certificates/index');
    }

    public function store()
    {
        $rules = [
            'marriage_type'                 => 'required',
            'date_of_marriage'              => 'required|valid_date',
            'place_of_marriage'             => 'required',
            'officiating_officer'           => 'required',
            'notice_date_form_b'            => 'required|valid_date',
            
            'groom_first_name'              => 'required',
            'groom_last_name'               => 'required',
            'groom_national_id'             => 'required',
            'groom_date_of_birth'           => 'required|valid_date',
            'groom_current_residence'       => 'required',
            'groom_village'                 => 'required',
            'groom_ta'                      => 'required',
            'groom_district'                => 'required',

            'bride_first_name'              => 'required',
            'bride_last_name'               => 'required',
            'bride_national_id'             => 'required',
            'bride_date_of_birth'           => 'required|valid_date',
            'bride_current_residence'       => 'required',
            'bride_village'                 => 'required',
            'bride_ta'                      => 'required',
            'bride_district'                => 'required',

            'gw_full_name'                  => 'required',
            'gw_national_id'                => 'required',
            'gw_village'                    => 'required',
            'gw_ta'                         => 'required',
            'gw_district'                   => 'required',
            'gw_relationship'               => 'required',

            'bw_full_name'                  => 'required',
            'bw_national_id'                => 'required',
            'bw_village'                    => 'required',
            'bw_ta'                         => 'required',
            'bw_district'                   => 'required',
            'bw_relationship'               => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Process File uploads targeting public/nationalid
        $uploadFields = [
            'groom_id_upload_front', 'groom_id_upload_back', 'groom_passport_bio_upload',
            'bride_id_upload_front', 'bride_id_upload_back', 'bride_passport_bio_upload',
            'gw_id_upload_front', 'gw_id_upload_back',
            'bw_id_upload_front', 'bw_id_upload_back',
            'form_b_notice_document_upload', 'letter_of_no_impediment_upload'
        ];

        $uploadedPaths = [];
        $timestampPrefix = time();

        foreach ($uploadFields as $field) {
            $file = $this->request->getFile($field);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $extension = $file->getExtension();
                $newName = $timestampPrefix . '_' . bin2hex(random_bytes(10)) . '.' . $extension;
                
                // FIX: Path configured to save to nationalid as requested
                $file->move(FCPATH . 'nationalid/', $newName);
                $uploadedPaths[$field] = 'nationalid/' . $newName;
            } else {
                $uploadedPaths[$field] = null;
            }
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $originModel      = new PartyOriginModel();
        $witnessModel     = new MarriageWitnessModel();
        $certificateModel = new MarriageCertificateModel();

        // Save Party Origins
        $groomOriginId = $originModel->insert([
            'village_name'          => $this->request->getPost('groom_village'),
            'traditional_authority' => $this->request->getPost('groom_ta'),
            'district'              => $this->request->getPost('groom_district'),
        ]);

        $brideOriginId = $originModel->insert([
            'village_name'          => $this->request->getPost('bride_village'),
            'traditional_authority' => $this->request->getPost('bride_ta'),
            'district'              => $this->request->getPost('bride_district'),
        ]);

        // Process Groom Witness
        $existingGW = $witnessModel->where('national_id', $this->request->getPost('gw_national_id'))->first();
        if ($existingGW) {
            $groomWitnessId = $existingGW['witness_id'];
        } else {
            $groomWitnessId = $witnessModel->insert([
                'full_name'               => $this->request->getPost('gw_full_name'),
                'national_id'             => $this->request->getPost('gw_national_id'),
                'phone_number'            => $this->request->getPost('gw_phone') ?: null,
                'village_name'            => $this->request->getPost('gw_village'),
                'traditional_authority'   => $this->request->getPost('gw_ta'),
                'district'                => $this->request->getPost('gw_district'),
                'relationship_to_party'   => $this->request->getPost('gw_relationship'),
                'witness_id_upload_front' => $uploadedPaths['gw_id_upload_front'] ?: 'nationalid/placeholder.png',
                'witness_id_upload_back'  => $uploadedPaths['gw_id_upload_back'] ?: 'nationalid/placeholder.png',
            ]);
        }

        // Process Bride Witness
        $existingBW = $witnessModel->where('national_id', $this->request->getPost('bw_national_id'))->first();
        if ($existingBW) {
            $brideWitnessId = $existingBW['witness_id'];
        } else {
            $brideWitnessId = $witnessModel->insert([
                'full_name'               => $this->request->getPost('bw_full_name'),
                'national_id'             => $this->request->getPost('bw_national_id'),
                'phone_number'            => $this->request->getPost('bw_phone') ?: null,
                'village_name'            => $this->request->getPost('bw_village'),
                'traditional_authority'   => $this->request->getPost('bw_ta'),
                'district'                => $this->request->getPost('bw_district'),
                'relationship_to_party'   => $this->request->getPost('bw_relationship'),
                'witness_id_upload_front' => $uploadedPaths['bw_id_upload_front'] ?: 'nationalid/placeholder.png',
                'witness_id_upload_back'  => $uploadedPaths['bw_id_upload_back'] ?: 'nationalid/placeholder.png',
            ]);
        }

        // Generate custom registration serial code format
        $hexSerial = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        $certificateNumber = 'BT/MC/' . date('Y') . '/' . $hexSerial;

        // Compile Certificate payload parameters
        $certificateData = [
            'certificate_number'            => $certificateNumber,
            'marriage_type'                 => $this->request->getPost('marriage_type'),
            'groom_first_name'              => $this->request->getPost('groom_first_name'),
            'groom_last_name'               => $this->request->getPost('groom_last_name'),
            'groom_national_id'             => $this->request->getPost('groom_national_id'),
            'groom_foreign_passport'        => $this->request->getPost('groom_foreign_passport') ?: null,
            'groom_date_of_birth'           => $this->request->getPost('groom_date_of_birth'),
            'groom_origin_id'               => (int)$groomOriginId,
            'groom_current_residence'       => $this->request->getPost('groom_current_residence'),
            'groom_id_upload_front'         => $uploadedPaths['groom_id_upload_front'],
            'groom_id_upload_back'          => $uploadedPaths['groom_id_upload_back'],
            'groom_passport_bio_upload'     => $uploadedPaths['groom_passport_bio_upload'],
            
            'bride_first_name'              => $this->request->getPost('bride_first_name'),
            'bride_last_name'               => $this->request->getPost('bride_last_name'),
            'bride_national_id'             => $this->request->getPost('bride_national_id'),
            'bride_foreign_passport'        => $this->request->getPost('bride_foreign_passport') ?: null,
            'bride_date_of_birth'           => $this->request->getPost('bride_date_of_birth'),
            'bride_origin_id'               => (int)$brideOriginId,
            'bride_current_residence'       => $this->request->getPost('bride_current_residence'),
            'bride_id_upload_front'         => $uploadedPaths['bride_id_upload_front'],
            'bride_id_upload_back'          => $uploadedPaths['bride_id_upload_back'],
            'bride_passport_bio_upload'     => $uploadedPaths['bride_passport_bio_upload'],
            
            'notice_date_form_b'            => $this->request->getPost('notice_date_form_b'),
            'permit_date_form_d'            => $this->request->getPost('permit_date_form_d') ?: null,
            'date_of_marriage'              => $this->request->getPost('date_of_marriage'),
            'place_of_marriage'             => $this->request->getPost('place_of_marriage'),
            'officiating_officer'           => $this->request->getPost('officiating_officer'),
            
            'form_b_notice_document_upload' => $uploadedPaths['form_b_notice_document_upload'] ?: 'pending_physical_signature_generation',
            'letter_of_no_impediment_upload'=> $uploadedPaths['letter_of_no_impediment_upload'],
            
            'groom_witness_id'              => (int)$groomWitnessId,
            'bride_witness_id'              => (int)$brideWitnessId,
            'registration_fee_paid'         => 10000.00,
            'acknowledgement_slip_issued'   => 0,
            'status'                        => 'Pending Notice'
        ];

        $certificateModel->insert($certificateData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Database insertion failed during save state operations.');
        }

        return redirect()->to(site_url('marriage-certificates'))->with('success', 'Application successfully filed! Reference Serial: ' . $certificateNumber);
    }
}