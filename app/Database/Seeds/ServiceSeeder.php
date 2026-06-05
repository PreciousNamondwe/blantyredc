<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'service_key' => 'birth_certificate',
                'service_name' => 'Birth Certificate',
                'description' => 'Application for birth certificate registration and issuance',
                'department' => 'Health',
                'fee_amount' => 5000.00,
                'processing_days' => 7,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'service_key' => 'death_certificate',
                'service_name' => 'Death Certificate',
                'description' => 'Application for death certificate registration and issuance',
                'department' => 'Health',
                'fee_amount' => 3000.00,
                'processing_days' => 5,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'service_key' => 'marriage_certificate',
                'service_name' => 'Marriage Certificate',
                'description' => 'Application for marriage certificate registration and issuance',
                'department' => 'Legal',
                'fee_amount' => 15000.00,
                'processing_days' => 14,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'service_key' => 'business_license',
                'service_name' => 'Business License',
                'description' => 'Application for business license registration and renewal',
                'department' => 'Finance',
                'fee_amount' => 50000.00,
                'processing_days' => 21,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'service_key' => 'property_rates',
                'service_name' => 'Property Rates',
                'description' => 'Property tax assessment and payment services',
                'department' => 'Finance',
                'fee_amount' => 0.00,
                'processing_days' => 3,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'service_key' => 'firearm_license',
                'service_name' => 'Firearm License',
                'description' => 'Application for firearm license and permit',
                'department' => 'Legal',
                'fee_amount' => 25000.00,
                'processing_days' => 30,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'service_key' => 'change_of_name',
                'service_name' => 'Change of Name',
                'description' => 'Legal name change application and processing',
                'department' => 'Legal',
                'fee_amount' => 20000.00,
                'processing_days' => 21,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'service_key' => 'affidavit',
                'service_name' => 'Affidavit Services',
                'description' => 'Affidavit preparation and notarization services',
                'department' => 'Legal',
                'fee_amount' => 10000.00,
                'processing_days' => 7,
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'service_key' => 'commissioner_of_oaths',
                'service_name' => 'Commissioner of Oaths',
                'description' => 'Document attestation and oath administration',
                'department' => 'Legal',
                'fee_amount' => 5000.00,
                'processing_days' => 3,
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'service_key' => 'certification_of_certificates',
                'service_name' => 'Certification of Certificates',
                'description' => 'Certificate authentication and certification services',
                'department' => 'Administration',
                'fee_amount' => 2000.00,
                'processing_days' => 2,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'service_key' => 'complaint_reporting',
                'service_name' => 'Complaint Reporting',
                'description' => 'Public complaint submission and tracking',
                'department' => 'Administration',
                'fee_amount' => 0.00,
                'processing_days' => 7,
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'service_key' => 'deceased_estates',
                'service_name' => 'Deceased Estates',
                'description' => 'Estate administration and probate services',
                'department' => 'Legal',
                'fee_amount' => 50000.00,
                'processing_days' => 60,
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'service_key' => 'will_deposit',
                'service_name' => 'Will Deposit',
                'description' => 'Last will and testament deposit and safekeeping',
                'department' => 'Legal',
                'fee_amount' => 10000.00,
                'processing_days' => 5,
                'is_active' => true,
                'sort_order' => 13,
            ],
        ];

        foreach ($services as $service) {
            $existing = $this->db->table('services')->where('service_key', $service['service_key'])->get()->getRow();
            if (!$existing) {
                $this->db->table('services')->insert($service);
            }
        }
    }
}