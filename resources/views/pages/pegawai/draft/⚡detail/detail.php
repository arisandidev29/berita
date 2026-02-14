<?php

use App\Models\NewsDraf;
use Livewire\Component;

new class extends Component
{
    public NewsDraf $newsDraft;

    public function mount(NewsDraf $draft) {
        $this->newsDraft = $draft;
    }
};
