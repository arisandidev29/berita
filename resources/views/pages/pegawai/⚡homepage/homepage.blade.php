<div>
    <x-user.navbar />

    <x-homepage-hero :totalDraft="$totalDraft" :totalNews="$totalNews" />

    <div class="my-2 p-4 md:w-[80%] mx-auto ">
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
                    <div class="overflow-x-auto shadow-xl p-5 rounded-md">
                        <h2 class="text-lg font-semibold my-3">Draft Terbaru</h2>
                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>DiBuat</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($this->drafts as $index => $draft)
                                    <tr>
                                        <td>{{Str::limit( $draft->title,"35","...") }}</td>
                                        <td>{{ $draft->created_at }}</td>
                                        <td>
                                            <a wire:navigate  href="{{ route("pegawai.draft.detail",$draft) }}"><button
                                                    class="btn btn-sm bg-main-primary text-white">Detail</button></a>
                                        </td>
                                    </tr>

                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
