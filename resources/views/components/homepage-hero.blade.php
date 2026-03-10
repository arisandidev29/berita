@props([
    "totalDraft",
    "totalNews"
])
<section
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

        <div class="flex gap-4 flex-col lg:flex-row">
            <div class="w-full bg-white rounded-2xl p-4">
                <p class="text-slate-600 text-md">Total Draft</p>
                <p class="text-4xl  text-main-primary">{{ $totalDraft }}</p>
            </div>
            <div class="w-full bg-white rounded-2xl p-4">
                <p class="text-slate-600 text-md">Berita Terbit</p>
                <p class="text-4xl  text-green-400">{{ $totalNews}}</p>
            </div>
        </div>
    </div>
</section>
