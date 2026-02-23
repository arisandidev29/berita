<?php

use App\Models\NewsDraf;
use App\Service\ImageService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $news;
    public $content;
    public $image;
    public $deleteImage = false;

     public function mount($newsDraft) {
        $this->news = $newsDraft;
        $this->content = $this->news->newsResult->content_generated;
    }


    public function saveNews(NewsDrafService $newsDrafService, NewsResultService $newsResultService, ImageService $imageService) {

        if($this->deleteImage && $this->news->image) {
            $imageService->deleteImageNews($this->news->image); 
            $newsDrafService->update(['image' => ''],$this->news,null,Auth::user());

        }
        if($this->image) {
            $newsDrafService->update([],$this->news,$this->image,Auth::user());
        }


        $data = [
            "content_generated" => $this->content
        ];
        $newsResultService->update($data,$this->news);


        $this->dispatch('disable-edit');
        $this->dispatch("updated-news");
        $this->dispatch("activate-toast",title: "Berhasil Edit Berita");

    }


};
