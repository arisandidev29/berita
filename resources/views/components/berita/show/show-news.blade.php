@props([
    "news"
])

<div class="">
    @if ($news->newsDraf->image)
    <img src="{{ $news->newsDraf->image }}" alt="news image" class="w-full rounded-sm aspect-video object-cover">
    @else
    <div class="bg-slate-700 w-full aspect-video object-cover rounded-sm grid place-content-center">
        <p class="text-2xl text-white">No Image</p>
    </div>
    @endif
    <div class=" my-5 md:my-2 px-2">
        <h1 class="text-xl md:text-3xl font-bold my-2  ">{{ $news->title }}</h1>
        <div class="my-4 flex items-center gap-8">

            <span class="flex gap-2 items-center text-xs md:text-md">
                <x-heroicon-o-user class="w-4 md:w-6" />
                {{ auth()->user()->pegawai->nama }}
            </span>

            <span class="flex gap-2 items-center text-xs md:text-md">
                <x-heroicon-c-calendar-date-range class="w-4 md:w-6" />
                {{ $news->created_at }}

            </span>
        </div>
    </div>

    <div class="px-2 text-sm  prose lg:prose-xl">
        {!! $news->body !!}
    </div>
</div>