<?php

use App\Models\NewsDraf;
use App\Service\ImageService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsGenerator;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public NewsDraf $newsDraft;


    public function mount(NewsDraf $draft) {
        $this->newsDraft = $draft;
    }

    public function generate(NewsGenerator $newsGenerator) {
        $newsGenerator->generateNews($this->newsDraft,Auth::user());

        $this->dispatch("closealertgenerate");
    }
    
    public function regenerate(NewsGenerator $newsGenerator) {
        $newsGenerator->updateNews($this->newsDraft,Auth::user());
        $this->dispatch("closealertregenerate");
        $this->dispatch("activate-toast",title: "Berhasil Regenerate");


    }

    #[On('updated-news')]
    public function refreshNews() {
        $this->newsDraft->refresh();
    }


};
