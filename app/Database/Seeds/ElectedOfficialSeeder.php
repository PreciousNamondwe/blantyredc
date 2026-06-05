<?php

namespace App\Database\Seeds;

use App\Models\ElectedOfficialModel;
use CodeIgniter\Database\Seeder;

class ElectedOfficialSeeder extends Seeder
{
    public function run()
    {
        $officialModel = new ElectedOfficialModel();

        $officials = [
            [
                'name' => 'Hon. F.L Phiso',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre North',
                'bio' => 'Member of Parliament representing Blantyre North constituency.',
                'photo' => 'image/officials/phiso.jpg',
            ],
            [
                'name' => 'Hon. F.S. Chisesele',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre North East',
                'bio' => 'Member of Parliament representing Blantyre North East constituency.',
                'photo' => 'image/officials/chisesele.jpg',
            ],
            [
                'name' => 'Hon. S. Kacholola',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre Rural East',
                'bio' => 'Member of Parliament representing Blantyre Rural East constituency.',
                'photo' => 'image/officials/kacholola.jpg',
            ],
            [
                'name' => 'Hon. K.P Kachingwe',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre South West',
                'bio' => 'Member of Parliament representing Blantyre South West constituency.',
                'photo' => 'image/officials/kachingwe.jpg',
            ],
            [
                'name' => 'Hon. J.K Kaneka',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre West',
                'bio' => 'Member of Parliament representing Blantyre West constituency.',
                'photo' => 'image/officials/kaneka.jpg',
            ],
            [
                'name' => 'Hon. N Lipipa',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre City South',
                'bio' => 'Member of Parliament representing Blantyre City South constituency.',
                'photo' => 'image/officials/lipipa.jpg',
            ],
            [
                'name' => 'Hon. S. Suleman',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre City South East',
                'bio' => 'Member of Parliament representing Blantyre City South East constituency.',
                'photo' => 'image/officials/suleman.jpg',
            ],
            [
                'name' => 'Hon. S. Mikaya',
                'position' => 'Member of Parliament',
                'department' => 'Blantyre City West',
                'bio' => 'Member of Parliament representing Blantyre City West constituency.',
                'photo' => 'image/officials/mikaya.jpg',
            ],
            [
                'name' => 'A. Chipwatali',
                'position' => 'Ward Councilor',
                'department' => 'Linjidzi Ward',
                'bio' => 'Council Chair representing Linjidzi Ward. Provides leadership and oversight for the council\'s operations.',
                'photo' => 'image/officials/chipwatali.jpg',
            ],
            [
                'name' => 'M. Phalula',
                'position' => 'Ward Councilor',
                'department' => 'Chigwaja Ward',
                'bio' => 'Ward Councilor representing Chigwaja Ward community interests.',
                'photo' => 'image/officials/phalula.jpg',
            ],
            [
                'name' => 'M. Malikita',
                'position' => 'Ward Councilor',
                'department' => 'Chikowa Ward',
                'bio' => 'Ward Councilor representing Chikowa Ward community interests.',
                'photo' => 'image/officials/malikita.jpg',
            ],
            [
                'name' => 'S.K Pemba',
                'position' => 'Ward Councilor',
                'department' => 'Chilangoma Ward',
                'bio' => 'Ward Councilor representing Chilangoma Ward community interests.',
                'photo' => 'image/officials/pemba.jpg',
            ],
            [
                'name' => 'C. Ndala',
                'position' => 'Ward Councilor',
                'department' => 'Chilaweni Ward',
                'bio' => 'Ward Councilor representing Chilaweni Ward community interests.',
                'photo' => 'image/officials/ndala.jpg',
            ],
            [
                'name' => 'M. Micto',
                'position' => 'Ward Councilor',
                'department' => 'Lunzu Ward',
                'bio' => 'Ward Councilor representing Lunzu Ward community interests.',
                'photo' => 'image/officials/micto.jpg',
            ],
            [
                'name' => 'J. Jumbe',
                'position' => 'Ward Councilor',
                'department' => 'Soche Ward',
                'bio' => 'Ward Councilor representing Soche Ward community interests.',
                'photo' => 'image/officials/jumbe.jpg',
            ],
            [
                'name' => 'M. Chikwakwa',
                'position' => 'Ward Councilor',
                'department' => 'Mpemba Ward',
                'bio' => 'Ward Councilor representing Mpemba Ward community interests.',
                'photo' => 'image/officials/chikwakwa.jpg',
            ],
            [
                'name' => 'D. Ndala',
                'position' => 'Ward Councilor',
                'department' => 'Matindi Ward',
                'bio' => 'Ward Councilor representing Matindi Ward community interests.',
                'photo' => 'image/officials/ndala.jpg',
            ],
            [
                'name' => 'M.S. Jirani',
                'position' => 'Ward Councilor',
                'department' => 'Chikwembere Ward',
                'bio' => 'Ward Councilor representing Chikwembere Ward community interests.',
                'photo' => 'image/officials/jirani.jpg',
            ],
            [
                'name' => 'E. Dumuka',
                'position' => 'Ward Councilor',
                'department' => 'Mzamba/Nantipwiri Ward',
                'bio' => 'Ward Councilor representing Mzamba/Nantipwiri Ward community interests.',
                'photo' => 'image/officials/dumuka.jpg',
            ],
            [
                'name' => 'M. Maloya',
                'position' => 'Ward Councilor',
                'department' => 'Mudi Ward',
                'bio' => 'Ward Councilor representing Mudi Ward community interests.',
                'photo' => 'image/officials/maloya.jpg',
            ],
            [
                'name' => 'H. Chimombo',
                'position' => 'Ward Councilor',
                'department' => 'Naotcha Ward',
                'bio' => 'Ward Councilor representing Naotcha Ward community interests.',
                'photo' => 'image/officials/chimombo.jpg',
            ],
            [
                'name' => 'S. Grant',
                'position' => 'Ward Councilor',
                'department' => 'Makungwa Ward',
                'bio' => 'Ward Councilor representing Makungwa Ward community interests.',
                'photo' => 'image/officials/grant.jpg',
            ],
        ];

        foreach ($officials as $index => $official) {
            $exists = $officialModel
                ->where('name', $official['name'])
                ->where('position', $official['position'])
                ->where('department', $official['department'])
                ->first();

            if ($exists) {
                continue;
            }

            if (!empty($official['photo']) && !is_file(FCPATH . $official['photo'])) {
                $official['photo'] = null;
            }

            $officialModel->insert(array_merge($official, [
                'phone' => null,
                'email' => null,
                'is_active' => 1,
                'sort_order' => $index + 1,
            ]));
        }
    }
}
