<?php

namespace Database\Seeders;

use App\Models\RuleTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuleTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruleTemplates = [
            // Check-in/Check-out Rules
            [
                'rule_text' => 'Check-in: 14:00 - 22:00, Check-out: 12:00',
                'category' => 'check_in_out',
                'sort_order' => 1
            ],
            [
                'rule_text' => 'Late check-out dikenakan biaya tambahan',
                'category' => 'check_in_out',
                'sort_order' => 2
            ],
            [
                'rule_text' => 'Wajib konfirmasi 2 jam sebelum check-in',
                'category' => 'check_in_out',
                'sort_order' => 3
            ],

            // Behavior Rules
            [
                'rule_text' => 'Dilarang merokok di dalam kamar',
                'category' => 'behavior',
                'sort_order' => 4
            ],
            [
                'rule_text' => 'Dilarang membawa hewan peliharaan',
                'category' => 'behavior',
                'sort_order' => 5
            ],
            [
                'rule_text' => 'Jam malam: 23:00 WIB',
                'category' => 'behavior',
                'sort_order' => 6
            ],
            [
                'rule_text' => 'Tidak diperbolehkan membuat keributan',
                'category' => 'behavior',
                'sort_order' => 7
            ],
            [
                'rule_text' => 'Tamu luar tidak diperbolehkan menginap',
                'category' => 'behavior',
                'sort_order' => 8
            ],
            [
                'rule_text' => 'Dilarang membawa minuman beralkohol',
                'category' => 'behavior',
                'sort_order' => 9
            ],
            [
                'rule_text' => 'Dilarang menggunakan narkoba',
                'category' => 'behavior',
                'sort_order' => 10
            ],

            // Facility Rules
            [
                'rule_text' => 'Tamu wajib menjaga kebersihan',
                'category' => 'facility',
                'sort_order' => 11
            ],
            [
                'rule_text' => 'Kerusakan fasilitas akan dikenakan denda',
                'category' => 'facility',
                'sort_order' => 12
            ],
            [
                'rule_text' => 'Dilarang memindahkan furniture tanpa izin',
                'category' => 'facility',
                'sort_order' => 13
            ],
            [
                'rule_text' => 'Harap matikan AC dan lampu saat keluar',
                'category' => 'facility',
                'sort_order' => 14
            ],
            [
                'rule_text' => 'Tidak boleh memasak di dalam kamar',
                'category' => 'facility',
                'sort_order' => 15
            ],

            // General Rules
            [
                'rule_text' => 'Wajib menyimpan KTP/ID saat check-in',
                'category' => 'general',
                'sort_order' => 16
            ],
            [
                'rule_text' => 'Kehilangan barang bukan tanggung jawab homestay',
                'category' => 'general',
                'sort_order' => 17
            ],
            [
                'rule_text' => 'Tamu bertanggung jawab atas keamanan kamar',
                'category' => 'general',
                'sort_order' => 18
            ],
            [
                'rule_text' => 'Dilarang membawa senjata tajam',
                'category' => 'general',
                'sort_order' => 19
            ],
            [
                'rule_text' => 'Hormati privasi tamu lain',
                'category' => 'general',
                'sort_order' => 20
            ]
        ];

        foreach ($ruleTemplates as $template) {
            RuleTemplate::create($template);
        }
    }
}