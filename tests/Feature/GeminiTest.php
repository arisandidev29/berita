<?php

namespace Tests\Feature;

use App\Models\NewsConfig;
use App\Models\NewsDraf;
use Gemini\Enums\ModelVariation;
use HosseinHezami\LaravelGemini\Facades\Gemini as FacadesGemini;
use HosseinHezami\LaravelGemini\Gemini;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GeminiTest extends TestCase
{

    public function test_example(): void
    {

        $draft = [
            'title'     => 'Kebakaran Gudang Tekstil di Kalideres',
            'tokoh'     => 'Bapak Ahmad (Pemilik Gudang) dan Petugas Damkar',
            'peristiwa' => 'Si jago merah melahap gudang penyimpanan kain',
            'lokasi'    => 'Kecamatan Kalideres, Jakarta Barat',
            'waktu'     => 'Kamis, 5 Februari 2026 pukul 19:30 WIB',
            'kronogi'   => 'Api diduga berasal dari korsleting listrik di ruang panel belakang, kemudian merambat cepat ke tumpukan bahan katun yang mudah terbakar.'
        ];

        // DATA CONFIG (Simulasi Isi Database)
        $config = [
            'tone'            => 'Investigatif dan Serius',
            'target_audience' => 'Pembaca Berita Regional Jakarta',
            'length'          => '200'
        ];

        // Merakit Fakta
        $fakta = "
    - Judul/Topik: {$draft['title']}
    - Tokoh Utama: {$draft['tokoh']}
    - Peristiwa: {$draft['peristiwa']}
    - Lokasi: {$draft['lokasi']}
    - Waktu: {$draft['waktu']}
    - Kronologi: {$draft['kronogi']}
    ";

        // Merakit Instruksi
        $instruksi = "
    - Tone/Gaya Bahasa: {$config['tone']}
    - Target Pembaca: {$config['target_audience']}
    - Panjang Berita: Sekitar {$config['length']} kata
    - Bahasa: Indonesia
    ";

        // Hasil Prompt Akhir
       $prompt =  "
    Anda adalah seorang jurnalis profesional. Tugas Anda adalah menulis berita berdasarkan fakta-fakta berikut:
    
    DATA FAKTA:
    {$fakta}

    ATURAN PENULISAN:
    {$instruksi}
    
    Tuliskan berita yang menarik, akurat, dan sesuai dengan aturan penulisan di atas. Berikan headline yang kuat!
    ";

        $result = FacadesGemini::text()
            ->model("gemini-2.5-flash-lite")
            ->prompt($prompt)
            ->generate();
        dd($result->content());
    }
}
