<div {{ $attributes }} 
    class="fixed inset-0 max-h-screen grid place-content-center bg-[rgba(0,0,0,.8)]">
    <div class="w-2xl min-h-40 bg-white rounded-lg p-4">
        <div class="flex flex-col items-center ">
            {{ $slot }}
        </div>
    </div>
</div>
