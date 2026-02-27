   @props(["target","text" => "loading ..."])
   <div wire:loading wire:target="{{ $target }}"
       class="fixed inset-0 h-screen bg-[rgba(0,0,0,.7)] grid place-content-center">
       <div class="bg-white w-64 h-32 rounded-xl p-4 mx-auto flex justify-center items-center gap-2 flex-col">
           <div class="loader"></div>
           <p class="text-sm mt-2">{{ $text }}</p>
       </div>


   </div>
