<div class="container mx-auto p-4"> 
  <form action="{{ route('informasi-arsip.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="fungsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fungsi</label>
            <input type="text" id="fungsi" name="fungsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="primer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primer</label>
            <input type="text" id="primer" name="primer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="kegiatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan</label>
            <input type="text" id="kegiatan" name="kegiatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="sekunder" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sekunder</label>
            <input type="text" id="sekunder" name="sekunder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaksi</label>
            <input type="text" id="transaksi" name="transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="tersier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tersier</label>
            <input type="text" id="tersier" name="tersier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div>
            <label for="indeks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indeks</label>
            <input type="text" id="indeks" name="indeks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Klasifikasi</button>
  </form>
</div>