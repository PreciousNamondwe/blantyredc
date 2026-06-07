<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    /**
     * Synthesizes cross-table records into a unified user-focused array
     */
    public function getApplicationsWithInvolvedUsers()
    {
        $db = \Config\Database::connect();
        $results = [];

        // 1. Extract Complaint Applications
        $complaints = $db->table('complaint_reports')
                         ->select('id, application_id as app_ref, complaint_category as service, priority_level as priority, applicant_name as name, applicant_email as email, created_at, "complaint" as type')
                         ->get()
                         ->getResultArray();
        $results = array_merge($results, $complaints);

        // 2. Extract Marriage Certificates
        $marriages = $db->table('marriage_certificates')
                        ->select('certificate_id as id, certificate_number as app_ref, marriage_type as service, "normal" as priority, CONCAT(groom_first_name, " ", groom_last_name, " & ", bride_first_name, " ", bride_last_name) as name, "Registry Record" as email, created_at, "marriage" as type')
                        ->get()
                        ->getResultArray();
        $results = array_merge($results, $marriages);

        // Sort by submission timeline descending
        usort($results, function($a, $b) {
            return strcmp($b['created_at'], $a['created_at']);
        });

        return $results;
    }

    /**
     * Isolated targeted lookup logic mapping back to your structural keys
     */
    public function fetchFullTypeRecord($id, $type)
    {
        $db = \Config\Database::connect();
        if ($type === 'complaint') {
            return $db->table('complaint_reports')->where('id', $id)->get()->getRowArray();
        } elseif ($type === 'marriage') {
            return $db->table('marriage_certificates')->where('certificate_id', $id)->get()->getRowArray();
        }
        return null;
    }

    /**
     * Drops rows directly from target table schemas
     */
    public function dropTypeRecord($id, $type)
    {
        $db = \Config\Database::connect();
        if ($type === 'complaint') {
            return $db->table('complaint_reports')->where('id', $id)->delete();
        } elseif ($type === 'marriage') {
            return $db->table('marriage_certificates')->where('certificate_id', $id)->delete();
        }
        return false;
    }
}