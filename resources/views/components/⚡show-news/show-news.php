<?php

use App\Models\NewsDraf;
use App\Models\NewsResult;
use App\Service\ImageService;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Symfony\Component\Translation\t;

new class extends Component
{
    use WithFileUploads;

    public $news;
    public $content;
    public $title;
    public $image;
    public $deleteImage = false;

     public function mount($newsDraft) {
        $this->news = $newsDraft;
        $this->title = $this->news->newsResult->title;
        $this->content = $this->news->newsResult->body;
    }


    public function saveNews(NewsDrafService $newsDrafService, NewsResultService $newsResultService, ImageService $imageService) {

        try{

            $data = [
                "title" =>  $this->title,
                "body" => $this->content,
            ];
            
            $newsResultService->update($data,$this->news);
            
            if($this->deleteImage ) {
                $newsDrafService->update([],$this->news,null,Auth::user(),$this->deleteImage);
                
            }
            
            
            if($this->image) {
                $newsDrafService->update([],$this->news,$this->image,Auth::user());
            }
            
            
            $this->dispatch("activate-toast",title: "Berhasil Edit Berita");
        }catch(\Exception $e) {
            $this->dispatch("activate-toast",title: "Gagal Edit Berita");
        } finally {
            $this->dispatch('disable-edit');
            $this->dispatch("updated-news");
        }
        
    }
    
    public function publishNews(NewsDrafService $newsDrafService, NewsResultService $newsResultService) {
        $newsDrafService->setPublish($this->news);
        $newsResultService->setPublish($this->news);
        $news = $this->news->newsResult->fresh();
        session()->flash("status","Berhasil Publish Berita");
        $this->redirectRoute("pegawai.berita.show",$news);
    }


};
