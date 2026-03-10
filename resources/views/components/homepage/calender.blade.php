
@props([
    "calenderData"
])
            <div class="card bg-base-100 shadow-xl p-6">
                <h2 class="card-title mb-4">Aktivitas Penulisan (30 Hari Terakhir)</h2>

                <!-- Grid Kalender -->
                <div class="grid grid-cols-7 gap-2">
                    @foreach ($calenderData as $item)
                        @php
                            // Tentukan warna berdasarkan jumlah berita
                            $colorClass = 'bg-base-200'; // Default kosong
                            if ($item['count'] > 0 && $item['count'] <= 2) {
                                $colorClass = 'bg-success/30 text-success-content';
                            }
                            if ($item['count'] > 2 && $item['count'] <= 5) {
                                $colorClass = 'bg-success/60 text-white';
                            }
                            if ($item['count'] > 5) {
                                $colorClass = 'bg-success text-white';
                            }
                        @endphp

                        <div class="tooltip" data-tip="{{ $item['date'] }}: {{ $item['count'] }} Berita">
                            <div
                                class="w-full aspect-square {{ $colorClass }} rounded-md flex items-center justify-center text-xs font-bold transition-all hover:scale-110 cursor-pointer">
                                {{ $item['day'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Keterangan Warna -->
                <div class="flex items-center gap-2 mt-6 text-xs opacity-70">
                    <span>Less</span>
                    <div class="w-3 h-3 bg-base-200 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success/30 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success/60 rounded-sm"></div>
                    <div class="w-3 h-3 bg-success rounded-sm"></div>
                    <span>More</span>
                </div>

            </div>