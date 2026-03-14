<div class="navbar bg-base-100 shadow-sm flex justify-between drawer">

    <div class="drawer z-50  ">
        <input id="navbar" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex  gap-2 items-center">
            <div class="block md:hidden">
                <label for="navbar" class="drawer-button cursor-pointer ">
                    <x-heroicon-o-bars-3 class="w-8 bg-slate-100 p-0.5 rounded-lg " />
                </label>
            </div>
            <a class="btn btn-ghost text-xl">daisyUI</a>
        </div>
        <div class="drawer-side">
            <label for="navbar" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-main-primary min-h-full w-80 p-4 flex flex-col gap-4">
                <!-- Sidebar content here -->
                <li class="{{ request()->routeIs("pegawai.homepage") ? "text-main-primary! bg-white" : '' }} text-white text-xl rounded-xl font-semibold ">
                    <a wire:navigate href="{{ route("pegawai.homepage") }}" class="flex gap-2 items-center">
                        <x-heroicon-o-home class="w-5" />
                        Home
                    </a>
                </li>

                <li class="{{ request()->routeIs("pegawai.draft") ? "text-main-primary! bg-white" : '' }} text-white text-xl rounded-xl font-semibold ">
                    <a wire:navigate href="{{ route("pegawai.draft") }}" class="flex gap-2 items-center">
                        <x-ri-draft-line class="w-5" /> 
                        Draft
                    </a>
                </li>

                <li class="{{ request()->routeIs("pegawai.berita") ? "text-main-primary! bg-white" : '' }} text-white text-xl rounded-xl font-semibold ">
                    <a wire:navigate href="{{ route("pegawai.berita") }}" class="flex gap-2 items-center">
                        <x-heroicon-o-newspaper class="w-5"/> 
                        Berita
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="flex gap-4 items-center">

        <x-navbar-menu-button route="pegawai.homepage" text="Home"  >
            <x-heroicon-o-home class="w-5" />
        </x-navbar-menu-button>

        <x-navbar-menu-button route="pegawai.draft" text="Draft" >
            <x-ri-draft-line class="w-5" /> 
        </x-navbar-menu-button>

        <x-navbar-menu-button route="pegawai.berita" text="Berita" >
            <x-heroicon-o-newspaper class="w-5"/> </x-navbar-menu-button>

        <a wire:navigate href="{{ route('create.draft') }}"><button class="btn bg-main-primary text-white ">Buat  Berita</button></a>

        {{-- profile --}}
        <div x-data="{ show: false }" class="relative ">

            <div @click="show = !show" class=" tooltip tooltip-left cursor-pointer " data-tip="Profile">
                @if (auth()->user()->profile_pic)
                    <img class="w-10 rounded-full  " src="/asset/example.webp" /><img src="" alt="" ">
@else
<div class="bg-neutral-600 w-10 h-10 rounded-full flex items-center justify-center text-white">
                            <p>{{ strtoupper(substr(auth()->user()->pegawai->nama, 0, 1)) }}</p>
                        </div>
 @endif
            </div>

            <div x-cloak x-show="show"
                class="absolute border-main-dark-primary border-1 right-2 top-14 bg-white w-72 px-6 py-10 rounded-lg z-50">

                @if (auth()->user()->profile_pic)
                    <img class="w-20 rounded-full mx-auto" src="/asset/example.webp" /><img src=""
                        alt="">
                @else
                    <div
                        class="bg-neutral-600 w-20 h-20 rounded-full flex items-center justify-center text-white mx-auto text-2xl">
                        <p>{{ strtoupper(substr(auth()->user()->pegawai->nama, 0, 1)) }}</p>
                    </div>
                @endif

                <p class="text-center mt-4 text-lg font-semibold">{{ auth()->user()->pegawai->nama }}</p>

                <p class="text-sm text-center mt-1">{{ auth()->user()->pegawai->jabatan }}</p>


                <a href="">
                    <button
                        class="btn bg-main-light-primary w-full mt-4 text-white hover:bg-main-dark-primary duration-300   ">
                        My Profile
                        <x-heroicon-o-user class="w-6" />
                    </button>

                </a>

                {{-- close icone --}}

                <x-heroicon-s-x-mark @click="show = !show" class="absolute w-8 top-2 right-4 cursor-pointer" />

            </div>
        </div>

    </div>
</div>
