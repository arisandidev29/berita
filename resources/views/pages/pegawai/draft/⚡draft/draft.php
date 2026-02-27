<?php

use App\Models\NewsDraf;
use App\Service\Impl\NewsDrafService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Sleep;
use Livewire\Component;

new class extends Component
{
    // public $drafts;

    public $search = "";

    public $selectedDraft = [];

    // public function mount(NewsDrafService $draftService)
    // {
    //     $this->drafts = $draftService->getAll(auth()->user());
    // }

    public function render(NewsDrafService $draftService)
    {
        return $this->view([
            "drafts" => $draftService->getAll(auth()->user()) 
        ]);
    }

    public function deleteSelected(NewsDrafService $newsDrafService)
    {
        $result = $newsDrafService->deleteSelected($this->selectedDraft, auth()->user());
        $this->dispatch("activate-toast", title: "Berhasil Hapus");
    }

    public function searchDraft(NewsDrafService $draftService)
    {
        $drafts = $draftService->searchByTitle($this->search, auth()->user());
        $this->drafts = $drafts;
    }

    public function deleteDraft(NewsDrafService $drafService, $id)
    {

        $draft = $drafService->getById($id, auth()->user());

        Gate::authorize('delete', $draft);

        $drafService->delete($id, auth()->user());


        $this->dispatch("closealertwarning");
        $this->dispatch("activate-toast", title: "Berhasil Hapus");
    }

    public function setDraftBack(NewsDrafService $draftService)
    {
        if (empty($this->search)) {
            $this->drafts = $draftService->getAll(auth()->user());
        }
    }

    public function refreshDraft(NewsDrafService $draftService)
    {
        $this->drafts = $draftService->getAll(auth()->user());
    }
};
