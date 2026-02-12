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
                    <p class="text-3xl font-semibold text-main-primary">10</p>
                </div>

                <div class="mt-4">
                    <p class="font-semibold text-lg text-green-600">Berita Terbit</p>
                    <p class="text-3xl font-semibold text-green-600">5</p>
                </div>
            </div>
        </div>
    </div>


    {{-- latest Berita --}}

    <div class="container-max  my-4 p-8 ">

        <div class="flex gap-4 justify-between">
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
            @for ($i = 0; $i < 5; $i++)
                <li>
                    <div class="border-1 border-neutral-300 rounded-xl p-4">
                        <div class="group overflow-hidden">
                            <img class="group-has-hover:scale-150 group-has-hover:rotate-12 duration-300 transition-all "
                                src="/asset/card.webp" alt="">
                        </div>

                        <div class="mt-2 flex gap-4 items-center">

                            <p class="text-xs bg-main-light-primary text-white px-2 py-1 rounded-lg flex gap-1">
                                <x-heroicon-s-globe-alt class="w-3 text-inherit" />
                                published
                            </p>

                            <p class="text-xs font-medium text-neutral-500 flex gap-1">
                                <x-heroicon-c-calendar-date-range class="w-3 text-inherit" />
                                19-03-2026
                            </p>
                        </div>
                        <div class="my-2">
                            <h3 class="font-semibold text-lg">title Lorem, ipsum dolor.</h3>
                            <p class="text-sm text-neutral-600">content Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Necessitatibus,
                                voluptate.
                            </p>

                            <div class="flex gap-2">
                                <button class="btn bg-main-primary hover:bg-main-dark-primary text-white mt-2">Detail
                                    >></button>

                                <button class="btn bg-amber-500  hover:bg-amber-700 text-white mt-2 flex gap-2">
                                    Edit
                                    <x-heroicon-o-pencil class="w-4 text-inherit" />
                                </button>

                            </div>
                        </div>
                    </div>
                </li>
            @endfor

        </ul>



    </div>


</div>
