<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-4">log aktifitas</h1>

  <div class="flex items-center mb-4">        
      <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Bidang Pendidikan">
  </div>
  <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
              <th class="py-3 px-6">no</th>
              <th class="py-3 px-6">nama</th>
              <th class="py-3 px-6">nama berkas</th>
              <th class="py-3 px-6">hari</th>
              <th class="py-3 px-6">jam</th>              
          </tr>
      </thead>
      <tbody>
          @foreach($klasifikasiArsip as $arsip)
              <tr>
                  <td class="py-3 px-6">{{ $arsip->Fungsi ?? '' }}</td>
                  <td class="py-3 px-6">{{ $arsip->Primer ?? '' }}</td>
                  <td class="py-3 px-6">{{ $arsip->Kegiatan ?? '' }}</td>
                  <td class="py-3 px-6">{{ $arsip->Sekunder ?? '' }}</td>
                  <td class="py-3 px-6">{{ $arsip->Transaksi ?? '' }}</td>                  
              </tr>
          @endforeach
      </tbody>
  </table>
</div>