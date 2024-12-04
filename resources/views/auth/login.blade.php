<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/inter-ui/3.13.1/inter.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/ui@0.3.1/dist/tailwind-ui.min.css">
<style>
  html {
  font-family: Inter var, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  line-height: 1.5;
  }

  input:invalid, textarea:invalid, select:invalid {
    box-shadow: none;
  }
</style>

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

<div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
      Sign in to your account
    </h2>    
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
            Email address
          </label>

          <div class="mt-1 rounded-md shadow-sm">
            <input id="email" name="email" type="email" required="" autofocus="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
          </div>

        </div>

        <div class="mt-6">
          <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
            Password
          </label>

          <div class="mt-1 rounded-md shadow-sm">
            <input id="password" type="password" name="password" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
          </div>

        </div>        

        <div class="mt-6">
          <span class="block w-full rounded-md shadow-sm">
            <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
              Sign in
            </button>
          </span>
        </div>
      </form>
    </div>
  </div>
</div>
@section('scripts')
<script>
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