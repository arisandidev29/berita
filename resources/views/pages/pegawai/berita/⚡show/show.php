<?php

use App\Models\NewsResult;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

new class extends Component
{
    public NewsResult $news;

    public function mount(NewsResult $news) {
        Gate::authorize("update",$news);
        $this->news = $news;
    }

    public function deleteNews($id, NewsResultService $newsResultService) {
       Gate::authorize("delete",$this->news);

       $newsResultService->delete($id,$this->news);

       session()->flash("status","Berhasil Hapus Berita");

       $this->redirectRoute("pegawai.berita");

    }

};
