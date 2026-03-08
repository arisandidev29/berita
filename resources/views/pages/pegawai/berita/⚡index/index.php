<?php

use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public $search;
    public $news;

    public function mount(NewsResultService $newsResultService) {
        $this->news = $newsResultService->getPublishNews(Auth::user())->get();
    }

    public function searchNews(NewsResultService $newsResultService) {
        $this->news = $newsResultService->searchNews($this->search,Auth::user());
    }
};
