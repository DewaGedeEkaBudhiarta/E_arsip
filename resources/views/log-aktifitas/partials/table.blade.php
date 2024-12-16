<div class="container mx-auto p-4">
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

        <h2 class="text-2xl font-bold mb-4">Log Aktivitas</h2>
        <table class="border-2 border-2-cyan-200 min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-3 px-6">No</th>
                    <th class="py-2 px-4 border-b">Nomor Berkas</th>
                    <th class="py-2 px-4 border-b">Nama Berkas</th>
                    <th class="py-2 px-4 border-b">User Pengakses</th>
                    <th class="py-2 px-4 border-b">Jam Ubah/Create</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Action</th>
                    @if (Auth::user()->role == 'admin') <!-- Check if the user is an admin -->
                    <th class="py-2 px-4 border-b">Delete</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($activityLogs as $log)
                <tr>
                    <td class="border-2 py-4 px-6">{{ $loop->iteration }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->nomor_berkas }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->nama_berkas }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->user_pengakses }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ \Carbon\Carbon::parse($log->jam_ubah_create)->setTimezone('Asia/Singapore')->format('H:i:s') }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->tanggal }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->status }}</td>
                    <td class="border-2 py-2 px-4 border-b">{{ $log->action }}</td>
                    <!-- Check if the user is an admin -->
                    @if (Auth::user()->role == 'admin')
                    <td class="border-2 py-2 px-4 border-b">
                        <form action="{{ route('activity.logs.delete', $log->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>