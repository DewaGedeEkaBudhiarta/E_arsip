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

    // Confirm before deleting a file
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const confirmed = confirm('Are you sure you want to delete this file?');
                if (confirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection