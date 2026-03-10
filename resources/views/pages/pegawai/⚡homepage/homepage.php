<?php

use App\Models\NewsDraf;
use App\Models\NewsResult;
use App\Service\Impl\NewsDrafService;
use App\Service\Impl\NewsResultService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{

    use WithPagination;
    protected NewsResultService $newsResultService;
    protected NewsDrafService $newsDrafService;

    public $totalDraft;
    public $totalNews;

    public $draftData;
    public $newsData;

    public $monthsList = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    public $calenderData;



    public function mount(NewsResultService $newsResultService, NewsDrafService $newsDrafService)
    {
        $this->newsResultService = $newsResultService;
        $this->newsDrafService = $newsDrafService;

        $this->totalNews = $newsResultService->getPublishNews(Auth::user())->count();
        $this->totalDraft = $newsDrafService->getAll(Auth::user())->count();

        $this->newsData = $this->getData($newsResultService->getUserNewsByYears(Auth::user()));
        $this->draftData = $this->getData($newsDrafService->getUserDraftByYears(Auth::user()));

        $this->calenderData = $this->getCalenderData();
    }


    public function getCalenderData()
    {
        $data =  NewsResult::select(
            DB::raw("COUNT(id) as total"),
            DB::raw("DATE(created_at) as date")
        )
            ->where('created_at', '>=', now()->subDays(30)) // 30 hari terakhir
            ->groupBy('date')
            ->get()
            ->pluck('total', 'date'); // Format: ["2024-05-01" => 2, "2024-05-03" => 1]

        $calendar = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $calendar[] = [
                'date' => $date,
                'day' => now()->subDays($i)->format('d'),
                'count' => $data->get($date, 0) // Jika tidak ada data, beri 0
            ];
        }

        return $calendar;
    }



    #[Computed]
    // pagination
    public function news()
    {
        return $this->newsResultService->getPublishNews(Auth::user())->paginate(6);
    }

    #[Computed]
    public function drafts()
    {
        return $this->newsDrafService->getPerPagination(4, Auth::user());
    }

    protected function getData($data)
    {
        $result = [];
        foreach ($this->monthsList as $month) {
            $result[] = $data->get($month, 0);
        }

        return $result;
    }
};
