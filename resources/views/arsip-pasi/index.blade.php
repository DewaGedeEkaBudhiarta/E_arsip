@extends('layouts.app')

@section('title', 'Arsip PASI')

@section('content')
<div class="p-4 sm:ml-64">
  @include('arsip-pasi.partials.table')
</div>

@endsection

@section('scripts')
<script> 
  //script dropdown filter
  const dropdowns = document.querySelectorAll('.relative.inline-block');
  dropdowns.forEach(dropdown => {
      const button = dropdown.querySelector('button');
      const dropdownMenu = dropdown.querySelector('ul');

      button.addEventListener('click', () => {
          dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', (event) => {
          if (!dropdown.contains(event.target)) {
              dropdownMenu.classList.add('hidden');
          }
      });
  });

  //script search
  // Function to filter the table based on the search input
  function filterTable() {
    // Get the search input value
    const searchInput = document.getElementById("search-input").value.toLowerCase();
    // Get all table rows
    const tableRows = document.querySelectorAll("tbody tr");
    // Loop through each row
    tableRows.forEach(row => {
      // Get the cells in the current row
      const cells = row.querySelectorAll("td");
      // Check if any cell contains the search term
      let matchFound = false;
      cells.forEach(cell => {
        if (cell.textContent.toLowerCase().includes(searchInput)) {
          matchFound = true;
        }
      });
      // Show the row if a match is found, otherwise hide it
      if (matchFound) {
        row.style.display = "table-row";
      } else {
        row.style.display = "none";
      }
    });
  }
  // Add an event listener to the search input
  document.getElementById("search-input").addEventListener("input", filterTable);
  // Filter the table initially when the page loads
  filterTable();

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