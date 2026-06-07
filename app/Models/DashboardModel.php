<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    /**
     * Get aggregate statistics mapping across the three tables
     */
    public function getApplicationStats()
    {
        $db = \Config\Database::connect();

        // Count totals per table
        $totalBiz = $db->table('businesses_application')->countAllResults();
        $totalMarriage = $db->table('marriage_certificates')->countAllResults();
        $totalComplaints = $db->table('complaint_reports')->countAllResults();

        $totalSubmissions = $totalBiz + $totalMarriage + $totalComplaints;

        // Fetch stage counts from businesses_application
        $bizStats = $db->table('businesses_application')
            ->select('current_stage as status, COUNT(*) as count')
            ->groupBy('current_stage')
            ->get()->getResultArray();

        // Fetch status counts from marriage_certificates
        $marriageStats = $db->table('marriage_certificates')
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()->getResultArray();

        // Distribute statuses across generic categories
        $pending = 0;
        $under_review = 0;
        $approved = 0;

        // 1. Business Mappings
        foreach ($bizStats as $row) {
            $stage = strtolower($row['status']);
            if (in_array($stage, ['submitted', 'draft'])) {
                $pending += $row['count'];
            } elseif (in_array($stage, ['under_review', 'inspection_scheduled', 'awaiting_payment'])) {
                $under_review += $row['count'];
            } elseif ($stage === 'approved') {
                $approved += $row['count'];
            }
        }

        // 2. Marriage Mappings
        foreach ($marriageStats as $row) {
            $stage = strtolower($row['status']);
            if ($stage === 'pending notice') {
                $pending += $row['count'];
            } elseif ($stage === 'approved') {
                $under_review += $row['count'];
            } elseif ($stage === 'registered') {
                $approved += $row['count'];
            }
        }

        // 3. Complaints default map to Pending
        $pending += $totalComplaints;

        return [
            'total_applications'        => $totalSubmissions,
            'pending_applications'      => $pending,
            'under_review_applications' => $under_review,
            'approved_applications'     => $approved
        ];
    }

    /**
     * Get applications structured status table list array
     */
    public function getApplicationsByStatus()
    {
        $stats = $this->getApplicationStats();
        return [
            ['status' => 'Pending Review', 'count' => $stats['pending_applications']],
            ['status' => 'Under Review', 'count' => $stats['under_review_applications']],
            ['status' => 'Approved / Active', 'count' => $stats['approved_applications']]
        ];
    }

    /**
     * Get recent items across tables, enforcing table names under service_name field
     */
    public function getRecentSubmissions($limit = 6)
    {
        $db = \Config\Database::connect();

        // Select 'businesses_application' explicitly as table origin identifier
        $query1 = $db->table('businesses_application')
            ->select('id, application_code as application_reference, "businesses_application" as service_name, created_at as applied_at, current_stage as status')
            ->getCompiledSelect();

        // Select 'marriage_certificates' explicitly as table origin identifier
        $query2 = $db->table('marriage_certificates')
            ->select('certificate_id as id, certificate_number as application_reference, "marriage_certificates" as service_name, created_at as applied_at, status')
            ->getCompiledSelect();

        // Select 'complaint_reports' explicitly as table origin identifier
        $query3 = $db->table('complaint_reports')
            ->select('id, CONCAT("COMP-", id) as application_reference, "complaint_reports" as service_name, created_at as applied_at, "Pending" as status')
            ->getCompiledSelect();

        // Union tables and sort chronologically 
        $unionQuery = "($query1) UNION ALL ($query2) UNION ALL ($query3) ORDER BY applied_at DESC LIMIT $limit";
        
        return $db->query($unionQuery)->getResultArray();
    }
    
/**
     * Get all applications with complete raw database data preserved for print pipelines
     */
    public function getCombinedApplications()
    {
        $db = \Config\Database::connect();

        // 1. Business Submissions Dataset (All individual columns mapped)
        $businesses = $db->table('businesses_application')
            ->select('
                CONCAT("business_", id) as composite_id,
                id as raw_id,
                application_code as reference_number,
                owner_name as applicant_name,
                "Business License" as service_type,
                owner_phone as phone_number,
                current_stage as status,
                created_at,
                application_type,
                submission_date,
                business_name,
                business_type,
                business_category,
                owner_national_id,
                owner_id_image,
                traditional_authority,
                village_or_area,
                physical_address,
                trading_name,
                owner_email,
                plot_number,
                is_formal_sector,
                mbrs_registration_number,
                mra_tpin,
                estimated_annual_turnover,
                assigned_reviewer_id,
                reviewer_remarks
            ')->get()->getResultArray();

        // 2. Marriage Profiles Dataset (All individual columns mapped)
        $rawMarriages = $db->table('marriage_certificates')->get()->getResultArray();
        $marriages = [];

        foreach ($rawMarriages as $m) {
            $groomFull = trim(($m['groom_first_name'] ?? '') . ' ' . ($m['groom_last_name'] ?? ''));
            $brideFull = trim(($m['bride_first_name'] ?? '') . ' ' . ($m['bride_last_name'] ?? ''));

            $marriages[] = [
                'composite_id'      => 'marriage_' . $m['certificate_id'],
                'raw_id'            => $m['certificate_id'],
                'reference_number'  => $m['certificate_number'] ?? 'N/A',
                'applicant_name'    => $groomFull . ' & ' . $brideFull,
                'service_type'      => 'Marriage Certificate',
                'phone_number'      => 'N/A',
                'status'            => $m['status'] ?? 'Pending Notice',
                'created_at'        => $m['created_at'],
                
                // Full specific dataset for printing
                'marriage_type'              => $m['marriage_type'] ?? '',
                'groom_first_name'           => $m['groom_first_name'] ?? '',
                'groom_last_name'            => $m['groom_last_name'] ?? '',
                'groom_national_id'          => $m['groom_national_id'] ?? '',
                'groom_foreign_passport'     => $m['groom_foreign_passport'] ?? '',
                'groom_date_of_birth'        => $m['groom_date_of_birth'] ?? '',
                'groom_origin_id'            => $m['groom_origin_id'] ?? '',
                'groom_current_residence'    => $m['groom_current_residence'] ?? '',
                'groom_id_upload_front'      => $m['groom_id_upload_front'] ?? '',
                'groom_id_upload_back'       => $m['groom_id_upload_back'] ?? '',
                'groom_passport_bio_upload'  => $m['groom_passport_bio_upload'] ?? '',
                'bride_first_name'           => $m['bride_first_name'] ?? '',
                'bride_last_name'            => $m['bride_last_name'] ?? '',
                'bride_national_id'          => $m['bride_national_id'] ?? '',
                'bride_foreign_passport'     => $m['bride_foreign_passport'] ?? '',
                'bride_date_of_birth'        => $m['bride_date_of_birth'] ?? '',
                'bride_origin_id'            => $m['bride_origin_id'] ?? '',
                'bride_current_residence'    => $m['bride_current_residence'] ?? '',
                'bride_id_upload_front'      => $m['bride_id_upload_front'] ?? '',
                'bride_id_upload_back'       => $m['bride_id_upload_back'] ?? '',
                'bride_passport_bio_upload'  => $m['bride_passport_bio_upload'] ?? '',
                'notice_date_form_b'         => $m['notice_date_form_b'] ?? '',
                'permit_date_form_d'         => $m['permit_date_form_d'] ?? '',
                'date_of_marriage'           => $m['date_of_marriage'] ?? '',
                'place_of_marriage'          => $m['place_of_marriage'] ?? '',
                'officiating_officer'        => $m['officiating_officer'] ?? '',
                'form_b_notice_document_upload'=> $m['form_b_notice_document_upload'] ?? '',
                'letter_of_no_impediment_upload'=> $m['letter_of_no_impediment_upload'] ?? '',
                'groom_witness_id'           => $m['groom_witness_id'] ?? '',
                'bride_witness_id'           => $m['bride_witness_id'] ?? '',
                'registration_fee_paid'      => $m['registration_fee_paid'] ?? '0.00',
                'acknowledgement_slip_issued'=> $m['acknowledgement_slip_issued'] ?? 0
            ];
        }

        // 3. Complaint Reports Dataset (All individual columns mapped)
        $complaints = $db->table('complaint_reports')
            ->select('
                CONCAT("complaint_", id) as composite_id,
                id as raw_id,
                CONCAT("COMP-", id) as reference_number,
                applicant_name as applicant_name,
                CONCAT("Complaint: ", complaint_category) as service_type,
                applicant_phone as phone_number,
                "Submitted" as status,
                created_at,
                application_id,
                complaint_category,
                complaint_subject,
                complaint_description,
                complaint_location,
                priority_level,
                anonymous,
                applicant_email
            ')->get()->getResultArray();

        // Combine everything together
        $allApplications = array_merge($businesses, $marriages, $complaints);

        // Sort chronologically by date created (newest first)
        usort($allApplications, function ($a, $b) {
            return strtotime($b['created_at'] ?? '') - strtotime($a['created_at'] ?? '');
        });

        return $allApplications;
    }
    
}