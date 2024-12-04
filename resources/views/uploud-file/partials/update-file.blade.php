@extends('layouts.app')

@section('title', 'Update File')

@section('content')
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
    
<div class="p-4 md:ml-64">
    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto">
        @csrf
        @method('POST')
        {{-- Drag and drop file --}}
          <div class="flex items-center justify-center w-full">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="dropzone-text">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX. 800x400px)</p>
                    @if(isset($file->file_name_with_extension))
                        <p class="text-xs text-gray-500 dark:text-gray-400">Current file: {{ $file->file_name_with_extension }}</p>
                    @endif
                </div>
                <input id="dropzone-file" type="file" name="file" class="hidden">
            </label>
          </div>
      
        {{-- input field --}}
          <div class="mb-4">
            <label for="kode_klasifikasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Klasifikasi (Transaksi):</label>
            <select id="kode_klasifikasi" name="kode_klasifikasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="">Select Transaksi</option>
                @foreach($transaksiList as $transaksi)
                  <option value="{{ $transaksi->Transaksi }}" {{ (old('kode_klasifikasi', $file->kode_klasifikasi ?? '') == $transaksi->Transaksi) ? 'selected' : '' }}>{{ $transaksi->Transaksi }}</option>
                @endforeach
            </select>
          </div>
      
          <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="no_berkas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Berkas</label>
                <input type="text" id="no_berkas" name="no_berkas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="No Berkas" value="{{ old('no_berkas', $file->no_berkas ?? '') }}" required />
            </div>
            <div>
                <label for="file_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Berkas</label>
                <input type="text" id="file_name" name="file_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Berkas" value="{{ old('file_name', $file->file_name ?? '') }}" required />
            </div>
            <div>
                <label for="kurun_waktu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kurun Waktu</label>
                <input type="text" id="kurun_waktu" name="kurun_waktu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Kurun Waktu" value="{{ old('kurun_waktu', $file->kurun_waktu ?? '') }}" required />
            </div>
            <div>
                <label for="indeks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indeks</label>
                <input type="text" id="indeks" name="indeks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Indeks" value="{{ old('indeks', $file->indeks ?? '') }}" readonly />
            </div>
            <div>
                <label for="classification" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Klasifikasi</label>
                <select id="classification" name="classification" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="terbuka" {{ (old('classification', $file->classification ?? '') == 'terbuka') ? 'selected' : '' }}>Terbuka</option>
                    <option value="terbatas" {{ (old('classification', $file->classification ?? '') == 'terbatas') ? 'selected' : '' }}>Terbatas</option>
                    <option value="rahasia" {{ (old('classification', $file->classification ?? '') == 'rahasia') ? 'selected' : '' }}>Rahasia</option>
                </select>
            </div>
            <div>
                <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                <select id="kelas" name="kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="umum" {{ (old('kelas', $file->kelas ?? '') == 'umum') ? 'selected' : '' }}>Umum</option>
                    <option value="vital" {{ (old('kelas', $file->kelas ?? '') == 'vital') ? 'selected' : '' }}>Vital</option>
                </select>
            </div>
          </div>
      
          <div>
              <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
              <textarea id="keterangan" name="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment...">{{ old('keterangan', $file->keterangan ?? '') }}</textarea>
          </div>
      
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Update
          </button>
      </form>
</div>
@endsection
      
@section('scripts')
<script>
    // calling the transaksi and indeksField from klasifikasiArsip
    document.getElementById('kode_klasifikasi').addEventListener('change', function() {
        var transaksi = this.value;
        var indeksField = document.getElementById('indeks');
        var klasifikasiArsip = @json($klasifikasiArsip);
  
        var selected = klasifikasiArsip.find(item => item.Transaksi === transaksi);
        if (selected && selected.Indeks) {
            indeksField.value = selected.Indeks;
        } else {
            indeksField.value = '';
        }
    });
  
    // change the word in the dropzone-file
    document.getElementById('dropzone-file').addEventListener('change', function() {
          var fileName = this.files[0].name;
          var dropzoneText = document.getElementById('dropzone-text');
          dropzoneText.innerHTML = '<p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">File ready to upload:</span> ' + fileName + '</p>';
      });
  
      // auto select the indeks field based on the selected transaksi
      document.getElementById('kode_klasifikasi').addEventListener('change', function() {
          var transaksi = this.value;
          var indeksField = document.getElementById('indeks');
          var klasifikasiArsip = @json($klasifikasiArsip);
  
          var selected = klasifikasiArsip.find(item => item.Transaksi === transaksi);
          if (selected && selected.Indeks) {
              indeksField.value = selected.Indeks;
          } else {
              indeksField.value = '';
          }
      });
  
      // Set initial values for indeks field based on the existing kode_klasifikasi
      window.onload = function() {
          var transaksi = document.getElementById('kode_klasifikasi').value;
          var indeksField = document.getElementById('indeks');
          var klasifikasiArsip = @json($klasifikasiArsip);
  
          var selected = klasifikasiArsip.find(item => item.Transaksi === transaksi);
          if (selected && selected.Indeks) {
              indeksField.value = selected.Indeks;
          } else {
              indeksField.value = '';
          }
      };

        // Hide success and error messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    let successMessage = document.querySelector('.bg-green-500');
                    let errorMessage = document.querySelector('.bg-red-500');
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                }, 5000); // 5000 milliseconds = 5 seconds
            });
  </script>
@endsection