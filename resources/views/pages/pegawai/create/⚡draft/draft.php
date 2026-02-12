<?php

use App\Service\Impl\NewsConfigService;
use App\Service\Impl\NewsDrafService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads; 
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    #[Validate('min:10', message: "Mimal 10 karakter")]
    public $title;
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    #[Validate('min:3', message: "Mimal 3 karakter")]
    public $tokoh;
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    public $waktu;
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    #[Validate('min:5', message: "Minimal 5 karakter")]
    public $lokasi;
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    #[Validate('min:15', message: "Minimal 15 karakter")]
    public $kronologi;
    
    #[Validate('required', message: "Kolom Tidak Boleh Kosong !")]
    #[Validate('min:15', message: "Minimal 15 karakter")]
    public $content_berita;
    
    #[Validate("nullable|image|max:2024", message: "sediakan gambar")]
    public $image;
    
    #[Validate('nullable', message: "kolom tidak boleh kosong")]
    public $tone_style = "informative";
    
    #[Validate('nullable|min:20', message: "minimal 20 karakter")]
    public $custom_prompt_text;
    
    
    #[Validate('nullable', message: "kolom tidak boleh kosong")]
    public $prompt_mode = "default";

    #[Validate('nullable')]
    public $stric_fact_mode = true;


    public function save(NewsDrafService $newsDrafService, NewsConfigService $newsConfigService) {
        $data = $this->validate();

        
        $draft = array_slice($data,0,7);
        $config = array_slice($data,7,4);
        
        
        $user = Auth::user();
        $newsDraft = $newsDrafService->create($draft,$data['image'],$user);
        $newsConfigService->create($config,$newsDraft);
        
        $this->dispatch("success-create-draft");
    }

    public function generate() {
        Sleep::for(2)->seconds();
    }



} ;