<?php
namespace App\Service\Impl;

use App\Service\AiService;
use HosseinHezami\LaravelGemini\Facades\Gemini;

class GeminiService implements AiService {
    public function generate($prompt, $model = "gemini-2.5-flash-lite")
    {
        $generated = Gemini::text()    
                        ->model($model)
                        ->prompt($prompt)
                        ->generate();

        return $generated->content();
    }

    public function generateFaker($prompt,$model = "default") {
        $generate = fake()->paragraph(10);
        return $generate;
    }
        
}


?>