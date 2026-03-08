<?php

use App\Models\NewsResult;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    public NewsResult $news;
    public $title;
    public $body;
    public $image;
    public $currentImage;
    public $deleteImage = false;

    public function mount(NewsResult $news) {
        Gate::authorize("update",$news);
        $this->news = $news;
        $this->title = $news->title;
        $this->body = $news->body;
        $this->currentImage =  $news->newsDraf->image;
    }
    
    public function save(NewsResultService $newsResultService,NewsDrafService $newsDrafService  ) {
        Gate::authorize("update",$this->news);
        $data = [
            "title" => $this->title,
            "body" => $this->body
        ];

        try {

            $newsResultService->update($data,$this->news->newsDraf);
            
            if($this->image) {
                $newsDrafService->update([],$this->news->newsDraf,$this->image,Auth::user());
            };
            
            if($this->deleteImage) {
                $newsDrafService->update([],$this->news->newsDraf,null,Auth::user(),true);
                
                $this->news->fresh();
            }

            session()->flash('status',"berhasil edit Berita");
            $this->redirectRoute("pegawai.berita.show",$this->news,true);
            
            
        }catch(Exception $e) {
            $this->dispatch("activete-toast",title : "gagal edit Berita : " .  $e->getMessage());

        }






        
    }





};
