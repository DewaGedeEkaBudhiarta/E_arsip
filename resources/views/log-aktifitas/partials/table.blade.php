<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Activity Log</h2>
    <table class="min-w-full bg-white">
        <thead>
            <tr>
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
                    <td class="py-2 px-4 border-b">{{ $log->nomor_berkas }}</td>
                    <td class="py-2 px-4 border-b">{{ $log->nama_berkas }}</td>
                    <td class="py-2 px-4 border-b">{{ $log->user_pengakses }}</td>
                    <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($log->jam_ubah_create)->setTimezone('Asia/Singapore')->format('H:i:s') }}</td>
                    <td class="py-2 px-4 border-b">{{ $log->tanggal }}</td>
                    <td class="py-2 px-4 border-b">{{ $log->status }}</td>
                    <td class="py-2 px-4 border-b">{{ $log->action }}</td>
                    <td class="py-2 px-4 border-b">
                        @if (Auth::user()->role == 'admin') <!-- Check if the user is an admin -->
                            <form action="{{ route('activity.logs.delete', $log->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>