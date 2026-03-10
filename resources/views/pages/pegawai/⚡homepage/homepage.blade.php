<div>
    <x-user.navbar />


    <div
        class="bg-linear-to-tr from-main-light-primary to-main-dark-primary py-12 px-8  my-6 shadow-xl shadow-main-light-primary">
        <div class="container-max min-h-56  grid grid-cols-2 gap-4 items-center  ">

            <div class="p-4">
                <h1 class="flex gap-4 items-center text-5xl text-white font-bold">
                    Hallo, {{ auth()->user()->pegawai->nama }}
                    <x-heroicon-o-hand-raised class="w-12 text-yellow-300" />
                </h1>

                <p class="mt-4 font-thin text-sm text-gray-100">Punya Berita baru? ingin Buat Cepat Pakai Ai ?</p>
                <a href="">
                    <button class="btn bg-main-secondary mt-4">Buat Berita Sekarang</button>
                </a>
            </div>

            <div class="w-full bg-white p-8 rounded-xl">
                <h2 class=" text-2xl font-bold text-main-light-primary">Statik Saya</h2>

                <div class="mt-4">
                    <p class="font-semibold text-lg text-main-primary">Total Draf</p>
                    <p class="text-3xl font-semibold text-main-primary">{{ $totalDraft }}</p>
                </div>

                <div class="mt-4">
                    <p class="font-semibold text-lg text-green-600">Berita Terbit</p>
                    <p class="text-3xl font-semibold text-green-600">{{ $totalNews }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class=" grid gap-4 grid-cols-[70%_1fr]   my-2 p-4 w-[80%] mx-auto ">
        <div class="flex flex-col gap-10">
            {{-- chart --}}

            <div class="rounded-2xl shadow-2xl p-10  ">
                <h2 class="text-xl font-semibold">Statik Berita Penulis</h2>
                <div id="chart" ></div>
            </div>

            {{-- latest Berita --}}


            <div class="mt-4 flex gap-4 justify-between">
                <div>
                    <h2 class="text-2xl text-main-primary ">Berita Terbaru</h2>
                    <p class="text-neutral-400 text-sm">menampilkan berita yang telah di published </p>
                </div>

                <div class="flex gap-3">
                    <label class="input">
                        <x-heroicon-m-magnifying-glass class="w-4 opacity-70" />
                        <input type="search" required placeholder="Search" />
                    </label>
                    <button class="btn bg-main-light-primary text-white">Search</button>
                </div>
            </div>

            {{-- berita --}}

            <ul class="grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 my-3">
                @forelse($this->news as $item)
                    <a wire:navigate href="{{ route('pegawai.berita.show', $item) }}">
                        <div
                            class="rounded-md border border-neutral-300 hover:border-neutral-600 hover:border-1 duration-300 transition-all">
                            <div class="overflow-hidden">
                                @if ($item->newsDraf->image)
                                    <img src="{{ $item->newsDraf->image }}"
                                        class="w-full aspect-video object-cover hover:scale-150  hover:transition-all hover:grayscale-100 duration-500">
                                @else
                                    <div class="bg-slate-700 text-white w-full aspect-video grid place-content-center">
                                        <p class="text-2xl">No Image</p>
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col gap-2 p-3 my-2">
                                <h2 class="text-xl font-bold">{{ $item->title }}</h2>
                                <div class="text-xs flex gap-4 items-center">
                                    <span class="flex gap-2 items-center">
                                        <x-heroicon-s-user class="w-5 text-inherit" />
                                        {{ auth()->user()->pegawai->nama }}
                                    </span>
                                    <span class="text-neutral-600">
                                        12-08-2026
                                    </span>
                                </div>
                                <p class="text-neutral-500">{{ Str::limit(strip_tags($item->body), 200, '...') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="flex flex-col items-center col-span-2 mt-8 border border-gray-300 hover:border-gray-400 rounded-lg px-10 py-15">

                        <p class="flex gap-2 items-center text-2xl">
                            Belum Ada Berita Yang Di Publish
                            <x-heroicon-s-face-smile class="w-8" />
                        </p>

                        </a>

                    </div>
                @endforelse

                {{-- paginate --}}
                {{ $this->news->links() }}



            </ul>

        </div>
        <div>


            {{-- calendar --}}

            <div class="card bg-base-100 shadow-xl p-6">
                <h2 class="card-title mb-4">Aktivitas Penulisan (30 Hari Terakhir)</h2>

                <!-- Grid Kalender -->
                <div class="grid grid-cols-7 gap-2">
                    @foreach ($this->getCalenderData() as $item)
                        @php
                            // Tentukan warna berdasarkan jumlah berita
                            $colorClass = 'bg-base-200'; // Default kosong
                            if ($item['count'] > 0 && $item['count'] <= 2) {
                                $colorClass = 'bg-success/30 text-success-content';
                            }
                            if ($item['count'] > 2 && $item['count'] <= 5) {
                                $colorClass = 'bg-success/60 text-white';
                            }
                            if ($item['count'] > 5) {
                                $colorClass = 'bg-success text-white';
                            }
                        @endphp

                        <div class="tooltip" data-tip="{{ $item['date'] }}: {{ $item['count'] }} Berita">
                            <div
                                class="w-full aspect-square {{ $colorClass }} rounded-md flex items-center justify-center text-xs font-bold transition-all hover:scale-110 cursor-pointer">
                                {{ $item['day'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Keterangan Warna -->
                <div class="flex items-center gap-2 mt-6 text-xs opacity-70">
                    <span>Less</span>
                    <div class="w-3 h-3 bg-base-200 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success/30 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success/60 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success rounded-sm"></div>
                    <span>More</span>
                </div>

            </div>

            {{-- draft --}}
            <div class="my-8">
                <h2 class="text-main-light-primary text-2xl font-semibold my-5">Draft Berita</h2>
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
