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

        
        $jsonStructure = '{ "title": "judul berita di sini", "body": "isi berita dalam format markdown di sini" }';

        $fakta = json_encode($draft);
        $instruksi = json_encode($config);

        $prompt = "
        Bertindaklah sebagai penulis berita profesional. 
        Tugas Anda adalah menulis berita dari fakta: $fakta. 
        Instruksi tambahan: $instruksi.
        
        WAJIB: Berikan output HANYA dalam format JSON dengan struktur: $jsonStructure. 
        Pastikan bagian 'body' tetap menggunakan format markdown untuk styling teksnya.Return ONLY the JSON object. Do not include markdown code blocks (```json), do not include any preamble, and do not include any post-text explanation
    ";


        $result = FacadesGemini::text()
            ->model("gemini-2.5-flash-lite")
            ->prompt($prompt)
            ->generate();
        // dd(json_decode($result->content()));
        preg_match('/\{(?:[^{}]|(?R))*\}/s', $result->content(), $matches);
    
    $jsonString = $matches[0] ?? null;
    dd(json_decode($jsonString));
    }
}
