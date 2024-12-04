<div class="container mx-auto p-4">
    {{-- session for sucsses or error  --}}
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

  <table class="min-w-full bg-white">
    <thead>
      <tr>
        <th class="py-2">Name</th>
        <th class="py-2">Email</th>
        <th class="py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td class="border px-4 py-2">{{ $user->name }}</td>
          <td class="border px-4 py-2">{{ $user->email }}</td>
          <td class="border px-4 py-2">
            <select name="classification" class="classification-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" onchange="filterFiles(this, 'fileDropdown{{ $user->id }}')">
              <option value="terbatas">Terbatas</option>
              <option value="rahasia">Rahasia</option>
            </select>
            <select id="fileDropdown{{ $user->id }}" name="file_id" class="file-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
              @foreach ($files as $file)
                <option value="{{ $file->id }}" data-classification="{{ $file->classification }}">{{ $file->file_name }}</option>
              @endforeach
            </select>
            <form action="{{ route('users.givePermission', $user->id) }}" method="POST" style="display:inline;" onsubmit="updateHiddenInputs(this)">
              @csrf
              <input type="hidden" name="classification" value="terbatas">
              <input type="hidden" name="file_id" value="">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                Give Permission
              </button>
            </form>
            <form action="{{ route('users.removePermission', $user->id) }}" method="POST" style="display:inline;" onsubmit="updateHiddenInputs(this)">
              @csrf
              <input type="hidden" name="classification" value="terbatas">
              <input type="hidden" name="file_id" value="">
              <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
                Remove Permission
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>