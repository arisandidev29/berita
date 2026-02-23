<div>
    <x-user.navbar />

     @push('script')
      @vite('resources/js/trix.js')
    @endpush


    <div class="container-max mt-4">
        {{-- breadcrumb --}}
        <div class="breadcrumbs text-md my-4">
            <ul>
                <li><a>Home</a></li>
                <li><a>Draft</a></li>
                <li>Detail</li>
            </ul>
        </div>

        {{-- show berita --}}
        <div>
            @if ($newsDraft->status == 'generated')
            <livewire:show-news :newsDraft="$newsDraft" :key="$newsDraft->newsResult->updated_at->timestamp"  />
            @endif
        </div>

        {{-- draft --}}
        <div class="min-h-64 shadow-main-primary shadow-md rounded-2xl p-10 flex gap-6 my-4" >
            <div class="w-[40%] ">
                @if ($newsDraft->image)
                    <img class="aspect-square object-cover w-full rounded-lg" src="{{ $newsDraft->image }}" alt="image">
                @else
                    <div
                        class="w-full aspect-square object-cover rounded-lg grid place-content-center text-2xl bg-neutral-900 text-white">
                        No Image</div>
                @endif

            </div>
            <div>
                <div class="flex gap-4 items-center">
                    <x-detail-badge :text="$newsDraft->status" />
                    <p class="text-lg text-neutral-500 ">Dibuat : {{ $newsDraft->created_at }} </p>
                </div>

                <h1 class="text-4xl font-semibold my-5">{{ $newsDraft->title }}</h1>



                <p class="text-sm my-4 text-neutral-600">
                    <span class="bg-green-500 px-2 py-1 rounded-full text-white">Content</span>
                    {{ $newsDraft->content_berita }}
                </p>

                <p class="text-sm my-4 text-neutral-600">
                    <span class="bg-blue-500 px-2 py-1 rounded-full text-white">Lokasi</span> :
                    {{ $newsDraft->lokasi }}
                </p>
                <p class="text-sm my-4 text-neutral-600">
                    <span class="bg-neutral-500 px-2 py-1 rounded-full text-white">waktu</span> :
                    {{ $newsDraft->waktu }}
                </p>

                <hr class="mt-4">

                <div class="mt-4 flex justify-end gap-4">

                    <a wire:navigate href="{{ route('update.draft', $newsDraft) }}">
                        <button class=" btn bg-amber-500  hover:bg-amber-700  text-white  flex gap-2">
                            Edit
                            <x-heroicon-o-pencil class="w-5 text-inherit" />
                        </button>
                    </a>

                    <div>
                        @if($newsDraft->status == 'generated' || $newsDraft->status == 'publish') 

                        <button @click="$dispatch('showalertregenerate')"
                            class="btn bg-blue-500 text-white flex gap-2 }}">
                            Regenerate
                            <x-ri-ai-generate-2 class="w-5 text-inherit" />
                        </button>

                        @else 

                        <button @click="$dispatch('showalertgenerate')"
                            class="btn bg-blue-500 text-white flex gap-2 }}">
                            Generate
                            <x-ri-ai-generate-2 class="w-5 text-inherit" />
                        </button>
                        @endif
                    </div>



                </div>

            </div>
        </div>

        <div class="shadow-lg shadow-main-primary p-10 rounded-lg mt-6 ">
            <h3 class="text-2xl font-bold flex gap-4 items-center text-main-primary">
                <x-heroicon-s-information-circle class="w-10 text-inherit " />
                Informasi
            </h3>

            <div class="my-4">
                <p class="font-semibold text-lg">Tokoh</p>
                <p>{{ $newsDraft->tokoh }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>
            <div class="my-4">
                <p class="font-semibold text-lg">Data Pendukung</p>
                <p>{{ $newsDraft->data_pendukung }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>
            <div class="my-4">
                <p class="font-semibold text-lg">Tone Style</p>
                <p>{{ $newsDraft->newsDrafConfig->tone_style }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>
            <div class="my-4">
                <p class="font-semibold text-lg">Mode Fakta</p>
                <p>{{ $newsDraft->newsDrafConfig->strict_fact_mode ? 'Yes' : 'No' }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>
            <div class="my-4">
                <p class="font-semibold text-lg">Prompt Mode</p>
                <p>{{ $newsDraft->newsDrafConfig->prompt_mode }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>
            <div class="my-4">
                <p class="font-semibold text-lg">Custome Prompt</p>
                <p>{{ $newsDraft->newsDrafConfig->custom_prompt_text ?? '-' }}</p>
                <hr class="mt-4 text-neutral-400">
            </div>




        </div>

    </div>


    {{-- toast --}}

    <x-toast-alert >
        <x-heroicon-m-check-circle class="w-6" />
     </x-toast-alert>

    {{-- alert generate --}}
    <x-alert x-data="{ show: false, }" x-cloak x-show="show"
        @showalertgenerate.window="draftId = $event.detail.id;  show = true; " @closealertgenerate.window="show = false"
        x-transition>

        <x-heroicon-o-information-circle class="w-23 stroke-main-primary" />

        <p class="text-xl text-neutral-900">Apakah kamu yakin generate berita ini ?</p>

        <small class="text-sm text-neutral-600">Tindakan ini akan membuat berita </small>

        <div class="flex gap-4 justify-center mt-4">
            <button @click="show = false" class="btn border-1 border-neutral-500 ">Tidak</button>
            <button wire:click="generate" class="btn bg-main-primary text-white">Ya, Generate</button>
        </div>

    </x-alert>

    {{-- alert regenarate --}}
    <x-alert x-data="{ show: false, }" x-cloak x-show="show"
        @showalertregenerate.window="draftId = $event.detail.id;  show = true; " @closealertregenerate.window="show = false"
        x-transition>

        <x-heroicon-o-information-circle class="w-23 stroke-main-primary" />

        <p class="text-xl text-neutral-900">Apakah kamu yakin generate ulang berita ini ?</p>

        <small class="text-sm text-neutral-600">Tindakan ini akan membuat ulang berita, berita yang sudah ada akan di hapus !</small>
        <div class="flex gap-4 justify-center mt-4">
            <button @click="show = false" class="btn border-1 border-neutral-500 ">Tidak</button>
            <button wire:click="regenerate" class="btn bg-main-primary text-white">Ya, Generate</button>
        </div>
    </x-alert>


    {{-- loading generate --}}

    <div wire:loading wire:target='regenerate'
        class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
        <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
            <div class="loader"></div>
            <p class="text-sm mt-2">Membuat berita ...</p>
        </div>


    </div>


</div>
</div>
