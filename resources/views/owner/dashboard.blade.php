<x-app-admin></x-app-admin>
<x-sidebar-owner>
@section('isi')
<div class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Content -->
    <div class="flex-1 p-6 overflow-auto">
        <!-- Profil -->
        <div class="flex items-center mb-6">
            @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                     alt="Profile Picture" 
                     class="w-16 h-16 rounded-full mr-4">
            @else
                <div class="w-16 h-16 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500 dark:text-gray-300" viewBox="0 0 24 24">
                           <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                             <path d="M16 9a4 4 0 1 1-8 0a4 4 0 0 1 8 0m-2 0a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/>
                             <path d="M12 1C5.925 1 1 5.925 1 12s4.925 11 11 11s11-4.925 11-11S18.075 1 12 1M3 12c0 2.09.713 4.014 1.908 5.542A8.99 8.99 0 0 1 12.065 14a8.98 8.98 0 0 1 7.092 3.458A9 9 0 1 0 3 12m9 9a8.96 8.96 0 0 1-5.672-2.012A6.99 6.99 0 0 1 12.065 16a6.99 6.99 0 0 1 5.689 2.92A8.96 8.96 0 0 1 12 21"/>
                           </g>
                      </svg>
                </div>
            @endif
            <div class="ml-4">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Selamat Datang, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Statistik Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-gray-600 dark:text-gray-400">Jumlah Kamar</h2>
                <p class="text-2xl font-bold text-blue-500">3</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-gray-600 dark:text-gray-400">Pemesanan Aktif</h2>
                <p class="text-2xl font-bold text-green-500">5</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-gray-600 dark:text-gray-400">Pendapatan Bulan Ini</h2>
                <p class="text-2xl font-bold text-yellow-500">Rp 2.500.000</p>
            </div>
        </div>

        <!-- Tabel Pemesanan Terbaru -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Pemesanan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tamu</th>
                            <th scope="col" class="px-6 py-3">Homestay</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">Ahmad</td>
                            <td class="px-6 py-4">Sedan Homestay</td>
                            <td class="px-6 py-4">10 Mei 2025</td>
                            <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium">Disetujui</td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">Rina</td>
                            <td class="px-6 py-4">Nazma Inap 2</td>
                            <td class="px-6 py-4">12 Mei 2025</td>
                            <td class="px-6 py-4 text-yellow-600 dark:text-yellow-400 font-medium">Menunggu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endsection

</x-sidebar-owner>
