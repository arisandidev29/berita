@props(['text'])
@if ($text == 'draft')
    <p class="text-xs bg-red-500 text-white px-2 py-1 rounded-lg flex gap-1">
        {{ $text }}
        <x-heroicon-c-document-chart-bar class="w-3 text-inherit" />
    </p>
@elseif ($text == 'generated')
    <p class="text-xs bg-blue-500 text-white px-2 py-1 rounded-lg flex gap-1">
        {{ $text }}
        <x-ri-ai-generate-2 class="w-3 text-inherit" />
    </p>
@else
    <p class="text-xs bg-blue-500 text-white px-2 py-1 rounded-lg flex gap-1">
        {{ $text }}
        <x-heroicon-s-globe-alt class="w-3 text-inherit" />
    </p>
@endif
