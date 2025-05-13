<x-app-admin></x-app-admin>
<x-sidebar-owner>
@section('isi')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Kelola Homestay</h2>
        <a href="#" class="btn bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded shadow-md dark:bg-blue-500 dark:hover:bg-blue-600">
            + Tambah Homestay
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg dark:bg-gray-800">
            <thead class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="text-left px-6 py-3">Nama</th>
                    <th class="text-left px-6 py-3">Alamat</th>
                    <th class="text-center px-6 py-3">Jumlah Kamar</th>
                    <th class="text-center px-6 py-3">Harga Termurah</th>
                    <th class="text-center px-6 py-3">Status</th>
                    <th class="text-center px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300">
                @foreach($homestays as $homestay)
                    <tr class="border-b hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $homestay->name }}</td>
                        <td class="px-6 py-4">{{ $homestay->address }}</td>
                        <td class="px-6 py-4 text-center">{{ $homestay->rooms_count ?? 0 }}</td>
                        <td class="px-6 py-4 text-center">Rp {{ number_format($homestay->min_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 rounded-full text-sm 
                                @if($homestay->status == 'terverifikasi') 
                                    bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100 
                                @elseif($homestay->status == 'ditolak') 
                                    bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100 
                                @elseif($homestay->status == 'menunggu') 
                                    bg-yellow-100 text-yellow-700 dark:bg-yellow-700 dark:text-yellow-100 
                                @else 
                                    bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-100 
                                @endif">
                                {{ ucfirst($homestay->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center flex justify-center space-x-2">
                            <a href="#" class="text-blue-600 hover:underline dark:text-blue-400">Detail</a>
                            <a href="#" class="text-yellow-500 hover:underline dark:text-yellow-400">Edit</a>
                            <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus homestay ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline dark:text-red-400">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($homestays->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center px-6 py-4 text-gray-400 dark:text-gray-500">Belum ada homestay</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
</x-sidebar-owner>