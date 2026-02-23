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

            $prompt = $this->generatePrompt($draft);

            $generatedContent = $this->aiService->generate($prompt);


            $result = $this->newsResultService->create([
                "content_generated" => Str::markdown($generatedContent)
            ], $draft);

            if($result) {
                $draft->status = "generated";
                $draft->save();
            }

            return $result;

    }

    public function updateNews(NewsDraf $draft, User $user) {
        $prompt = $this->generatePrompt($draft);

        $generateContent = $this->aiService->generate($prompt);

        $data = [
            'content_generated' => Str::markdown($generateContent)
        ];

        $result = $this->newsResultService->update($data,$draft);

        if($result) {
            $draft->status = 'generated';
            $draft->save();
        }

        return $result;

    }

    protected function generatePrompt(NewsDraf $draft ) {

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
                akting sebagai tulis berita dengan custome prompt : {$draft->newsDrafConfig->custom_prompt_text}, dengan fakta $fakta, dan instruksi $instruksi tulis sesuai instruksi, tulis berita dengan format markdown
            ";

            return $draft->newsDrafConfig->custom_prompt_text ? $customePrompt : $prompt;

    }

    protected function cleanLinePrompt($prompt) {
        $text = preg_replace('/\s+/', ' ', $prompt);

        return trim($text);
    }
}
