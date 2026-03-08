{{-- action  --}}

<div x-show="!showSearch" x-cloak class="flex gap-3">
    <button @click="deactivateSelected()" class="btn bg-neutral-400">Cancel</button>
    <button @click='$wire.deleteSelected; deactivateSelected()' class="btn bg-red-500 text-white">Delete Selected</button>
</div>

<div  class="relative">
    <button @click="openDropdown()" class="cursor-pointer">
        <x-bi-three-dots-vertical class="w-4" />
    </button>

    <div x-show="showDropdown" x-cloak
        class="absolute top-10 right-0 bg-white border-main-primary border-1 p-4 w-48 rounded-md z-30 ">

        <button
            @click="activateSelected"
            class="btn bg-main-primary text-white w-full text-left!">
            <x-heroicon-s-check class="w-5" />
            Multi Select
        </button>
    </div>
</div>
