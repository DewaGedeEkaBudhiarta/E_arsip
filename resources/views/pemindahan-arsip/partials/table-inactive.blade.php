<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Daftar Arsip Inaktif</h1>

    <div class="flex justify-between mb-4">
        <a href="{{ route('pemindahan.export-inactive') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Export Inactive Files to Excel
        </a>
    </div>

    <div class="flex items-center mb-4">
        <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Arsip Inaktif">
    </div>
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th class="py-3 px-6">Kode Klasifikasi</th>
                <th class="py-3 px-6">No Berkas</th>
                <th class="py-3 px-6">Nama</th>
                <th class="py-3 px-9">Kurun Waktu</th>
                <th class="py-3 px-6">Indeks(Kata tangkap/Kata Kunci)</th>
                <th class="py-3 px-6">Keterangan</th>
                <th class="py-3 px-10">Klasifikasi</th>
                <th class="py-3 px-10">Kelas</th>
                <th class="py-3 px-10">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Display uploaded files --}}
            @forelse ($files as $file)
            <tr class="bg-white border-b">
                @if (Auth::user()->role == 'admin' ||
                (Auth::user()->role == 'user' && $file->classification == 'terbuka') ||
                (Auth::user()->role == 'user' && $file->user_id == Auth::id()) ||
                (Auth::user()->role == 'user' && DB::table('file_user')->where('file_id', $file->id)->where('user_id', Auth::id())->exists()))
                <td class="py-4 px-6">{{ $file->kode_klasifikasi }}</td>
                <td class="py-4 px-6">{{ $file->no_berkas }}</td>
                <td class="py-4 px-6">{{ $file->file_name }}</td>
                <td class="py-4 px-6">{{ $file->kurun_waktu }}</td>
                <td class="py-4 px-6">{{ $file->indeks }}</td>
                <td class="py-4 px-6">{{ $file->keterangan }}</td>
                <td class="py-4 px-6">{{ $file->classification }}</td>
                <td class="py-4 px-6">{{ $file->kelas }}</td>
                <td class="py-0.5 px-1">
                    <form action="{{ route('files.update-status', ['id' => $file->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-0.5 px-1 rounded">Set Aktif</button>
                    </form>
                    <form action="{{ route('files.update-status', ['id' => $file->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="status" value="usul_musnah">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-0.5 px-1 rounded">Usul Musnah</button>
                    </form>
                    <a href="{{ url('/download/' . $file->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0.5 px-1 rounded">
                        Download
                    </a>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="9" class="py-4 px-6 text-center">No inactive files found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>