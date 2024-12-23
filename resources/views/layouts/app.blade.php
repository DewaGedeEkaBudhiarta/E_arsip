<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  {{-- @vite ndak kepanggil klo share localhost pake ngrok --}}
  {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@0.3.1/dist/tailwind-ui.min.css">
  <style>
    .dropdown-menu {
      display: none;
    }

    .dropdown-menu.hidden {
      display: none;
    }
  </style>
</head>

<body>
  @php
    $currentUser = Auth::user();
  @endphp
  
  @include('partials.sidebar', ['currentUser' => $currentUser])

  @yield('content')

  @yield('scripts')

</body>

</html>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const dropdownButton = document.getElementById('dropdownDefaultButton');
      const dropdownMenu = document.getElementById('dropdown');

      dropdownButton.addEventListener('click', function() {
          dropdownMenu.classList.toggle('hidden');
      });

      // Close the dropdown if clicked outside
      document.addEventListener('click', function(event) {
          if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
              dropdownMenu.classList.add('hidden');
          }
      });
  });
</script>