<div x-data="news">
    <x-user.navbar />

    <div class="container-max my-4 px-2 ">

        <div class="flex justify-end my-4">
            <button wire:click='save' class="btn bg-main-primary text-white">Simpan</button>
        </div>

        <div>
            <div x-cloak x-show="imageUrl" class="relative">
                <img :src="imageUrl" alt="news image" class="w-full aspect-video object-cover rounded-sm">
                @can('update', $news)
                    <div class="absolute flex gap-3 items-center top-5 right-5">
                        <button @click="deleteImage($wire)" class="btn bg-red-500 text-white">Hapus Gambar</button>
                        <button @click="$refs.inputImage.click()" class="btn bg-main-primary text-white">Ganti
                            Gambar</button>
                    </div>
                @endcan
            </div>
            <div x-show="!imageUrl" x-show
                class="border-gray-500 border p-4 grid place-content-center rounded-md items-center">
                <input type="file" x-ref="inputImage" wire:model="image"
                    @change="changeImage($event.target.files[0])" class="hidden">
                <x-heroicon-m-cloud-arrow-up class="w-20 mx-auto" />
                <button @click="$refs.inputImage.click()" class="btn bg-main-primary text-white">Upload Gambar</button>
                <small class="text-center mt-2 text-sm text-gray-400">*Max 2Mb</small>
            </div>


        </div>

        <div class="prose md:prose-xl mx-auto">

            {{-- title --}}
            <label class="my-4 block">
                <span class="text-lg font-bold mb-1">Judul Berita</span>
                <input type="text" wire:model='title'
                    class="border-neutral-400 border-1 px-2 py-1 text-xl font-bold rounded-md">
            </label>

            {{-- content --}}
            <div>
                <span class="text-lg font-bold mb-1">Isi Berita</span>
                <input type="hidden" id="trix" name="trix" value="{{ $body }}">
                <trix-editor @trix-change="body = $event.target.value;" input="trix" />
            </div>
        </div>

    </div>


    <div wire:loading wire:target='save' class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
        <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
            <div class="loader"></div>
            <p class="text-sm mt-2">Membuat berita ...</p>
        </div>


    </div>

    {{-- toast --}}
    <x-toast-alert>
        <x-heroicon-m-check-circle class="w-6" />
    </x-toast-alert>
</div>

@push('script')
    @vite('resources/js/trix.js')
@endpush

@push('alpineScript')
    <script>
        function news() {
            return {
                imageUrl: '{{ $currentImage }}',
                body: @entangle('body'),

                changeImage(image) {
                    if (image) {
                        this.imageUrl = window.URL.createObjectURL(image)
                    }
                },
                deleteImage(wire) {
                    this.imageUrl = "";
                    wire.set("image", "");
                    wire.set("deleteImage", true);
                }
            }
        }
    </script>
@endpush
