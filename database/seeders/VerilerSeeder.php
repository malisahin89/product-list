<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Veriler;

class VerilerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Veriler::create([
            'marka' => 'Hay Yaşa',
            'aciklama' => 'Bizi tercih ettiğiniz için teşekkürler, sizleri eşsiz lezzetlerle buluşturmaktan onur duyuyoruz',
            'anaveri' => 'Bizi tercih ettiğiniz için teşekkürler, sizleri eşsiz lezzetlerle buluşturmaktan onur duyuyoruz',
            'footerveri' => 'Bizi tercih ettiğiniz için teşekkürler, sizleri eşsiz lezzetlerle buluşturmaktan onur duyuyoruz',
            'facebook' => 'malisahin89',
            'twitter' => 'malisahin89',
            'instagram' => 'malisahin89',
            'youtube' => '@malisahincom',
            'web' => 'https://malisahin.com',
            'adres' => 'Türkiye/Ordu',
            'tel' => '132456789',
            'mail' => 'a@a'
        ]);
    }
}
