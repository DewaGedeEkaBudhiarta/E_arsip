<div class="container mx-auto">
    {{-- session for sucsses or error  --}}
    <div class="container mx-auto p-4">
        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <h1 class="text-3xl font-bold mb-4">Klasifikasi Arsip</h1>

        {{-- Debugging: Check if data is being passed --}}
        {{-- {{ dd($klasifikasiArsip) }} --}}
        {{-- only admin can acess --}}
        @if (Auth::user()->role == 'admin')
        <div class="flex justify-between mb-4">
            <a href="{{ route('informasi-arsip.index', ['action' => 'create']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Klasifikasi Arsip
            </a>
        </div>
        @endif

        <div class="flex items-center mb-4">
            <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Klasifikasi Arsip">
        </div>
        <table class="border-2 border-2-cyan-200 w-full text-sm text-left text-gray-500">
            <thead class="border border-solid border-l-0 text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Fungsi</th>
                    <th class="py-3 px-6">Primer</th>
                    <th class="py-3 px-6">Kegiatan</th>
                    <th class="py-3 px-6">Sekunder</th>
                    <th class="py-3 px-6">Transaksi</th>
                    <th class="py-3 px-6">Tersier</th>
                    <th class="py-3 px-6">Indeks</th>
                    {{-- only admin can see --}}
                    @if (Auth::user()->role == 'admin')
                    <th class="py-3 px-10">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($klasifikasiArsip as $arsip)
                <tr>
                    <td class="border-2 py-4 px-6">{{ $loop->iteration }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Fungsi ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Primer ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Kegiatan ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Sekunder ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Transaksi ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Tersier ?? '' }}</td>
                    <td class="border-2 py-3 px-6">{{ $arsip->Indeks ?? '' }}</td>
                    {{-- delete using Transaksi as unique identifier --}}
                    {{-- only admin can acess --}}
                    @if (Auth::user()->role == 'admin')
                    <td class="border-2 py-0.5 px-1">
                        <form action="{{ route('informasi-arsip.destroy', $arsip->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-0.5 px-1 rounded">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('informasi.edit', $arsip->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0.5 px-1 rounded">
                            Edit
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @include('pagination.index')
    </div>