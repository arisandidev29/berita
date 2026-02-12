<div class="navbar bg-base-100 shadow-sm flex justify-between">
        <a class="btn btn-ghost text-xl">daisyUI</a>
        <div class="flex gap-4 items-center">

            <a wire:navigate href="{{ route("pegawai.draft") }}" ><button class="border-1 border-main-light-primary  px-4 py-2 rounded-sm text-main-light-primary hover:text-white  hover:bg-main-light-primary cursor-pointer hover:duration-300 transition-all duration-300">Draft</button></a>

            <a href=""><button class="border-1 border-main-light-primary  px-4 py-2 rounded-sm text-main-light-primary hover:text-white  hover:bg-main-light-primary cursor-pointer hover:duration-300 transition-all duration-300">Berita</button></a>
            
            <a wire:navigate href="{{ route("create.draft") }}"><button class="btn bg-main-primary text-white ">Buat Berita</button></a>

            {{-- profile --}}
            <div x-data="{show : false}"
                 class="relative "
                 >

                 <div
                  @click="show = !show"
                  class=" tooltip tooltip-left cursor-pointer " data-tip="Profile">
                        @if(auth()->user()->profile_pic)
                            <img class="w-10 rounded-full  " src="/asset/example.webp" /><img src="" alt="" ">
                        @else
                            <div class="bg-neutral-600 w-10 h-10 rounded-full flex items-center justify-center text-white">
                            <p>{{ strtoupper(substr(auth()->user()->pegawai->nama,0,1)) }}</p>
                        </div>
                        @endif
                </div>
                     
                   <div
                    x-cloak
                    x-show="show"
                   class="absolute border-main-dark-primary border-1 right-2 top-14 bg-white w-72 px-6 py-10 rounded-lg">
                   
                   @if(auth()->user()->profile_pic)
                        <img class="w-20 rounded-full mx-auto" src="/asset/example.webp" /><img src="" alt="">
                   @else
                        <div class="bg-neutral-600 w-20 h-20 rounded-full flex items-center justify-center text-white mx-auto text-2xl">
                            <p>{{ strtoupper(substr(auth()->user()->pegawai->nama,0,1)) }}</p>
                        </div>
                    @endif

                    <p class="text-center mt-4 text-lg font-semibold">{{ auth()->user()->pegawai->nama }}</p>

                    <p class="text-sm text-center mt-1">{{ auth()->user()->pegawai->jabatan }}</p>

                    
                    <a href="">
                        <button class="btn bg-main-light-primary w-full mt-4 text-white hover:bg-main-dark-primary duration-300   ">
                            My Profile
                            <x-heroicon-o-user class="w-6" />
                        </button>

                    </a>

                    {{-- close icone --}}

                    <x-heroicon-s-x-mark
                        @click="show = !show" 
                        class="absolute w-8 top-2 right-4 cursor-pointer" />

                   </div>
            </div>

        </div>
    </div>
