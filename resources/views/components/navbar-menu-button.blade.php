@props([
    "route",
    "text" => "button" 
])
<a wire:navigate href="{{ route($route) }}">
    <button class="{{ request()->routeIs($route) ? "!bg-main-primary !text-white" : "" }} hidden md:block border-1 border-main-light-primary  px-4 py-2 rounded-sm text-main-light-primary hover:text-white  hover:bg-main-light-primary cursor-pointer hover:duration-300 transition-all duration-300">
        {{ $text }}
</button></a>