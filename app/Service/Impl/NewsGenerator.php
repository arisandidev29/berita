<?php

namespace App\Service\Impl;

use App\Models\NewsDraf;
use App\Models\User;
use App\Service\AiService;
use Illuminate\Support\Str;

class NewsGenerator
{

    public function __construct(
        protected NewsDrafService $newsDrafService,
        protected NewsConfigService $newsConfigService,
        protected NewsResultService $newsResultService,
        protected AiService $aiService

    ) {}

    public function generateNews(NewsDraf $draft, User $user) {

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
            $instruksi= $this->cleanLinePrompt($instruksiRaw);

            $prompt = "
                akting sebagain penulis berita profesional, tugas kamu adalah menulis berita dari fakta berikut : 
                $fakta, dengan instruksi $instruksi, tulis berita yang menarik akurat dan sesuai dengan instruksi, tulis berita sebagai format markdown 
            ";


            $customePrompt = "
                akting sebagai tulis berita dengan custome prompt : {$draft['custome_prompt_text']}, dengan fakta $fakta, dan instruksi $instruksi tulis sesuai instruksi
            ";

            $generatedContent = $this->aiService->generate($draft["custome_prompt_text"] ? $prompt : $customePrompt);


            $result = $this->newsResultService->create([
                "content_generated" => Str::markdown($generatedContent)
            ], $draft);

            if($result) {
                $draft->status = "generated";
                $draft->save();
            }

            return $result;

            

    }

    protected function cleanLinePrompt($prompt) {
        $text = preg_replace('/\s+/', ' ', $prompt);

        return trim($text);
    }
}
