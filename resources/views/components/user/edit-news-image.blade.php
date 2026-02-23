@props([
    'currentImage' => '',
    'newImage' => '',
])
<div 
    x-data="{ 
    imageUrl: '{{ $currentImage}}',
    resetImage() {
        this.imageUrl = '{{ $currentImage }}',
        this.$refs.imageInput.value = '';
    }
     }"
    x-init="$watch('$wire.image',(value) => {
        if(value) {
            this.imageUrl = '{{ $currentImage }}'
        }else if(!value) {
            this.imageUrl = '';
        }
    } )" 
    @reset-image.window="resetImage()"
    class="relative">

    <img x-show="imageUrl" x-cloak class="rounded-lg aspect-video object-cover w-full" 
        :src="imageUrl" alt="">

    {{-- input image --}}
    <div x-show="isEditable" x-cloak>
        <input wire:model='image' type="file" x-ref="imageInput" class="hidden"
            @change="
                        const file = $event.target.files[0];
                        if(file) {
                            imageUrl = window.URL.createObjectURL(file);
                        }
                        ">
        <div x-show="imageUrl" x-cloak  class="absolute top-4 right-8">
            <button @click="
            imageUrl = '';
            $wire.image = '';
            $wire.deleteImage = true;
            " class="btn bg-red-500 text-white">Hapus Foto</button>
            <button @click="$refs.imageInput.click()" class="btn bg-main-light-primary text-white">Ganti Foto</button>
        </div>

        <div x-show="!imageUrl" x-cloak class="border-1 border-neutral-300 rounded-md p-6  flex flex-col items-center ">
            <div role="alert" class="alert alert-warning">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>Warning: Gambar yang di Upload akan di gunakan sebagai gambar draft
                    juga</span>
            </div>
            <x-heroicon-m-cloud-arrow-up class="w-20" />

            <button @click="$refs.imageInput.click()" class="btn bg-main-primary text-white">Upload Gambar</button>

            <small class="text-sm text-neutral-400">Max size : 2mb</small>

        </div>
    </div>
</div>
