@extends('layouts.app')

@section('title', 'Pemindahan Arsip')

@section('content')
<div class="p-4 sm:ml-64">
  @if ($partial === 'table-active')
    @include('pemindahan-arsip.partials.table-active', ['files' => $files])
  @elseif ($partial === 'table-inactive')
   @include('pemindahan-arsip.partials.table-inactive', ['files' => $files])
  @elseif ($partial === 'tabel-usul-musnah')
    @include('pemindahan-arsip.partials.tabel-usul-musnah', ['files' => $files])
  @endif
</div>

@endsection

@section('scripts')
<script>
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

    //pagination
  document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 10;
    const data = [...document.querySelectorAll('.file-row')]; // Use the 'file-row' class for pagination
    const totalItems = data.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    let currentPage = 1;

    document.getElementById('total-pages').textContent = totalPages;

    function showPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        data.forEach((item, index) => {
            item.style.display = (index >= start && index < end) ? 'table-row' : 'none';
        });

        document.getElementById('current-page').textContent = page;

        updatePagination(page);
    }

    function updatePagination(currentPage) {
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.className = 'relative inline-flex items-center px-4 py-2 border text-sm font-medium';
            pageLink.classList.add(i === currentPage ? 'font-bold' : 'text-gray-700');
            pageLink.textContent = i;
            pageLink.addEventListener('click', function(event) {
                event.preventDefault();
                showPage(i);
            });

            paginationContainer.appendChild(pageLink);
        }
    }

    document.getElementById('prev-page').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    document.getElementById('next-page').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    document.getElementById('prev-page-icon').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    document.getElementById('next-page-icon').addEventListener('click', function(event) {
        event.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Initial display
    showPage(1);
});
</script>
@endsection