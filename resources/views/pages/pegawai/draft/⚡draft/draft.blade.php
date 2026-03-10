<div x-data="draftData" @deactive-selected.window="deactivateSelected()" class="relative">
    <x-user.navbar />
    <div class="container-max  my-4 p-8 ">
        {{-- header --}}
        <x-draft.draft.header />

        {{-- berita --}}
        <ul class="grid gap-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 my-3">
            @forelse ($drafts as $draft)
                <x-draft.draft.card :draft="$draft" :key="$draft->id" />
            @empty
                <x-draft.draft.empty :search="$search" />
            @endforelse
        </ul>

        {{-- loading --}}

        <x-loading target="deleteSelected,deleteDraft" title="Menghapus Draft ..." />

        {{-- toast --}}
        <x-toast-alert>
            <x-heroicon-m-check-circle class="w-6" />
        </x-toast-alert>



        {{-- alert --}}
        <x-alert x-cloak x-show="showDelete" @showalertwarning.window="openDelete($event.detail.id)"
            @closealertwarning.window="closeDelete()" x-transition>
            <x-heroicon-c-exclamation-triangle class="w-23" />
            <p class="text-xl text-neutral-900">Apakah kamu yakin menghapus item ini ?</p>
            <small class="text-sm text-neutral-600">Tindakan ini akan menghapus item secara permanen</small>
            <div class="flex gap-4 justify-center mt-4">

                <button @click="closeDelete()" class="btn border-1 border-neutral-500 ">Tidak</button>
                <button @click="closeDelete();$wire.deleteDraft(draftId)" class="btn bg-red-500 text-white">Ya,
                    Hapus</button>

            </div>
        </x-alert>
    </div>
</div>

@push('alpineScript')
    <script>
        function draftData() {
            return {
                showSearch: true,
                showDropdown: false,
                showDelete: false,
                draftId: '',
                activeSelect: false,
                openDropdown() {
                    this.showDropdown = true;
                },

                activateSelected() {
                    this.showDropdown = false;
                    this.activeSelect = true;
                    this.showSearch = false;
                    console.log(this.activeSelect);
                },

                deactivateSelected() {
                    this.activeSelect = false;
                    this.showSearch = true;
                },

                openDelete(id) {
                    this.draftId = id;
                    this.showDelete = true;
                },

                closeDelete() {
                    this.showDelete = false;
                },




            }
        }

        // documentd.addEventListener("alpine:init", () => {
        //     Alpine.data('draftData', () => (

        //         {
        //                   showSearch: true,
        //                   showDropdown: false,
        //                   showDelete: false,
        //                   draftId: '',
        //                   activeSelect: false,

        //                   openDropdown() {
        //                       this.showDropdown = true;
        //                   },

        //                   activateSelected() {
        //                       this.showDropdown = false;
        //                       this.activeSelect = true;
        //                       this.showSearch = false;
        //                       console.log(this.activeSelect);
        //                   },

        //                   deactivateSelected() {
        //                       this.activeSelect = false;
        //                       this.showSearch = true;
        //                   },

        //                   openDelete(id) {
        //                       this.draftId = id;
        //                       this.showDelete = true;
        //                   },

        //                   closeDelete() {
        //                       this.showDelete = false;
        //                   },



        //           }
        //     ))
        // })
    </script>
@endpush
