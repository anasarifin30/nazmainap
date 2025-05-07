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
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-semibold rounded-lg 
                        @if($homestay->status == 'pending') 
                            bg-yellow-100 text-yellow-800 
                        @elseif($homestay->status == 'verified') 
                            bg-green-100 text-green-800 
                        @elseif($homestay->status == 'rejected') 
                            bg-red-100 text-red-800 
                        @endif">
                        {{ ucfirst($homestay->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 flex space-x-2">
                    <a href="{{ route('homestays.show', $homestay->id) }}" class="text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z"/><path fill="currentColor" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"/></svg>
                    </a>
                    <button class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300" data-modal-target="editHomestayModal-{{ $homestay->id }}" data-modal-toggle="editHomestayModal-{{ $homestay->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3"/></g></svg>
                    </button>
                    <form action="{{ route('homestays.destroy', $homestay->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg></button>
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
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editHomestayModal-{{ $homestay->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
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


<script>
    document.getElementById('table-search').addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr'); // Corrected selector

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            if (rowText.includes(searchValue)) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });
    });
</script>