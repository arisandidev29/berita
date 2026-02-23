



 <div x-data="{ isEditable: false }" @enable-edit.window="isEditable = true" @disable-edit.window="isEditable = false" ">

    {{-- alert  --}}

     <div class="flex gap-4 justify-end">
         <button x-show="!isEditable" x-cloak @click="isEditable = true" class="btn bg-amber-400 text-white">Edit</button>

         <div x-show="isEditable" x-cloak>

             <button @click="isEditable = false;
                         $wire.image = '';
                         $dispatch('reset-image');
                         " class="btn bg-neutral-500 text-white">Cancel</button>

             <button class="btn bg-main-primary text-white" wire:click="saveNews">Save</button>
         </div>


         <button x-show="!isEditable" x-cloak class="btn bg-main-primary text-white flex gap-2">
             Publish
             <x-heroicon-o-globe-alt class="w-5 text-inherit" />
         </button>
     </div>


     <div class="shadow-md shadow-main-primary my-4 rounded-lg p-6">

         {{-- edit image --}}
         <x-user.edit-news-image :currentImage="$news->image" :newImage="$image" />

         <div class="mx-auto max-w-fit">

             <div class="mx-auto my-3 flex gap-4 items-center">
                 <span class="flex gap-2">
                     <x-heroicon-s-user class="w-5 text-inherit" />
                     {{ auth()->user()->pegawai->nama }}
                 </span>
                 <small class="text-sm font-semibold text-neutral-500">DiBuat :
                     {{ $news->waktu }}</small>
             </div>

             <div  x-show="isEditable" x-cloak x-data="{ value: @entangle('content') }" @trix-change="
                    value = $event.target.value;
                    " class="prose">
                 <input type="hidden" id="trix" name="trix" value="{{ $content }}">
                 <trix-editor input="trix">

                 </trix-editor>
             </div>

             <div x-show="!isEditable" x-cloak class="prose">
                 {!! $content !!} 
             </div>



         </div>
     </div>

     {{-- loading update berita --}}
     <div wire:loading wire:target='saveNews' class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
         <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
             <div class="loader"></div>
             <p class="text-sm mt-2">Update Berita ... </p>
         </div>
     </div>
