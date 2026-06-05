<?php

namespace App\Database\Seeds;

use App\Models\ManagementMemberModel;
use CodeIgniter\Database\Seeder;

class ManagementMemberSeeder extends Seeder
{
    public function run()
    {
        $memberModel = new ManagementMemberModel();

        $members = [
            [
                'name' => 'Mr. B.F Nkasala',
                'position' => 'District Commissioner',
                'email' => 'district.commissioner@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Executive Head of Blantyre District Council, responsible for overall administration and coordination of council activities.',
                'photo' => 'image/officials/nkasala.jpg',
            ],
            [
                'name' => 'Mr. H. Dowe',
                'position' => 'Director of Administration',
                'email' => 'administration@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Responsible for human resources, general administration, and internal operations of the council.',
                'photo' => 'image/officials/dowe.jpg',
            ],
            [
                'name' => 'Mr. T. Harawa',
                'position' => 'Director of Planning',
                'email' => 'planning@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Oversees development planning, project management, and strategic initiatives for the district.',
                'photo' => 'image/officials/harawa.jpg',
            ],
            [
                'name' => 'Mrs. I. Mphangwe',
                'position' => 'Director of Finance',
                'email' => 'finance@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Manages the council\'s financial resources, budgeting, revenue collection, and fiscal planning.',
                'photo' => 'image/officials/mphangwe.jpg',
            ],
            [
                'name' => 'Mr. J. Bodole',
                'position' => 'Director of Public Works',
                'email' => 'publicworks@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Responsible for infrastructure development, road maintenance, and public facilities management.',
                'photo' => 'image/officials/bodole.jpg',
            ],
            [
                'name' => 'Mr. P. Chiphanda',
                'position' => 'Director of Education, Sports & Youth',
                'email' => 'education@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Oversees education services, youth development programs, and sports initiatives in the district.',
                'photo' => 'image/officials/chiphanda.jpg',
            ],
            [
                'name' => 'Mr. G. Kawalazira',
                'position' => 'Director of Health & Social Services',
                'email' => 'health@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Manages health services delivery, social welfare programs, and community health initiatives.',
                'photo' => 'image/officials/kawalazira.jpg',
            ],
            [
                'name' => 'Mrs. L. Mphande',
                'position' => 'Director of Agriculture & Natural Resources',
                'email' => 'agriculture@blantyredc.gov.mw',
                'phone' => '+265 1 XXX XXXX',
                'bio' => 'Responsible for agricultural development, natural resource management, and environmental conservation.',
                'photo' => 'image/officials/mphande.jpg',
            ],
        ];

        foreach ($members as $index => $member) {
            $exists = $memberModel
                ->where('name', $member['name'])
                ->where('position', $member['position'])
                ->first();

            if ($exists) {
                continue;
            }

            if (!empty($member['photo']) && !is_file(FCPATH . $member['photo'])) {
                $member['photo'] = null;
            }

            $memberModel->insert(array_merge($member, [
                'is_active' => 1,
                'sort_order' => $index + 1,
            ]));
        }
    }
}
