<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
  @csrf
  {{-- Drag and drop file --}}
    <div class="flex items-center justify-center w-full">
      <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
          <div class="flex flex-col items-center justify-center pt-5 pb-6" id="dropzone-text">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> </p>
              <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX. 800x400px)</p>
          </div>
          <input id="dropzone-file" type="file" name="file" class="hidden" />
      </label>
    </div>

  {{-- input field --}}
    <div class="mb-4">
      <label for="kode_klasifikasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Klasifikasi (Transaksi):</label>
      <select id="kode_klasifikasi" name="kode_klasifikasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <option value="">Select Transaksi</option>
          @foreach($transaksiList as $transaksi)
              <option value="{{ $transaksi->Transaksi }}">{{ $transaksi->Transaksi }}</option>
          @endforeach
      </select>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
          <label for="no_berkas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Berkas</label>
          <input type="text" id="no_berkas" name="no_berkas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
      </div>
      <div>
          <label for="file_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama berkas</label>
          <input type="text" id="file_name" name="file_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
      </div>
      <div>
          <label for="kurun_waktu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kurun Waktu</label>
          <input type="text" id="kurun_waktu" name="kurun_waktu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite" required />
      </div>  
      <div class="mb-4">
        <label for="indeks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indeks (kata tangkap/Kata kunci)</label>
        <input type="text" id="indeks" name="indeks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678" readonly>
    </div>
    </div>
    {{-- Classification dropdown --}}
    <div>
      <label for="classification" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi</label>
      <select id="classification" name="classification" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <option value="terbuka">Terbuka</option>
          <option value="terbatas">Terbatas</option>
          <option value="tertutup">Tertutup</option>
      </select>
    </div>
    {{-- Kelas dropdown --}}
    <div>
      <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
      <select id="kelas" name="kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          <option value="umum">Umum</option>
          <option value="vital">Vital</option>
      </select>
    </div>
  {{-- text area --}}
  <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
  <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>

  {{-- Submit button --}}
  <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
</form>
