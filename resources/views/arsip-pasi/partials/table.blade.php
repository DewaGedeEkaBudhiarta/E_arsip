<div class="container mx-auto p-4">
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

        <h1 class="text-3xl font-bold mb-4">Daftar Arsip LLDikti</h1>

        <div class="flex justify-between mb-4">
            <a href="{{ route('upload.form') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Unggah Arsip
            </a>
            <a href="{{ route('arsip-pasi.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Export to Excel
            </a>
        </div>

        <div class="flex items-center mb-4">
            <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Cari Nama Arsip">
        </div>
        
        <table class="border-2 border-2-cyan-200 w-full text-sm text-left text-gray-500">
            <thead class="border border-solid border-l-0 text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="border-2 py-4 px-6">No</th>
                    <th class="border-2 py-4 px-6">Kode Klasifikasi</th>
                    <th class="border-2 py-4 px-6">No Berkas</th>
                    <th class="border-2 py-4 px-6">Nama</th>
                    <th class="border-2 py-4 px-6">Kurun Waktu</th>
                    <th class="border-2 py-4 px-6">Indeks(Kata tangkap/Kata Kunci)</th>
                    <th class="border-2 py-4 px-6">Keterangan</th>
                    <th class="border-2 py-4 px-6">Klasifikasi</th>
                    <th class="border-2 py-4 px-6">Kelas</th>
                    <th class="border-2 py-4 px-6">Lokasi Rak</th>
                    <th class="border-2 py-4 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Display uploaded files --}}
                @forelse ($files as $file)
                <tr class="bg-white border-b file-row">
                    @if (Auth::user()->role == 'admin' ||
                    (Auth::user()->role == 'user' && $file->classification == 'terbuka') ||
                    (Auth::user()->role == 'user' && $file->user_id == Auth::id()) ||
                    (Auth::user()->role == 'user' && DB::table('file_user')->where('file_id', $file->id)->where('user_id', Auth::id())->exists()))
                    <td class="border-2 py-4 px-6">{{ $loop->iteration }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->kode_klasifikasi }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->no_berkas }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->file_name }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->kurun_waktu }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->indeks }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->keterangan }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->classification }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->kelas }}</td>
                    <td class="border-2 py-4 px-6">{{ $file->lokasi_rak }}</td>
                    <td class="border-2 py-2 px-10">
                        <a href="{{ url('/download/' . $file->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-0.5 px-1 m-2 rounded">
                            Download
                        </a>
                        <form action="{{ route('delete', ['id' => $file->id]) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-0.5 px-1 m-2 rounded">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('files.edit', $file->id) }}" class="bg-green-700 hover:bg-blue-700 text-white font-bold py-0.5 px-1 m-2 rounded">
                            Edit
                        </a>
                    </td>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td class="py-4 px-6 text-center" colspan="7">No files found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- has some warning such as 'the link are not secure, and are you sure want to visit the link and are you sure want to insert data' and when i read the documentation it says it what will show if i dont use paid ngrok or i can change it manually, but i dont now how, --}}