<?php

namespace App\Controllers;

use App\Models\ElectedOfficialModel;
use App\Models\ManagementMemberModel;
use App\Models\ProjectModel;
use App\Models\ServiceModel;

class SearchController extends BaseController
{
    public function index()
    {
        $items = array_merge(
            $this->staticPages(),
            $this->documents(),
            $this->services(),
            $this->projects(),
            $this->officials(),
            $this->managementMembers()
        );

        return $this->response->setJSON($items);
    }

    private function staticPages(): array
    {
        return [
            ['title' => 'Home', 'description' => 'Welcome to Blantyre District Council.', 'url' => '/', 'icon' => 'home', 'category' => 'Main'],
            ['title' => 'About Blantyre', 'description' => 'Learn about Blantyre District Council and the district.', 'url' => 'about-blantyre', 'icon' => 'info', 'category' => 'Council'],
            ['title' => 'Management', 'description' => 'Executive leadership and council management structure.', 'url' => 'management', 'icon' => 'users', 'category' => 'Council'],
            ['title' => 'Elected Officials', 'description' => 'Members of Parliament and Ward Councilors.', 'url' => 'officials', 'icon' => 'landmark', 'category' => 'Council'],
            ['title' => 'Projects', 'description' => 'Ongoing and completed development projects.', 'url' => 'projects', 'icon' => 'folder-open', 'category' => 'Projects'],
            ['title' => 'Services', 'description' => 'Council public services and online applications.', 'url' => 'services', 'icon' => 'briefcase', 'category' => 'Services'],
            ['title' => 'Downloads', 'description' => 'Council documents, reports, budgets, and forms.', 'url' => 'downloads', 'icon' => 'download', 'category' => 'Documents'],
            ['title' => 'Contact Us', 'description' => 'Contact Blantyre District Council.', 'url' => 'contact-us', 'icon' => 'phone', 'category' => 'Contact'],
            ['title' => 'Notices', 'description' => 'Public notices and council announcements.', 'url' => 'notices', 'icon' => 'newspaper', 'category' => 'Information'],
            ['title' => 'Track Application', 'description' => 'Track the status of an application.', 'url' => 'track-application', 'icon' => 'search', 'category' => 'Quick Actions'],
            ['title' => 'Report a Complaint', 'description' => 'Report an issue or complaint to the council.', 'url' => 'complaint-reporting', 'icon' => 'alert-triangle', 'category' => 'Quick Actions'],
            ['title' => 'Business License', 'description' => 'Apply for a business license.', 'url' => 'business-license', 'icon' => 'briefcase', 'category' => 'Services'],
            ['title' => 'Property Rates', 'description' => 'Property rates payment services.', 'url' => 'property-rates', 'icon' => 'building', 'category' => 'Services'],
            ['title' => 'Birth Certificate', 'description' => 'Birth certificate request service.', 'url' => 'birth-certificate', 'icon' => 'file-text', 'category' => 'Services'],
            ['title' => 'Death Certificate', 'description' => 'Death certificate request service.', 'url' => 'death-certificate', 'icon' => 'file-text', 'category' => 'Services'],
            ['title' => 'Marriage Certificates', 'description' => 'Marriage certificate services.', 'url' => 'marriage-certificates', 'icon' => 'heart', 'category' => 'Services'],
            ['title' => 'Affidavits', 'description' => 'Affidavit services.', 'url' => 'affidavits', 'icon' => 'file-pen-line', 'category' => 'Services'],
            ['title' => 'Certification of Certificates', 'description' => 'Certificate certification services.', 'url' => 'certification-of-certificates', 'icon' => 'badge-check', 'category' => 'Services'],
            ['title' => 'Change of Name', 'description' => 'Change of name services.', 'url' => 'change-of-name', 'icon' => 'file-signature', 'category' => 'Services'],
            ['title' => 'Commissioner of Oaths', 'description' => 'Commissioner of oaths services.', 'url' => 'commissioner-of-oaths', 'icon' => 'stamp', 'category' => 'Services'],
            ['title' => 'Deceased Estates', 'description' => 'Deceased estate administration services.', 'url' => 'deceased-estates', 'icon' => 'file-text', 'category' => 'Services'],
            ['title' => 'Firearm', 'description' => 'Firearm related council services.', 'url' => 'firearm', 'icon' => 'shield', 'category' => 'Services'],
            ['title' => 'Will Deposit', 'description' => 'Will deposit services.', 'url' => 'will-deposit', 'icon' => 'archive', 'category' => 'Services'],
            ['title' => 'Directorate of Administration', 'description' => 'Administration directorate information.', 'url' => 'directorate-of-administration', 'icon' => 'building-2', 'category' => 'Directorates'],
            ['title' => 'Directorate of Agriculture', 'description' => 'Agriculture directorate information.', 'url' => 'directorate-of-agriculture', 'icon' => 'leaf', 'category' => 'Directorates'],
            ['title' => 'Directorate of Education', 'description' => 'Education directorate information.', 'url' => 'directorate-of-education', 'icon' => 'graduation-cap', 'category' => 'Directorates'],
            ['title' => 'Directorate of Financial Services', 'description' => 'Financial services directorate information.', 'url' => 'directorate-of-financial-services', 'icon' => 'wallet', 'category' => 'Directorates'],
            ['title' => 'Directorate of Health', 'description' => 'Health directorate information.', 'url' => 'directorate-of-health', 'icon' => 'heart-pulse', 'category' => 'Directorates'],
            ['title' => 'Directorate of Public Works', 'description' => 'Public works directorate information.', 'url' => 'directorate-of-public-works', 'icon' => 'hard-hat', 'category' => 'Directorates'],
            ['title' => 'Directorate of Planning and Development', 'description' => 'Planning and development directorate information.', 'url' => 'directorate-of-planning-development', 'icon' => 'map', 'category' => 'Directorates'],
            ['title' => 'Activity Features', 'description' => 'Council activity features.', 'url' => 'activity-features', 'icon' => 'sparkles', 'category' => 'Information'],
            ['title' => 'Feature Activity', 'description' => 'Featured council activities.', 'url' => 'feature-activity', 'icon' => 'sparkles', 'category' => 'Information'],
        ];
    }

    private function documents(): array
    {
        $items = [];
        foreach (glob(FCPATH . 'documents/*') ?: [] as $path) {
            if (!is_file($path)) {
                continue;
            }

            $filename = basename($path);
            $title = pathinfo($filename, PATHINFO_FILENAME);
            $items[] = [
                'title' => str_replace(['-', '_'], ' ', $title),
                'description' => 'Download document: ' . $filename,
                'url' => 'documents/' . rawurlencode($filename),
                'icon' => 'file-text',
                'category' => 'Documents',
            ];
        }

        return $items;
    }

    private function services(): array
    {
        if (!$this->tableExists('services')) {
            return [];
        }

        $items = [];
        foreach ((new ServiceModel())->getActiveServices() as $service) {
            $items[] = [
                'title' => $service['service_name'],
                'description' => trim(($service['department'] ?? '') . ' ' . ($service['description'] ?? '')),
                'url' => 'services',
                'icon' => 'briefcase',
                'category' => 'Services',
            ];
        }

        return $items;
    }

    private function projects(): array
    {
        if (!$this->tableExists('projects')) {
            return [];
        }

        $items = [];
        foreach ((new ProjectModel())->getActiveProjects() as $project) {
            $items[] = [
                'title' => $project['title'],
                'description' => trim(($project['category'] ?? '') . ' ' . ($project['location'] ?? '') . ' ' . ($project['description'] ?? '')),
                'url' => 'projects',
                'icon' => 'folder-open',
                'category' => 'Projects',
            ];
        }

        return $items;
    }

    private function officials(): array
    {
        if (!$this->tableExists('elected_officials')) {
            return [];
        }

        $items = [];
        $officials = (new ElectedOfficialModel())
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        foreach ($officials as $official) {
            $items[] = [
                'title' => $official['name'],
                'description' => trim(($official['position'] ?? '') . ' ' . ($official['department'] ?? '') . ' ' . ($official['bio'] ?? '')),
                'url' => 'officials',
                'icon' => 'landmark',
                'category' => 'Elected Officials',
            ];
        }

        return $items;
    }

    private function managementMembers(): array
    {
        if (!$this->tableExists('management_members')) {
            return [];
        }

        $items = [];
        $members = (new ManagementMemberModel())
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        foreach ($members as $member) {
            $items[] = [
                'title' => $member['name'],
                'description' => trim(($member['position'] ?? '') . ' ' . ($member['bio'] ?? '')),
                'url' => 'management',
                'icon' => 'users',
                'category' => 'Management',
            ];
        }

        return $items;
    }

    private function tableExists(string $table): bool
    {
        return \Config\Database::connect()->tableExists($table);
    }
}
