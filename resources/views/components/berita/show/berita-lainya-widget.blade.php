     <div>
         <h3 class="text-lg font-semibold text-main-primary">Berita Lainya </h3>

         <ul class="mt-4 flex flex-col gap-4">
             @for ($i = 0; $i < 5; $i++) <a href="" ">
                        <li class=" flex gap-1 item-center border border-neutral-200 hover:border-neutral-400 rounded-sm p-1">
                 <img src="/asset/card.webp" alt="" class=" w-16 aspect-square object-cover ">

                 <p class="text-sm">{{ Str::limit('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita, ad!', 50) }}</p>
                 </li>
                 </a>
                 @endfor
         </ul>
     </div>
