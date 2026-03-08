{{-- search --}}
<div x-show="showSearch" x-cloak class="flex gap-3 items-center">
    <label class="input">
        <x-heroicon-m-magnifying-glass class="w-4 opacity-70" />
        <input wire:model="search" wire:blur="setDraftBack" type="search" required placeholder="Search" />
    </label>
    <button wire:click='searchDraft' class="btn bg-main-light-primary text-white">Search</button>
</div>
