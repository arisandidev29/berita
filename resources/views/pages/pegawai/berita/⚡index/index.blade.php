<div>
    <x-user.navbar />

    <x-toast-alert />


    @if (session()->has('status'))
        <div x-init="$dispatch('activate-toast', { title: '{{ session()->get('status') }}' })"></div>
    @endif

    {{-- start news here --}}
    <div class="px-8 my-6 container-max">
        <div class="flex justify-between items-center">

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
        <div class="grid grid-cols-2 gap-5 ">

            {{-- card news --}}
            @forelse($news as $item)
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
        </div>

    </div>
    {{-- end news --}}
</div>
