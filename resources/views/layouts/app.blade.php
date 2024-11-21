<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])

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
  function toggleDropdown(event) {
    const dropdownMenu = event.currentTarget.nextElementSibling;
    dropdownMenu.classList.toggle('hidden');
  }
</script>