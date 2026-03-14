@props([
    "draft"
])
<li class="relative">

    <div  x-show="activeSelect"  x-cloak>
        <input value="{{ $draft->id }}" wire:model='selectedDraft'  type="checkbox"
            class="absolute -right-2 -top-2 checkbox checkbox-md bg-white checked:bg-main-primary checked:text-white">
    </div>

    <div class="border-1 border-neutral-300 rounded-xl p-2 md:p-4 overflow-hidden">
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
            <h3 class="font-semibold text-md md:text-lg my-2">{{ $draft->title }}</h3>
            <div class=" text-xs md:text-sm flex flex-col gap-2">

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
            <div x-show="!activeSelect" x-cloak class="flex gap-2 items-center mt-3 ">
                <a wire:navigate href="{{ route('pegawai.draft.detail', $draft) }}">
                    <button class="btn bg-main-primary hover:bg-main-dark-primary text-white   ">Detail
                        </button>

                </a>

                <a wire:navigate href="{{ route('update.draft', $draft) }}">
                    <button class="btn bg-amber-500  hover:bg-amber-700 text-white  flex gap-2">
                        Edit
                        <x-heroicon-o-pencil class="w-4 text-inherit" />
                    </button>
                </a>

                <button @click="$dispatch('showalertwarning',{'id' : {{ $draft->id }}})"
                    class="btn bg-red-500 hover:bg-red-600 text-white">
                    <x-heroicon-s-trash class="w-4 text-inherit" />
                </button>



            </div>
        </div>
    </div>
</li>
