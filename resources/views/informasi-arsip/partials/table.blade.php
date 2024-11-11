<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Klasifikasi Arsip</h1>

    {{-- Debugging: Check if data is being passed --}}
    {{-- {{ dd($klasifikasiArsip) }} --}}

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">Fungsi</th>
                <th class="py-3 px-6">Primer</th>
                <th class="py-3 px-6">Kegiatan</th>
                <th class="py-3 px-6">Sekunder</th>
                <th class="py-3 px-6">Transaksi</th>
                <th class="py-3 px-6">Tersier</th>
                <th class="py-3 px-6">Indeks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($klasifikasiArsip as $arsip)
                <tr>
                    <td class="py-3 px-6">{{ $arsip->fungsi ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->primer ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->kegiatan ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->sekunder ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->transaksi ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->tersier ?? '' }}</td>
                    <td class="py-3 px-6">{{ $arsip->indeks ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>