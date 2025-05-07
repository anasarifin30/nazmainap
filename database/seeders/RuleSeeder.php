<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            'Tidak boleh merokok di dalam kamar.',
            'Hewan peliharaan tidak diperbolehkan.',
            'Dilarang membuat kebisingan setelah pukul 10 malam.',
            'Tidak boleh membawa senjata tajam.',
            'Dilarang membawa minuman beralkohol.',
            'Tidak boleh memasak di dalam kamar.',
            'Jaga kebersihan kamar setiap saat.',
            'Tidak boleh membawa tamu tanpa izin.',
            'Dilarang mencoret-coret dinding atau perabotan.',
            'Tidak boleh memindahkan perabotan tanpa izin.',
            'Dilarang menggunakan lilin atau api terbuka.',
            'Tidak boleh membuang sampah sembarangan.',
            'Tidak boleh menggunakan listrik secara berlebihan.',
            'Dilarang membawa barang-barang ilegal.',
            'Tidak boleh menggunakan kamar untuk kegiatan komersial.',
            'Jangan meninggalkan barang berharga tanpa pengawasan.',
            'Tidak boleh merusak fasilitas homestay.',
            'Dilarang membawa makanan yang berbau menyengat.',
            'Tidak boleh menggunakan kamar untuk pesta.',
            'Hormati privasi tamu lain.'
        ];

        foreach ($rules as $ruleText) {
            Rule::create([
                'homestay_id' => 1,
                'rule_text' => $ruleText
            ]);
        }
    }
}
