<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\ElectedOfficialModel;
use App\Models\ManagementMemberModel;
use App\Models\BusinessTypeModel;

class Home extends BaseController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }
public function index()
{
    $data['pageTitle'] = 'Welcome to Blantyre District Council';

    // Latest projects
    $data['latestProjects'] = $this->projectModel
        ->orderBy('created_at', 'DESC')
        ->limit(4)
        ->findAll();

    // Latest news
    $newsModel = new \App\Models\NewsModel();

    $data['newsArticles'] = $newsModel
        ->where('status', 'published')
        ->orderBy('published_at', 'DESC')
        ->limit(3)
        ->findAll();

    // Fetch district leadership (3 key leaders)
    $data['districtLeadership'] = [];
    $db = \Config\Database::connect();
    if ($db->tableExists('management_members')) {
        $memberModel = new ManagementMemberModel();
        $leaders = $memberModel
            ->where('is_active', 1)
            ->findAll();

        // Filter for specific roles
        $keyRoles = [
            'District Commissioner',
            'Director of Administration',
            'Chief Human Resource'
        ];

        foreach ($keyRoles as $role) {
            foreach ($leaders as $leader) {
                if (stripos((string) $leader['position'], $role) !== false) {
                    $data['districtLeadership'][] = $leader;
                    break; // Get only the first match for each role
                }
            }
        }
    }

    return view('home/index', $data);
}
    public function about_blantyre()
    {
        $data['pageTitle'] = 'About Blantyre';
        return view('about-blantyre/index',$data);
    }
    public function activity_features()
    {
        $data['pageTitle'] = 'activity features';
        return view('activity-features/index',$data);
    }
    public function affidavits()
    {
        $data['pageTitle'] = 'Affidavits';
        return view('affidavits/index',$data);
    }
    public function certification_of_certificates()
    {
        $data['pageTitle'] = 'Certification of Certificates';
        return view('certification-of-certificates/index',$data);
    }
    public function change_of_name()
    {
        $data['pageTitle'] = 'Change of Name';
        return view('change-of-name/index',$data);
    }
    public function commissioner_of_oaths()
    {
        $data['pageTitle'] = 'Commissioner of Oaths';
        return view('commissioner-of-oaths/index',$data);
    }
    public function contact_us()
    {
        $data['pageTitle'] = 'Contact Us';
        return view('contact-us/index',$data);
    }
    public function deceased_estates()
    {
        $data['pageTitle'] = 'Deceased Estates';
        return view('deceased-estates/index',$data);
    }
    public function directorate_of_administration()
    {
        $data['pageTitle'] = 'Directorate of Administration';
        return view('directorate-of-administration/index',$data);
    }
    public function directorate_of_agriculture()
    {
        $data['pageTitle'] = 'Directorate of Agriculture';
        return view('directorate-of-agriculture/index',$data);
    }
    public function directorate_of_education()
    {
        $data['pageTitle'] = 'Directorate of Education';
        return view('directorate-of-education/index',$data);
    }
    public function directorate_of_financial_services()
    {
        $data['pageTitle'] = 'Directorate of financial Services';
        return view('directorate-of-financial-services/index',$data);
    }
    public function directorate_of_health()
    {
        $data['pageTitle'] = 'Directorate of Health';
        return view('directorate-of-health/index',$data);
    }
    public function directorate_of_public_works()
    {
        $data['pageTitle'] = 'Directorate of Public Works';
        return view('directorate-of-public-works/index',$data);
    }
    public function directorate_of_planning_development()
    {
        $data['pageTitle'] = 'Directorate of Public Works';
        return view('directorate-of-planning-development/index',$data);
    }
    public function downloads()
    {
        $data['pageTitle'] = 'Downloads';
        return view('downloads/index',$data);
    }
    public function feature_activity()
    {
        $data['pageTitle'] = 'Feature Activity';
        return view('feature-activity/index',$data);
    }
    public function firearm()
    {
        $data['pageTitle'] = 'Firearm';
        return view('firearm/index',$data);
    }
    public function management()
    {
        $members = [];
        $db = \Config\Database::connect();
        if ($db->tableExists('management_members')) {
            $memberModel = new ManagementMemberModel();
            $members = $memberModel
                ->where('is_active', 1)
                ->orderBy('sort_order', 'ASC')
                ->findAll();
        }

        $data['pageTitle'] = 'Management';
        $data['members'] = $members;
        return view('management/index',$data);
    }
    public function marriage_certificates()
    {
        $data['pageTitle'] = 'Marriage Certificates';
        return view('marriage-certificates/index',$data);
    }
    public function officials()
    {
        $officials = [];
        $db = \Config\Database::connect();
if ($db->tableExists('elected_officials')) {
            $officialModel = new ElectedOfficialModel();
            $officials = $officialModel
                ->where('is_active', 1)
                ->orderBy('sort_order', 'ASC')
                ->findAll();
        }

        $data['pageTitle'] = 'Officials';
        $data['officials'] = $officials;

        return view('officials/index', $data);
    }
    public function projects()
    {
        $data['pageTitle'] = 'Projects';
        
        // Get all active projects
        $data['projects'] = $this->projectModel->getActiveProjects();
        
        // Group projects by category for display
        $groupedProjects = [];
        foreach ($data['projects'] as $project) {
            $category = $project['category'] ?? 'Other';
            if (!isset($groupedProjects[$category])) {
                $groupedProjects[$category] = [];
            }
            $groupedProjects[$category][] = $project;
        }
        $data['groupedProjects'] = $groupedProjects;
        
        return view('projects/index', $data);
    }
    public function will_deposit()
    {
        $data['pageTitle'] = 'Will Deposit';
        return view('will-deposit/index',$data);
    }
    public function notices()
    {
        $data['pageTitle'] = 'Notices';
        return view('notices/index',$data);
    }
    public function business_license()
    {
        $data['pageTitle'] = 'Business License Application';
        $businessTypeModel = new BusinessTypeModel();
        $data['businessTypes'] = $businessTypeModel->getActiveTypes();
        return view('business-license/index', $data);
    }
    public function property_rates()
    {
        $data['pageTitle'] = 'Property Rates Payment';
        return view('property-rates/index',$data);
    }
    public function complaint_reporting()
    {
        $data['pageTitle'] = 'Report a Complaint';
        return view('complaint-reporting/index',$data);
    }
    public function track_application()
    {
        $data['pageTitle'] = 'Track Your Application';
        return view('track-application/index',$data);
    }
    public function birth_certificate()
    {
        $data['pageTitle'] = 'Birth Certificate Request';
        return view('birth-certificate/index',$data);
    }
    public function death_certificate()
    {
        $data['pageTitle'] = 'Death Certificate Request';
        return view('death-certificate/index',$data);
    }
    public function services()
    {
        $data['pageTitle'] = 'Our Services';
        return view('services/index',$data);
    }
    
}
