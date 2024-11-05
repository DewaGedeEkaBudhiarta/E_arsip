<div class="container mx-auto p-4">
  <h1 class="text-3xl font-bold mb-4">Kinerja Bidang Pendidikan</h1>  
  <div class="flex items-center mb-4">      
      <input type="text" id="search-input" class="ml-2 w-full pl-10 text-sm text-gray-700" placeholder="Cari Bidang Pendidikan">
  </div>
  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th class="py-3 px-6">Nama</th>
            <th class="py-3 px-6">Email</th>
            <th class="py-3 px-6">Action</th>                          
        </tr>
    </thead>
    <tbody>
      {{-- Display users in database --}}
      @forelse ($users as $user)
        <tr class="bg-white border-b">
          <td class="py-4 px-6">{{ $user->name }}</td>
          <td class="py-4 px-6">{{ $user->email }}</td>
          <td class="py-4 px-6">
              <form action="{{ route('users.givePermission', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <select name="file_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      @foreach ($files as $file)
                          @if ($file->classification == 'terbatas')
                              <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                          @endif
                      @endforeach
                  </select>
                  <input type="hidden" name="classification" value="terbatas">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                      Give Terbatas Permission
                  </button>
              </form>
              <form action="{{ route('users.removePermission', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <select name="file_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      @foreach ($files as $file)
                          @if ($file->classification == 'terbatas')
                              <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                          @endif
                      @endforeach
                  </select>
                  <input type="hidden" name="classification" value="terbatas">
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
                      Remove Terbatas Permission
                  </button>
              </form>
              <form action="{{ route('users.givePermission', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <select name="file_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      @foreach ($files as $file)
                          @if ($file->classification == 'rahasia')
                              <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                          @endif
                      @endforeach
                  </select>
                  <input type="hidden" name="classification" value="rahasia">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                      Give Rahasia Permission
                  </button>
              </form>
              <form action="{{ route('users.removePermission', $user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  <select name="file_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                      @foreach ($files as $file)
                          @if ($file->classification == 'rahasia')
                              <option value="{{ $file->id }}">{{ $file->file_name }}</option>
                          @endif
                      @endforeach
                  </select>
                  <input type="hidden" name="classification" value="rahasia">
                  <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2">
                      Remove Rahasia Permission
                  </button>
              </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="py-4 px-6 text-center">No users found</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>