<link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.4/tailwind.min.css" rel="stylesheet">

<div class="p-4 border-4 border-gray-200 border-dashed rounded-lg flex items-between">
    <div class="grid gap-12 lg:grid-cols-4">
        <div class="bg-blue-300 p-6 rounded-lg flex flex-col gap-8 pt-6 font-bold">
            <div class="text-base text-black">Total Arsip</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900">{{ $totalArsip }}</div>
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart1"></canvas>
            </div>
        </div>
        <div class="bg-green-300 p-6 rounded-lg flex flex-col gap-8 pt-6 font-bold">
            <div class="text-base text-black">Arsip Aktif</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $arsipAktif }}</div>
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart2"></canvas>
            </div>
        </div>
        <div class="bg-yellow-300 p-6 rounded-lg flex flex-col gap-8 pt-6 font-bold">
            <div class="text-base text-text-black">Arsip Inaktif</div>
            <div class="relative z-10 flex items-center pt-1">
                <div class="text-2xl font-bold text-gray-900 ">{{ $arsipInaktif }}</div>
            </div>
            <div class="absolute bottom-0 inset-x-0 z-0">
                <canvas height="80" id="chart3"></canvas>
            </div>
        </div>
        <div class="bg-red-300 p-6 rounded-lg flex flex-col gap-8 pt-6 font-bold">
            <div class="text-base text-black">Usul Musnah</div>
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