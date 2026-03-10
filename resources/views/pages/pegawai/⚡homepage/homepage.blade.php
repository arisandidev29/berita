<div>
    <x-user.navbar />

    <x-homepage-hero :totalDraft="$totalDraft" :totalNews="$totalNews" />

    <div class="my-2 p-4 w-[80%] mx-auto ">
        <div class="grid gap-4 grid-cols-1 lg:grid-cols-[70%_1fr]">

            {{-- chart --}}
            <div class="rounded-2xl shadow-2xl p-10  ">
                <h2 class="text-xl font-semibold">Statik Berita Penulis</h2>
                <div id="chart"></div>
            </div>

            <div>
                {{-- calendar --}}
                <x-homepage.calender :calenderData="$calenderData" />


                {{-- draft --}}
                <div class="my-8">
                    <h2 class="text-main-primary text-2xl  my-5">Draft Berita</h2>
                    <ul class="grid gap-4 grid-cols-4 items-stretch">
                        @forelse($this->drafts as $draft)
                            <li>
                                <a href="{{ route('pegawai.draft.detail', $draft) }}">
                                    <div
                                        class="bg-main-light-primary text-white min-h-20 max-h-20 flex gap-2 items-center justify-center border border-gray-400 rounded-lg p-1 text-center hover:shadow-xl  hover:shadow-main-primary transition-all duration-300">
                                        <h3 class="text-sm">{{ Str::limit($draft->title, '20', '...') }}</h3>
                                    </div>
                                </a>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- latest Berita --}}

        <div>


            <div class="mt-4 flex flex-col md:flex-row gap-4 justify-between">
                <div>
                    <h2 class="text-2xl text-main-primary ">Berita Terbaru</h2>
                    <p class="text-neutral-400 text-sm">menampilkan berita yang telah di published </p>
                </div>

            </div>

            {{-- berita --}}

            <ul class="grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 my-3">
                @forelse($this->news as $news)
                    <x-berita.news-card :item="$news" :key="$news->id" />
                @empty
                    <x-berita.news-empty-draft />
                @endforelse

                {{-- paginate --}}
                {{ $this->news->links() }}



            </ul>

        </div>

    </div>



</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                    name: 'Draft',
                    data: @json($draftData)
                },
                {
                    name: "News",
                    data: @json($newsData)
                }
            ],
            xaxis: {
                categories: @json($monthsList)
            },
            stroke: {
                curve: "smooth"
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endpush
