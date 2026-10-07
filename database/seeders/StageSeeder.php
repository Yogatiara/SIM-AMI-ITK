<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stage::create([
            'name' => 'Submission',
            'description' => 'Tahap pengumpulan bukti ketercapaian indikator oleh Audite.',
            'order' => 1,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Assessment',
            'description' => 'Tahap penilaian ketercapaian indikator oleh Auditor.',
            'order' => 2,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Feedback',
            'description' => 'Tahap umpan balik Audite terhadap penilaian Auditor.',
            'order' => 3,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Validation',
            'description' => 'Tahap validasi ketercapaian indikator berdasarkan kesepakatan bersama saat verifikasi lapangan.',
            'order' => 4,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Meeting',
            'description' => 'Tahap pengumpulan Berita Acara RTM dengan verifikasi PJM.',
            'order' => 5,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Planning',
            'description' => 'Tahap perencanaan tindak lanjut indikator yang belum memenuhi oleh Audite.',
            'order' => 6,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Signing',
            'description' => 'Tahap pengumpulan Laporan Audit yang telah ditandatangani.',
            'order' => 7,
            'is_active' => true,
        ]);

        Stage::create([
            'name' => 'Outcome',
            'description' => 'Kegiatan Audit Mutu Internal berhasil dilaksanakan.',
            'order' => 8,
            'is_active' => true,
        ]);
    }
}
