 @props(['search'])
 <div class="h-72 col-start-1 col-span-3 grid place-content-center w-full ">

     @if (!empty($search))
         <div>
             <p class="flex gap-2 items-center text-2xl">
                 Draft tidak di temukan
                 <x-heroicon-m-magnifying-glass class="w-8" />

             </p>
         </div>
     @else
         <div class="flex flex-col items-center">

             <p class="flex gap-2 items-center text-2xl">
                 Belum ada Draft Berita
                 <x-heroicon-s-face-smile class="w-8" />
             </p>

             <a href="">
                 <button
                     class="btn flex gap-2 bg-main-light-primary hover:bg-main-primary duration-300 transition text-white my-4 mx-auto">
                     Buat Berita
                     <x-heroicon-c-plus class="w-4" />

                 </button>
             </a>


         </div>
     @endif


 </div>
