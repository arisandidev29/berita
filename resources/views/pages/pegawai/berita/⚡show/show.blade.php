<div x-data="news">
    <x-user.navbar />
    
    <div class="container-max my-6 ">
        @can('update', $news)
            {{-- toast --}}
            <x-toast-alert />

            @if(session()->has('status'))
               <div x-data x-init="$dispatch('activate-toast',{title : '{{ session()->get('status') }}'})"></div> 
            @endif


            {{-- action button --}}
            <div >
                <a wire:navigate href="{{ route("pegawai.berita.edit",$news) }}"><button class="btn bg-main-primary text-white my-1">Edit Berita</button></a>

                <button @click="openDelete({{ $news->id }})" class="btn bg-red-500 text-white my-1">Hapus Berita</button>


                {{-- alert delete --}}
                <x-alert x-cloak x-show="showDelete" @showalertwarning.window="openDelete($event.detail.id)"
                    @closealertwarning.window="closeDelete()" x-transition>
                    <x-heroicon-c-exclamation-triangle class="w-23" />
                    <p class="text-xl text-neutral-900">Apakah kamu yakin menghapus Berita ini ?</p>
                    <small class="text-sm text-neutral-600">Tindakan ini akan menghapus Berita secara permanen</small>
                    <div class="flex gap-4 justify-center mt-4">

                        <button @click="closeDelete()" class="btn border-1 border-neutral-500 ">Tidak</button>
                        <button @click="$wire.deleteNews(newsId)" class="btn bg-red-500 text-white">Ya, Hapus</button>

                    </div>
                </x-alert>
            </div>
        @endcan

        <div class="grid grid-cols-1 md:grid-cols-[80%_1fr]  gap-4">
            {{-- news --}}
            <x-berita.show.show-news :news="$news" />

            {{-- widget --}}
            <x-berita.show.berita-lainya-widget />
        </div>
    </div>
</div>


@push('alpineScript')
    <script>
        function news() {
            return {

                newsId: '',
                showDelete: false,
                
                openDelete(id) {
                    this.newsId= id;
                    this.showDelete = true;
                },
                
                closeDelete() {
                    this.showDelete = false;
                },
                
            }

        }

    </script>
@endpush

