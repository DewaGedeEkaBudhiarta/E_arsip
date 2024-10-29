<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Kinerja Bidang Pendidikan</h1>

    <div class="flex justify-between mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Bidang Pendidikan
        </button>
        <a href="#" class="text-blue-500 hover:underline">Home / Kinerja Bidang Pendidikan</a>
    </div>

    <div class="flex items-center mb-4">
        <div class="relative inline-block">
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded">
                Filter
                <i class="fas fa-caret-down"></i>
            </button>
            <ul class="absolute hidden text-gray-700 bg-white rounded shadow-md">
                <li class="px-4 py-2 hover:bg-gray-100">
                    <input type="radio" id="filter1" name="filter">
                    <label for="filter1">Arsip Terbuka</label>
                </li>
                <li class="px-4 py-2 hover:bg-gray-100">
                    <input type="radio" id="filter2" name="filter">
                    <label for="filter2">Arsip Tertutup</label>
                </li>
                <li class="px-4 py-2 hover:bg-gray-100">
                    <input type="radio" id="filter3" name="filter">
                    <label for="filter3">Arsip Rahasia</label>
                </li>
            </ul>
        </div>
        <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Bidang Pendidikan">
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
              <th class="py-3 px-10">Aksi</th>
          </tr>
      </thead>
      <tbody>
        {{-- Display uploaded files --}}
        @forelse ($files as $file)
          <tr class="bg-white border-b">
            <td class="py-4 px-6">{{ $file->kode_klasifikasi }}</td>
            <td class="py-4 px-6">{{ $file->no_berkas }}</td>
            <td class="py-4 px-6">{{ $file->file_name }}</td>
            <td class="py-4 px-6">{{ $file->kurun_waktu }}</td>
            <td class="py-4 px-6">{{ $file->indeks }}</td>
            <td class="py-4 px-6">{{ $file->keterangan }}</td>            
            <td class="py-0.5 px-1">
                @if (Auth::user()->role == 'admin')
                <!-- Section visible only to admin -->
                <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-0.5 px-1 rounded">
                    Edit
                </button>
                <form action="{{ route('delete', ['id' => $file->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-0.5 px-1 rounded">
                        Hapus
                    </button>
                </form>
                @endif
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-0.5 px-1 rounded">
                    <a href="{{ url('/download/' . $file->id) }}"> 
                    download 
                    </a>
                </button>
            </td>
          </tr>
          @empty
          <tr>
                <td class="py-4 px-6 text-center" colspan="7">No files found</td>
          </tr>
          @endforelse
      </tbody>      
  </table>
</div> 
