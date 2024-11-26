<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.4/tailwind.min.css" rel="stylesheet">

<div class="flex items-center">
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="relative p-5 pb-16 overflow-hidden bg-white rounded-md shadow-sm">
            <div class="text-base text-gray-400 ">Total Arsip</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $totalArsip }}</div>                
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart1"></canvas>
            </div>
        </div>
        <div class="relative p-5 pb-16 overflow-hidden bg-white rounded-md shadow-sm">
            <div class="text-base text-gray-400 ">Arsip Aktif</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $arsipAktif }}</div>                
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart2"></canvas>
            </div>
        </div>
        <div class="relative p-5 pb-16 overflow-hidden bg-white rounded-md shadow-sm">
            <div class="text-base text-gray-400 ">Arsip Inaktif</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $arsipInaktif }}</div>                
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart3"></canvas>
            </div>
        </div>
        <div class="relative p-5 pb-16 overflow-hidden bg-white rounded-md shadow-sm">
            <div class="text-base text-gray-400 ">Usul Musnah</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $usulMusnah }}</div>                
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart4"></canvas>
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="{{ asset('js/rekap.js') }}"></script>