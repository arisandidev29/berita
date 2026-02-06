<?php

namespace App\Service\Impl;

use App\Models\User;
use App\Service\AiService;

class NewsGenerator
{

    public function __construct(
        protected NewsDrafService $newsDrafService,
        protected NewsConfigService $newsConfigService,
        protected NewsResultService $newsResultService,
        protected AiService $aiService

    ) {}

    public function generateNews($draf_id, User $user) {
            $draft = $this->newsDrafService->getById($draf_id,$user);            

            $draftConfig = $this->newsConfigService->getDraf($draft);

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
             tone : {$draftConfig->tone_style},
             prompt_mode : {$draftConfig->prompt_mode},             
             strict_fact_mode : {$draftConfig->strict_fact_mode},             
            ";

            $fakta = $this->cleanLinePrompt($faktaRaw);
            $instruksi= $this->cleanLinePrompt($instruksiRaw);

            $prompt = "
                akting sebagain penulis berita profesional, tugas kamu adalah menulis berita dari fakta berikut : 
                $fakta, dengan instruksi $instruksi, tulis berita yang menarik akurat dan sesuai dengan instruksi
            ";


            $customePrompt = "
                akting sebagai tulis berita dengan custome prompt : {$draft['custome_prompt_text']}, dengan fakta $fakta, dan instruksi $instruksi tulis sesuai instruksi
            ";

            $generatedContent = $this->aiService->generate($draft["custome_prompt_text"] ? $prompt : $customePrompt);


            $this->newsResultService->create([
                "content_generated" => $generatedContent
            ], $draft);

            

    }

    protected function cleanLinePrompt($prompt) {
        $text = preg_replace('/\s+/', ' ', $prompt);

        return trim($text);
    }
}
