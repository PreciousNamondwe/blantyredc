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
    
public function getCombinedApplications()
{
    $db = \Config\Database::connect();

    // 1. Query Business Applications with unified column names matching the view
    $businesses = $db->table('businesses_application')
        ->select('
            CONCAT("business_", id) as composite_id,
            application_code as reference_number,
            owner_name as applicant_name,
            "Business License" as service_type,
            owner_phone as phone_number,
            current_stage as status,
            created_at
        ')->get()->getResultArray();

    // 2. Query Marriage Certificates (concatenating names since they use multiple fields)
    $marriages = $db->table('marriage_certificates')
        ->select('
            CONCAT("marriage_", certificate_id) as composite_id,
            certificate_number as reference_number,
            CONCAT(groom_first_name, " ", groom_last_name, " & ", bride_first_name, " ", bride_last_name) as applicant_name,
            "Marriage Certificate" as service_type,
            "N/A" as phone_number,
            status as status,
            created_at
        ')->get()->getResultArray();

    // 3. Query Complaint Reports
    $complaints = $db->table('complaint_reports')
        ->select('
            CONCAT("complaint_", id) as composite_id,
            CONCAT("COMP-", id) as reference_number,
            applicant_name as applicant_name,
            CONCAT("Complaint: ", complaint_category) as service_type,
            applicant_phone as phone_number,
            "Submitted" as status,
            created_at
        ')->get()->getResultArray();

    // Merge all array outputs into a single flat list
    $allApplications = array_merge($businesses, $marriages, $complaints);

    // Sort the combined array chronologically by 'created_at' in descending order (newest first)
    usort($allApplications, function ($a, $b) {
        return strtotime($b['created_at'] ?? '') - strtotime($a['created_at'] ?? '');
    });

    return $allApplications;
}
    
}