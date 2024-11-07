<div class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-4">Kinerja Bidang Pendidikan</h1>  
  <div class="flex items-center mb-4">      
      <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Bidang Pendidikan">
  </div>
  <table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2">Name</th>
            <th class="py-2">Email</th>
            <th class="py-2">Action</th>
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
                    <form action="{{ route('users.givePermission', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="classification" value="terbatas">
                        <input type="hidden" name="file_id" value="">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                            Give Permission
                        </button>
                    </form>
                    <form action="{{ route('users.removePermission', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="classification" value="terbatas">
                        <input type="hidden" name="file_id" value="">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
                            Remove Permission
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
</div>