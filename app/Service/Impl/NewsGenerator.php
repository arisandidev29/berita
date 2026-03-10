<?php

namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\User;
use App\Service\AiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsGenerator
{

    public function __construct(
        protected NewsDrafService $newsDrafService,
        protected NewsConfigService $newsConfigService,
        protected NewsResultService $newsResultService,
        protected AiService $aiService

    ) {}

    public function generateNews(NewsDraf $draft, User $user)
    {

        $prompt = $this->generatePrompt($draft);

        $resultNews = $this->getResult($prompt);

        return DB::transaction(function () use ($resultNews, $draft) {

            $result = $this->newsResultService->create([
                "title" => $resultNews->title,
                "body" => Str::markdown($resultNews->body)
            ], $draft);

            if ($result) {
                $draft->status = "generated";
                $draft->save();
            }

            return $result;
        });
    }

    public function updateNews(NewsDraf $draft, User $user)
    {
        $prompt = $this->generatePrompt($draft);

        $resultNews = $this->getResult($prompt);

        return DB::transaction(function () use ($resultNews, $draft) {

            $data = [
                "title" => $resultNews->title,
                "body" => Str::markdown($resultNews->body)
            ];

            $result = $this->newsResultService->update($data, $draft);

            return $result;
        });
    }

    protected function getResult($prompt)
    {
        $generatedContent = $this->aiService->generateFaker($prompt);

        // clear optional character
        preg_match('/\{(?:[^{}]|(?R))*\}/s', $generatedContent, $matches);

        $jsonString = $matches[0] ?? null;
        $jsonResult = json_decode($jsonString);
        return $jsonResult;
    }

    protected function generatePrompt(NewsDraf $draft)
    {

        $faktaRaw = "
            title : {$draft->title}, 
            Tokoh : {$draft->tokoh},
            Peristiwa : {$draft->peristiwa},
            lokasi : {$draft->lokasi},
            waktu : {$draft->waktu},
            kronologi : {$draft->kronologi},
            content-berita : {$draft->content_berita},
            data_pendukung: {$draft->data_pendukung},
            ";

        $instruksiRaw = "
             tone : {$draft->newsDrafConfig->tone_style},
             prompt_mode : {$draft->newsDrafConfig->prompt_mode},             
             strict_fact_mode : {$draft->newsDrafConfig->strict_fact_mode},             
            ";

        $fakta = $this->cleanLinePrompt($faktaRaw);
        $instruksi = $this->cleanLinePrompt($instruksiRaw);

        $jsonStructure = '{ "title": "judul berita di sini", "body": "isi berita dalam format markdown di sini" }';

        $prompt = "
        Bertindaklah sebagai penulis berita profesional. 
        Tugas Anda adalah menulis berita dari fakta: $fakta. 
        Instruksi tambahan: $instruksi.
        WAJIB: Berikan output HANYA dalam format JSON dengan struktur: $jsonStructure. 
        Pastikan bagian 'body' tetap menggunakan format markdown untuk styling teksnya.
    ";

        $customePrompt = "
                akting sebagai tulis berita dengan custome prompt : {$draft->newsDrafConfig->custom_prompt_text}, dengan fakta $fakta, dan instruksi $instruksi tulis sesuai instruksi, tulis berita dengan format markdown, WAJIB: Berikan output HANYA dalam format JSON dengan struktur: $jsonStructure.Pastikan bagian 'body' tetap menggunakan format markdown untuk styling teksnya.
            ";

        return $draft->newsDrafConfig->custom_prompt_text ? $customePrompt : $prompt;
    }

    protected function cleanLinePrompt($prompt)
    {
        $text = preg_replace('/\s+/', ' ', $prompt);

        return trim($text);
    }
}
