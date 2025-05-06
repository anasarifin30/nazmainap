<x-app-admin></x-app-admin>
<x-sidebar>

@section('isi')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex flex-col items-center justify-center text-center mb-9">
        <h1 class="text-4xl font-semibold text-gray-900 dark:text-white">Daftar Homestay</h1>
        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Berikut adalah daftar homestay yang terdaftar di sistem Anda.</p>
    </div>
    <div class="flex flex-wrap items-center justify-between pb-4 space-y-4 sm:space-y-0">
        <button id="addHomestayModalToggle" data-modal-target="addHomestayModal" data-modal-toggle="addHomestayModal" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600">
            Tambah Homestay
        </button>
        <div class="relative">
            <label for="table-search" class="sr-only">Search</label>
            <input type="text" id="table-search" class="block w-80 p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari homestay">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Deskripsi</th>
                <th class="px-6 py-3">Alamat</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($homestays as $homestay)
            <tr class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <td class="px-6 py-4">{{ $homestay->name }}</td>
                <td class="px-6 py-4">{{ $homestay->description }}</td>
                <td class="px-6 py-4">{{ $homestay->address }}</td>
                <td class="px-6 py-4">{{ $homestay->status }}</td>
                <td class="px-6 py-4 flex space-x-2">
                    <button class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300" data-modal-target="editHomestayModal-{{ $homestay->id }}" data-modal-toggle="editHomestayModal-{{ $homestay->id }}">
                        Edit
                    </button>
                    <form action="{{ route('homestays.destroy', $homestay->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Edit Homestay -->
            <div id="editHomestayModal-{{ $homestay->id }}" tabindex="-1" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                        <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                            <h3 class="text-lg font-semibold dark:text-white">Edit Homestay</h3>
                            <button type="button" class="text-gray-400 dark:text-gray-300" data-modal-hide="editHomestayModal-{{ $homestay->id }}">X</button>
                        </div>
                        <form action="{{ route('homestays.update', $homestay->id) }}" method="POST" class="p-4">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 mb-4">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium dark:text-gray-300">Nama</label>
                                    <input type="text" name="name" id="name" value="{{ $homestay->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="description" class="block mb-2 text-sm font-medium dark:text-gray-300">Deskripsi</label>
                                    <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>{{ $homestay->description }}</textarea>
                                </div>
                                <div>
                                    <label for="address" class="block mb-2 text-sm font-medium dark:text-gray-300">Alamat</label>
                                    <input type="text" name="address" id="address" value="{{ $homestay->address }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="status" class="block mb-2 text-sm font-medium dark:text-gray-300">Status</label>
                                    <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                        <option value="pending" {{ $homestay->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="verified" {{ $homestay->status == 'verified' ? 'selected' : '' }}>Verified</option>
                                        <option value="rejected" {{ $homestay->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Homestay -->
<div id="addHomestayModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                <h3 class="text-lg font-semibold dark:text-white">Tambah Homestay</h3>
                <button type="button" class="text-gray-400 dark:text-gray-300" data-modal-hide="addHomestayModal">X</button>
            </div>
            <form action="{{ route('homestays.store') }}" method="POST" class="p-4">
                @csrf
                <div class="grid gap-4 mb-4">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium dark:text-gray-300">Nama</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium dark:text-gray-300">Deskripsi</label>
                        <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
                    </div>
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium dark:text-gray-300">Alamat</label>
                        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div>
                        <label for="kodebumdes" class="block mb-2 text-sm font-medium dark:text-gray-300">Kode Bumdes</label>
                        <input type="text" name="kodebumdes" id="kodebumdes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Opsional">
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium dark:text-gray-300">Status</label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Homestay</button>
            </form>
        </div>
    </div>
</div>
@endsection

</x-sidebar>
