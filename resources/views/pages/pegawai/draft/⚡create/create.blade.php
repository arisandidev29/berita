<div>
    <x-user.navbar />

    <div class="container-max my-6 px-4">
        <h2 class="text-2xl text-main-primary ">Buat Draft Berita</h2>


        <div x-data="{ show: false }" x-cloak x-show="show" @success-create-draft.window="show = true" role="alert"
            class="alert alert-success my-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Berhasil Buat Draft</span>
        </div>
        
        <div x-data="{ show: false }" x-cloak x-show="show" @success-create-news.window="show = true" role="alert"
            class="alert alert-success my-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Berhasil Buat berita</span>
        </div>

        <div class="my-4 block md:grid lg:grid-cols-4 md:grid-cols-1 gap-3">

            <div class="lg:col-start-1 lg:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-3">

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Title</legend>
                    <input wire:model='title' type="text" class="input" placeholder="tulis title" />
                    @error('title')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Tokoh</legend>
                    <input wire:model='tokoh' type="text" class="input" placeholder="tokoh" />
                    @error('tokoh')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Waktu</legend>
                    <input wire:model='waktu' type="date" class="input w-full" placeholder="Type here" />
                    @error('waktu')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Lokasi</legend>
                    <input wire:model='lokasi' type="text" class="input" placeholder="lokasi" />
                    @error('lokasi')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Kronologi</legend>
                    <textarea wire:model='kronologi' class="textarea h-24" placeholder="kronologi"></textarea>
                    @error('kronologi')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Kontent Berita</legend>
                    <textarea wire:model='content_berita' class="textarea h-24" placeholder="kontent berita"></textarea>
                    @error('content_berita')
                        <p class="label text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>
            </div>

            <fieldset class="fieldset " x-data="{ imageUrl: null }">
                <legend class="fieldset-legend">Pilih file gambar</legend>

                <input wire:model='image' type="file" class="file-input" accept="image/*"
                    @change="
            const file = $event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => { imageUrl = e.target.result; };
                reader.readAsDataURL(file);
            }
        " />

                <template x-if="imageUrl">
                    <div class="mt-4">
                        <p class="text-sm mb-2">Preview:</p>
                        <img :src="imageUrl" class="rounded-lg max-w-xs shadow-md border" />

                        <button type="button"
                            @click="imageUrl = null; $el.closest('fieldset').querySelector('input').value = ''"
                            class="btn btn-xs btn-error mt-2">
                            Hapus
                        </button>
                    </div>
                </template>


                <label class="label">Max size 2MB</label>

                @error('image')
                    <p class="text-red mt-2">{{ $message }}</p>
                @enderror

            </fieldset>

            <div x-data="{ customePrompt: false }" tabindex="0"
                class="collapse col-span-4 mt-4 collapse-arrow bg-base-100 border-base-300 border">
                <div class="collapse-title font-semibold">Tingkat Lanjut</div>
                <div class="collapse-content text-sm ">
                    <p class="my-4">Gunakan Mode tingkat lanjut dengan hati hati, pastikan sudah membaca dan input
                        dengan benar</p>
                    <div class="block lg:grid lg:grid-cols-2 gap-4 ">
                        <fieldset class="fieldset ">
                            <legend class="fieldset-legend">Tone Style</legend>
                            <select wire:model='tone_style' class="select w-full">
                                <option selected>Informative</option>
                                <option>Formal</option>
                                <option>Santai</option>
                                <option>Dramatis</option>
                                <option>StoryTelling</option>
                            </select>
                            <span class="label">* hati hati menggunakanan tone stye, akan mengakibatkan hasil yang
                                tidak
                                di inginkan.
                            </span>
                        </fieldset>

                        <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-full border p-4 ">
                            <legend class="fieldset-legend">Mode Fakta</legend>
                            <label class="label">
                                <input wire:model='strict_fact_mode' type="checkbox" checked="checked"
                                    class="checkbox" />
                                Output yang di hasilkan harus sesuai fakta
                            </label>
                        </fieldset>

                        <fieldset class="fieldset w-full col-span-2">
                            <legend class="fieldset-legend">Prompt Mode </legend>
                            <select wire:model='prompt_mode' class="select w-full">
                                <option @click="customePrompt = false; $wire.custome_prompt_text = null" selected>
                                    Default</option>
                                <option @click="customePrompt = true">Custome</option>
                            </select>
                            <span class="label   break-all w-32  "></span>
                        </fieldset>


                        <fieldset class="fieldset col-span-2">
                            <legend class="fieldset-legend">Custome Prompt</legend>
                            <textarea wire:model='custom_prompt_text' :disabled="!customePrompt" class="textarea h-24"
                                placeholder="Custome Prompt"></textarea>
                            <p>Fitur ini akan aktif jika memilih mode prompt pada custome prompt, buat prompt dengan
                                hati hati atau output yang di hasilkan tidak sesuai </p>
                            @error('custome_prompt')
                                <p class="label text-red-500">{{ $message }}</p>
                            @enderror
                        </fieldset>

                    </div>
                </div>
            </div>



            <div class="flex gap-4 my-3">
                <button wire:click='save' class="btn bg-main-light-primary text-white">Simpan Draft</button>
                <button @click="$dispatch('showalertgenerate')" class="btn bg-blue-500 text-white">
                    Simpan dan Generate
                    <x-ri-ai-generate-2 class="w-4 text-inherit" />
                </button>
            </div>


            {{-- alert generate --}}

            <x-alert x-data="{ show: false,  }" x-cloak x-show="show"
                @showalertgenerate.window="draftId = $event.detail.id;  show = true; "
                @closealertgenerate.window="show = false" x-transition>
                <x-heroicon-o-information-circle class="w-23 stroke-main-primary" />
                <p class="text-xl text-neutral-900">Apakah kamu yakin generate berita ini ?</p>
                <small class="text-sm text-neutral-600">Tindakan ini akan membuat berita </small>
                <div class="flex gap-4 justify-center mt-4">
                    <button @click="show = false" class="btn border-1 border-neutral-500 ">Tidak</button>
                    <button wire:click="generate" class="btn bg-main-primary text-white">Ya, Generate</button>
                </div>
            </x-alert>


            {{-- loading draft --}}
            <div wire:loading wire:target='save'
                class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
                <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
                    <div class="loader"></div>
                    <p class="text-sm mt-2">Menyimpan Draft ...</p>
                </div>

            </div>

            <div wire:loading wire:target='generate'
                class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
                <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
                    <div class="loader"></div>
                    <p class="text-sm mt-2">membuat berita ...</p>
                </div>

            </div>

        </div>
    </div>
</div>
