<?php

use App\Models\NewsDraf;
use App\Service\Impl\NewsConfigService;
use App\Service\Impl\NewsDrafService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{

    use WithFileUploads;
    public NewsDraf $draft;

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
    public $strict_fact_mode = true;

    public $existImage;

    public $delete_image = false;


    public function mount(NewsDraf $draft)
    {
        $this->draft = $draft;
        $this->title = $draft->title;

        $this->tokoh = $draft->tokoh;

        $this->waktu = $draft->waktu;

        $this->lokasi = $draft->lokasi;

        $this->kronologi = $draft->kronologi;

        $this->content_berita = $draft->content_berita;

        $this->existImage = $draft->image;

        $this->tone_style = $draft->newsDrafConfig->tone_style;

        $this->custom_prompt_text = $draft->newsDrafConfig->custom_prompt_text;

        $this->prompt_mode = $draft->newsDrafConfig->prompt_mode;

        $this->strict_fact_mode = $draft->newsDrafConfig->strict_fact_mode;






    }

    public function update(NewsConfigService $newsConfigService, NewsDrafService $newsDrafService) {

        $validated = $this->validate();

        $this->updateDraft($newsConfigService, $newsDrafService,$validated);

        $this->dispatch("success-update-news");


    }

    public function updateDraft(NewsConfigService $newsConfigService, NewsDrafService $newsDrafService, array $data)
    {
        $draft = array_slice($data, 0, 7);
        unset($draft['image']);
        $config = array_slice($data, 7, 4);



        $user = Auth::user();
        $newsDraft = $newsDrafService->update(
            $draft,
            $this->draft, 
            $data['image'],
             $user,
            $this->delete_image);


        $newsConfigService->update($config, $newsDraft);

        return $newsDraft;
    }
};
