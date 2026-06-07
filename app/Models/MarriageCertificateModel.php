<?php

namespace App\Models;

use CodeIgniter\Model;

class MarriageCertificateModel extends Model
{
    protected $table            = 'marriage_certificates';
    protected $primaryKey       = 'certificate_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Timestamps configuration
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at'; // Both exist here

    protected $allowedFields = [
        'certificate_number', 'marriage_type', 'groom_first_name', 'groom_last_name', 'groom_national_id', 
        'groom_foreign_passport', 'groom_date_of_birth', 'groom_origin_id', 'groom_current_residence', 
        'groom_id_upload_front', 'groom_id_upload_back', 'groom_passport_bio_upload', 'bride_first_name', 
        'bride_last_name', 'bride_national_id', 'bride_foreign_passport', 'bride_date_of_birth', 
        'bride_origin_id', 'bride_current_residence', 'bride_id_upload_front', 'bride_id_upload_back', 
        'bride_passport_bio_upload', 'notice_date_form_b', 'permit_date_form_d', 'date_of_marriage', 
        'place_of_marriage', 'officiating_officer', 'form_b_notice_document_upload', 
        'letter_of_no_impediment_upload', 'groom_witness_id', 'bride_witness_id', 
        'registration_fee_paid', 'acknowledgement_slip_issued', 'status'
    ];
}