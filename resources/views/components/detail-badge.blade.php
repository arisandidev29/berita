@props(['text'])
@if ($text == 'draft')
    <p class="flex gap-4 bg-red-500 text-white w-max px-4 py-1 rounded-full text-lg text-neutral-300 ">
        {{ $text }}
        <x-heroicon-c-document-chart-bar class="w-5 text-inherit" />
    </p>
@elseif ($text == 'generated')
    <p class="flex gap-4 bg-blue-500 text-white w-max px-4 py-1 rounded-full text-lg text-neutral-300 ">
        {{ $text }}
        <x-ri-ai-generate-2 class="w-5 text-inherit" />
    </p>
@else
    <p class="flex gap-4 bg-main-primary text-white w-max px-4 py-1 rounded-full text-lg text-neutral-300 ">
        {{ $text }}
        <x-heroicon-s-globe-alt class="w-5 text-inherit" />
    </p>
@endif