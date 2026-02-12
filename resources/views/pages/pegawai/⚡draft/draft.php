<?php

use App\Models\NewsDraf;
use App\Service\Impl\NewsDrafService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

new class extends Component
{
    public $drafts = "";

    public $search = "";

    public function mount(NewsDrafService $draftService) {
        $this->drafts = $draftService->getAll(auth()->user());
    }
    
    
    public function searchDraft(NewsDrafService $draftService) {
        $drafts = $draftService->searchByTitle($this->search, auth()->user());
        
        $this->drafts = $drafts;
    }

    public function deleteDraft(NewsDrafService $drafService,$id) {

        $draft = $drafService->getById($id,auth()->user());

        Gate::authorize('delete',$draft);

        $drafService->delete($id,auth()->user());


        $this->refreshDraft($drafService);

        $this->dispatch("closealertwarning");
        $this->dispatch("showsuccessdelete");



    }
    
    public function setDraftBack(NewsDrafService $draftService)  {
        if(empty($this->search)) {
            $this->drafts = $draftService->getAll(auth()->user());
        }
    } 

    public function refreshDraft(NewsDrafService $draftService) {
        $this->drafts = $draftService->getAll(auth()->user());
    }

};
