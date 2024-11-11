@extends('layouts.app')

@section('title', 'Uploud File')

@section('content')
<div class="p-4 md:ml-64">
  @include('uploud-file.partials.form-section')
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
</script>
@endsection