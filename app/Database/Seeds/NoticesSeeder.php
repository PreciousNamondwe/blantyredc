<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Renewal of Business Permits - URGENT',
                'slug' => 'renewal-of-business-permits',
                'content' => '<p>The General public is hereby officially notified that all business operating permits expired on <strong>31/03/2024</strong>.</p>
                <p>The Council previously provided a mandatory three-month statutory grace period which concluded on June 30th, 2024.</p>
                <div style="background-color: #fff5f5; border: 1px solid #fca5a5; padding: 1.5rem; border-radius: 4px; margin: 1.5rem 0;">
                    <h5 style="color: #b91c1c; font-weight: 600; margin-bottom: 0.5rem;">
                        <i class="bi bi-shield-fill-exclamation"></i> Statutory Enforcement Action
                    </h5>
                    <p style="margin: 0;">The council is now actively enforcing regulatory compliance inspections across all commercial and business sectors. Please visit the Council Revenue Department immediately to finalize your outstanding renewals and avoid standard legal penalties or business closures.</p>
                </div>
                <p><strong>For direct enquiries or verification, please contact the Revenue Desk during official operating hours (7:30 AM - 4:30 PM).</strong></p>',
                'reference' => 'BL-REV-2024',
                'category' => 'Revenue & Licenses',
                'urgency_level' => 'urgent',
                'status' => 'published',
                'author_id' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'title' => 'Water Supply Maintenance Schedule',
                'slug' => 'water-supply-maintenance-schedule',
                'content' => '<p>The Water Department wishes to inform residents and businesses of the following maintenance schedules:</p>
                <h4>Affected Areas:</h4>
                <ul>
                    <li>City Centre Zone A</li>
                    <li>Industrial Area</li>
                    <li>Kanengo District</li>
                    <li>Limbe Township</li>
                </ul>
                <h4>Maintenance Dates:</h4>
                <ul>
                    <li><strong>January 15-17, 2026:</strong> City Centre Zone A - Expected outage 8 hours daily</li>
                    <li><strong>January 20-22, 2026:</strong> Industrial Area - Expected outage 6 hours daily</li>
                    <li><strong>January 27-29, 2026:</strong> Kanengo District - Expected outage 12 hours</li>
                </ul>
                <p>During these periods, water supply may be interrupted. We advise all consumers to store adequate water for domestic and business use.</p>
                <p><strong>For emergency water supply issues, please contact:</strong> 01 838 700 (24 hours)</p>',
                'reference' => 'BL-WTR-2026-001',
                'category' => 'Public Services',
                'urgency_level' => 'high',
                'status' => 'published',
                'author_id' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'title' => 'Community Development Project - Tender Call',
                'slug' => 'community-development-project-tender-call',
                'content' => '<p>The Blantyre District Council invites sealed bids from qualified contractors for the construction of community centers in selected wards.</p>
                <h4>Project Details:</h4>
                <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
                    <tr style="background-color: #f8f9fa; border: 1px solid #e2e8f0;">
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;"><strong>Project Name</strong></td>
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;">Multi-Purpose Community Centers</td>
                    </tr>
                    <tr style="border: 1px solid #e2e8f0;">
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;"><strong>Budget Allocation</strong></td>
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;">MK 50,000,000</td>
                    </tr>
                    <tr style="background-color: #f8f9fa; border: 1px solid #e2e8f0;">
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;"><strong>Closing Date</strong></td>
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;">February 15, 2026 at 2:00 PM</td>
                    </tr>
                    <tr style="border: 1px solid #e2e8f0;">
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;"><strong>Submission Location</strong></td>
                        <td style="padding: 0.75rem; border: 1px solid #e2e8f0;">Council Headquarters, Tender Box</td>
                    </tr>
                </table>
                <p>Bid documents can be obtained from the Council Procurement Department at a cost of MK 5,000.</p>',
                'reference' => 'BL-TEND-2026-CD001',
                'category' => 'Tenders & Opportunities',
                'urgency_level' => 'medium',
                'status' => 'published',
                'author_id' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'title' => 'Holiday Announcement - Public Holiday 2026',
                'slug' => 'holiday-announcement-public-holiday-2026',
                'content' => '<p>The Council hereby publishes the national public holidays for the year 2026.</p>
                <h4>2026 Public Holidays:</h4>
                <ul>
                    <li><strong>January 15:</strong> Chilembwe Day</li>
                    <li><strong>February 14:</strong> Presidents&rsquo; Day</li>
                    <li><strong>March 8:</strong> Women&rsquo;s Day</li>
                    <li><strong>April 9:</strong> Good Friday</li>
                    <li><strong>April 10:</strong> Easter Saturday</li>
                    <li><strong>April 12:</strong> Easter Monday</li>
                    <li><strong>May 1:</strong> Labour Day</li>
                    <li><strong>May 14:</strong> Ascension Day</li>
                    <li><strong>May 25:</strong> Africa Day</li>
                    <li><strong>July 6:</strong> Independence Day</li>
                    <li><strong>October 15:</strong> Mothers&rsquo; Day</li>
                    <li><strong>December 25:</strong> Christmas Day</li>
                    <li><strong>December 26:</strong> Boxing Day</li>
                </ul>
                <p>All Council offices will be closed on these dates. For urgent matters, contact the 24-hour emergency hotline.</p>',
                'reference' => 'BL-HLD-2026',
                'category' => 'General Announcements',
                'urgency_level' => 'low',
                'status' => 'published',
                'author_id' => 1,
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'title' => 'Road Rehabilitation Project - Kandodo Road',
                'slug' => 'road-rehabilitation-project-kandodo-road',
                'content' => '<p>Notice is hereby given that the Council will undertake rehabilitation works on Kandodo Road (Extension) from January 20, 2026.</p>
                <h4>Project Scope:</h4>
                <ul>
                    <li>Complete road resurfacing (5.2 km)</li>
                    <li>Drainage system upgrade</li>
                    <li>Street lighting installation</li>
                </ul>
                <h4>Expected Duration:</h4>
                <p><strong>Estimated completion: June 30, 2026</strong></p>
                <h4>Traffic Advisory:</h4>
                <p style="background-color: #e7f1ff; padding: 1rem; border-left: 4px solid #0d6efd; margin: 1rem 0;">
                    Road users are advised to use alternative routes during this period. Traffic will be reduced to one lane in certain sections. Delays are anticipated during peak hours.
                </p>
                <p><strong>For inquiries:</strong> Public Works Department - 01 838 711</p>',
                'reference' => 'BL-PWK-2026-KAND',
                'category' => 'Infrastructure Development',
                'urgency_level' => 'high',
                'status' => 'published',
                'author_id' => 1,
                'published_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('notices')->insertBatch($data);
    }
}
