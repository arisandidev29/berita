@props([
    "showTiming" => 9000,
])
<div x-data="{ show: false, title : '',type  : 'success' }" x-show="show" x-cloak x-init="$watch('show', () => {
    setTimeout(() => {
        show = false
    }, {{ $showTiming }})
})" x-on:activate-toast.window='show = true; title = $event.detail.title; type : $event.detail.type' class="toast toast-top toast-end top-20 z-[200]" >
    <div {{ $attributes->merge(['class' => "alert alert-success text-white text-xl flex gap-1 items-center"]) }}>
        <span x-text="title"></span>
        {{ $slot }}
    </div>
</div>
