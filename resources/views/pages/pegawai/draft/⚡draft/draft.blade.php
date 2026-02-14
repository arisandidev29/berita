<div class="relative">
    <x-user.navbar />

    <div x-data="{ showAlertDelete: false }" class="container-max  my-4 p-8 ">

        <div class="flex gap-4 justify-between">
            <div>
                <h2 class="text-2xl text-main-primary ">Draft Berita </h2>
                <p class="text-neutral-400 text-sm">Menampilkan Semua Draft Berita</p>
            </div>

            <div class="flex gap-3">
                <label class="input">
                    <x-heroicon-m-magnifying-glass class="w-4 opacity-70" />
                    <input wire:model="search" wire:blur="setDraftBack" type="search" required placeholder="Search" />
                </label>
                <button wire:click='searchDraft' class="btn bg-main-light-primary text-white">Search</button>
            </div>
        </div>


        <div x-data="{show : false}"  x-show="show" x-cloak @showSuccessdelete.window="show = true" role="alert" class="alert alert-error my-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Berhasil hapus item </span>
        </div>

        {{-- berita --}}

        <ul class="grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 my-3">
            @forelse ($drafts as $draft)
                <li wire:key='{{ $draft->id }}'>
                    <div class="border-1 border-neutral-300 rounded-xl p-4 overflow-hidden">
                        <div class="group overflow-hidden">

                            @if ($draft->image)
                                <img class="group-has-hover:scale-150 group-has-hover:rotate-12 duration-300 transition-all aspect-4/3 object-cover w-full "src="{{ $draft->image }}"
                                    alt="">
                            @else
                                <div class=" bg-gray-600 grid place-content-center text-white text-2xl aspect-4/3 ">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="mt-2 flex gap-2 items-center">

                            <x-draft-badge :text="$draft->status" />


                            <p class="text-xs font-medium text-neutral-500 flex gap-1">
                                Di buat : {{ $draft->created_at }}
                            </p>
                        </div>
                        <div class="my-2">
                            <h3 class="font-semibold text-lg">{{ $draft->title }}</h3>
                            <div class="text-sm flex flex-col gap-2">

                                <p class="flex gap-2 items-center">
                                    <span class="bg-green-500 px-1 py-0.5 rounded-sm text-white flex gap-1">
                                        <x-heroicon-m-question-mark-circle class="w-3 text-inherit " />
                                        Kontent
                                    </span>
                                    {{ Str::words($draft->content_berita, 5, '...') }}
                                </p>
                                <p class="flex gap-1 items-center">
                                    <span class="bg-blue-500 px-1 py-0.5 rounded-sm text-white flex gap-1">
                                        <x-heroicon-m-map class="w-3 text-inherit " />
                                        Lokasi
                                    </span>
                                    : {{ Str::words($draft->lokasi, 5, '...') }}
                                </p>
                                <p class="flex  items-center gap-2">
                                    <span class="bg-neutral-600 px-1 py-0.5 rounded-sm text-white flex gap-1">
                                        <x-heroicon-c-calendar-date-range class="w-3 text-inherit " />
                                        Waktu
                                    </span> {{ $draft->waktu }}
                                </p>

                            </div>
                            <div class="flex gap-2 items-center mt-3">
                                <a wire:navigate href="{{ route("pegawai.draft.detail", $draft) }}">
                                    <button class="btn bg-main-primary hover:bg-main-dark-primary text-white ">Detail
                                        >></button>

                                </a>

                                <a wire:navigate href="{{ route("update.draft", $draft) }}">
                                    <button class="btn bg-amber-500  hover:bg-amber-700 text-white  flex gap-2">
                                        Edit
                                        <x-heroicon-o-pencil class="w-4 text-inherit" />
                                    </button>
                                </a>
                                    
                                <button @click="$dispatch('showalertwarning',{'id' : {{ $draft->id }}})"
                                    class="btn bg-red-500 hover:bg-red-600 text-white">
                                    Delete
                                    <x-heroicon-s-trash class="w-4 text-inherit" />
                                </button>


                            </div>
                        </div>
                    </div>
                </li>
            @empty

                <div class="h-72 col-start-1 col-span-3 grid place-content-center w-full ">

                    @if (!empty($search))
                        <div>
                            <p class="flex gap-2 items-center text-2xl">
                                Draft tidak di temukan
                                <x-heroicon-m-magnifying-glass class="w-8" />

                            </p>
                        </div>
                    @else
                        <div class="flex flex-col items-center">

                            <p class="flex gap-2 items-center text-2xl">
                                Belum ada Draft Berita
                                <x-heroicon-s-face-smile class="w-8" />
                            </p>

                            <a href="">
                                <button
                                    class="btn flex gap-2 bg-main-light-primary hover:bg-main-primary duration-300 transition text-white my-4 mx-auto">
                                    Buat Berita
                                    <x-heroicon-c-plus class="w-4" />

                                </button>
                            </a>


                        </div>
                    @endif


                </div>
            @endforelse


        </ul>



        {{-- alert component --}}

        {{-- alert --}}

        <x-alert x-data="{ show: false, draftId: '' }" x-cloak x-show="show"
            @showalertwarning.window="draftId = $event.detail.id;  show = true; "
            @closealertwarning.window="show = false" x-transition>
            <x-heroicon-c-exclamation-triangle class="w-23" />
            <p class="text-xl text-neutral-900">Apakah kamu yakin menghapus item ini ?</p>
            <small class="text-sm text-neutral-600">Tindakan ini akan menghapus item secara permanen</small>
            <div class="flex gap-4 justify-center mt-4">
                <button @click="show = false" class="btn border-1 border-neutral-500 ">Tidak</button>
                <button @click="$wire.deleteDraft(draftId)" class="btn bg-red-500 text-white">Ya, Hapus</button>
            </div>
        </x-alert>



    </div>

</div>