<div>
    <x-user.navbar />

    <x-toast-alert />


    @if (session()->has('status'))
        <div x-init="$dispatch('activate-toast', { title: '{{ session()->get('status') }}' })"></div>
    @endif

    {{-- start news here --}}
    <div class="px-8 my-6 container-max">
        <div class="flex flex-col md:flex-row justify-between items-center">

            <div>
                <h1 class="text-3xl font-semibold text-main-primary ">Berita Saya</h1>
                <p class="text-sm text-gray-400 ">Menampilkan semua Berita </p>

            </div>

            {{-- search --}}
            <div class="flex gap-3 items-center mb-4 mt-6">
                <label class="input">
                    <x-heroicon-m-magnifying-glass class="w-4 opacity-70" />
                    <input wire:model.live="search" type="search" required placeholder="Search" />
                </label>
                <button wire:click='searchNews' class="btn bg-main-light-primary text-white">Search</button>
            </div>

        </div>

        {{-- card container --}}
        <div class="grid md:grid-cols-2 grid-cols-1 gap-5 ">

            {{-- card news --}}
            @forelse($news as $item)
                <x-berita.news-card :item="$item" :key="$item->id" />
            @empty
                <x-berita.news-empty-draft />
            @endforelse
        </div>

    </div>
    {{-- end news --}}
</div>
