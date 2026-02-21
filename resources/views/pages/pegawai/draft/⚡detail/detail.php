<?php

use App\Models\NewsDraf;
use App\Service\ImageService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsGenerator;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
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

};
