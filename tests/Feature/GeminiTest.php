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

        $draf = NewsDraf::first();
        $draf_config = NewsConfig::get()->first();

        $data = [
            "title" => $draf->title,
            "tokoh" => $draf->tokoh,
            "peristiwa" => $draf->peristiwa,
            "lokasi" => $draf->lokasi,
            "kronologi" => $draf->lokasi 

        ];


    // Prompt super pendek untuk hemat token
    $prompt = "Tulis berita jurnalistik singkat dari data ini: " . json_encode($data) . ". Jangan mengarang fakta baru, stric fact. dengan panjang minimal 3 paragraf";  // Simulasi data dari tabel news_draf & news_config

        $result = FacadesGemini::text()
            ->model("gemini-2.5-flash-lite")
            ->prompt($prompt)
            ->generate();
        dd($result->content());
    }
}
