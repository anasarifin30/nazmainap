<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Detail Kamar Tipe A</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-indigo-900">NAZMAINAP</h1>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="#" class="border-b-2 border-orange-500 text-orange-500 px-1 pt-1 text-sm font-medium">Beranda</a>
                        <a href="#" class="border-b-2 border-transparent text-gray-600 hover:text-gray-800 px-1 pt-1 text-sm font-medium">Tentang</a>
                        <a href="#" class="border-b-2 border-transparent text-gray-600 hover:text-gray-800 px-1 pt-1 text-sm font-medium">Bantuan</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <button class="p-1 rounded-full text-gray-600 hover:text-gray-800 focus:outline-none">
                            <span class="sr-only">User account</span>
                            <i class="fas fa-user-circle text-2xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="#" class="text-gray-500 hover:text-gray-700">Beranda</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <a href="#" class="ml-2 text-gray-500 hover:text-gray-700">Hacienda Watukarung</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 text-gray-900 font-medium">Tipe Kamar A</span>
                </li>
            </ol>
        </nav>

        <!-- Room Details -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Room Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                <div class="h-64 md:h-96 rounded-lg overflow-hidden">
                    <img src="/api/placeholder/800/600" alt="Kamar Tipe A - Main" class="w-full h-full object-cover">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-lg overflow-hidden">
                        <img src="/api/placeholder/400/300" alt="Kamar Tipe A - Bathroom" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="/api/placeholder/400/300" alt="Kamar Tipe A - View" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="/api/placeholder/400/300" alt="Kamar Tipe A - Desk" class="w-full h-full object-cover">
                    </div>
                    <div class="relative rounded-lg overflow-hidden">
                        <img src="/api/placeholder/400/300" alt="Kamar Tipe A - Additional" class="w-full h-full object-cover filter brightness-75">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md font-medium">+3 foto lainnya</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
                <!-- Room Details Left Column -->
                <div class="md:col-span-2">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Tipe Kamar A - Standard Room</h1>
                    <p class="text-gray-700 mb-6">
                        Kamar nyaman dengan pemandangan taman, cocok untuk pasangan atau solo traveler. Dilengkapi dengan berbagai fasilitas modern dan akses mudah ke area umum villa.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">Detail Kamar</h2>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Luas: 18 m²</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Kasur: Double Bed (160x200)</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Max Pengunjung: 2 orang</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Total Kamar: 5 unit</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-3">Fasilitas Kamar</h2>
                            <div class="grid grid-cols-2 gap-y-2 text-gray-700">
                                <div class="flex items-center">
                                    <i class="fas fa-snowflake text-orange-500 w-6"></i>
                                    <span>AC</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-wifi text-orange-500 w-6"></i>
                                    <span>WiFi Gratis</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-bath text-orange-500 w-6"></i>
                                    <span>Kamar Mandi</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-tv text-orange-500 w-6"></i>
                                    <span>TV LED 32"</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-table text-orange-500 w-6"></i>
                                    <span>Meja</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-tshirt text-orange-500 w-6"></i>
                                    <span>Lemari Baju</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-wind text-orange-500 w-6"></i>
                                    <span>Ventilasi</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-couch text-orange-500 w-6"></i>
                                    <span>Bantal & Guling</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Deskripsi Kamar</h2>
                    <p class="text-gray-700 mb-4">
                        Tipe Kamar A adalah pilihan ideal untuk pasangan atau solo traveler yang mencari kenyamanan dan kedamaian selama menginap di Hacienda Watukarung. Kamar ini menawarkan pemandangan taman yang asri dan suasana yang tenang.
                    </p>
                    <p class="text-gray-700 mb-6">
                        Dilengkapi dengan kasur double bed yang nyaman, AC, TV LED, dan kamar mandi dalam. Kamar ini juga dilengkapi dengan meja kerja yang cocok bagi Anda yang tetap perlu bekerja selama liburan.
                    </p>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Peraturan Kamar</h2>
                    <ul class="list-disc pl-5 text-gray-700 mb-6">
                        <li class="mb-2">Check-in: 14.00 WIB, Check-out: 12.00 WIB</li>
                        <li class="mb-2">Merokok tidak diperbolehkan di dalam kamar</li>
                        <li class="mb-2">Dilarang membawa hewan peliharaan</li>
                        <li class="mb-2">Maksimal penghuni 2 orang dewasa</li>
                        <li class="mb-2">Tamu diluar penghuni tidak diperbolehkan menginap</li>
                    </ul>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3">Lokasi</h2>
                    <div class="h-64 bg-gray-200 rounded-lg mb-6">
                        <!-- Placeholder for map -->
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-gray-500">Peta Lokasi</span>
                        </div>
                    </div>
                </div>

                <!-- Booking Section -->
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <div class="text-3xl font-bold text-gray-900 mb-2">Rp 200.000</div>
                    <div class="text-gray-500 mb-6">per malam</div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tanggal Masuk</label>
                        <div class="relative">
                            <input type="text" placeholder="dd-mm-yy" class="w-full p-2 border border-gray-300 rounded-md">
                            <i class="far fa-calendar absolute right-3 top-3 text-gray-500"></i>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tanggal Keluar</label>
                        <div class="relative">
                            <input type="text" placeholder="dd-mm-yy" class="w-full p-2 border border-gray-300 rounded-md">
                            <i class="far fa-calendar absolute right-3 top-3 text-gray-500"></i>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Jumlah Tamu</label>
                        <select class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="1">1 Tamu</option>
                            <option value="2" selected>2 Tamu</option>
                        </select>
                    </div>

                    <div class="border-t border-gray-200 pt-4 mb-4">
                        <div class="flex justify-between mb-2">
                            <span>Rp 200.000 x 2 malam</span>
                            <span>Rp 400.000</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Biaya layanan</span>
                            <span>Rp 40.000</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span>Rp 440.000</span>
                        </div>
                    </div>

                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-md font-medium mb-3">Pesan Sekarang</button>
                    <button class="w-full bg-indigo-900 hover:bg-indigo-800 text-white p-3 rounded-md font-medium">Hubungi Pemilik</button>

                    <div class="mt-6 text-center text-gray-500 text-sm">
                        <p>Anda tidak akan dikenakan biaya sekarang</p>
                    </div>
                </div>
            </div>

            <!-- Other Room Types -->
            <div class="p-6 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Tipe Kamar Lainnya di Hacienda Watukarung</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Room Type B -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                        <div class="h-48 overflow-hidden">
                            <img src="/api/placeholder/400/300" alt="Tipe Kamar B" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900">Tipe Kamar B</h3>
                            <p class="text-gray-600 text-sm mt-1 mb-3">Kamar luas dengan balkon pribadi dan akses mudah ke taman</p>
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-gray-600 text-sm">Max Pengunjung: <span class="font-semibold">3 orang</span></div>
                                <div class="text-gray-600 text-sm">Total Kamar: <span class="font-semibold">3</span></div>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-gray-900 font-bold">Rp200.000</div>
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Per malam</span>
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md font-medium text-sm">Lihat Detail</button>
                        </div>
                    </div>

                    <!-- Room Type C -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                        <div class="h-48 overflow-hidden">
                            <img src="/api/placeholder/400/300" alt="Tipe Kamar C" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900">Tipe Kamar C</h3>
                            <p class="text-gray-600 text-sm mt-1 mb-3">Kamar keluarga dengan area duduk dan pemandangan pantai</p>
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-gray-600 text-sm">Max Pengunjung: <span class="font-semibold">4 orang</span></div>
                                <div class="text-gray-600 text-sm">Total Kamar: <span class="font-semibold">2</span></div>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-gray-900 font-bold">Rp250.000</div>
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Per malam</span>
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md font-medium text-sm">Lihat Detail</button>
                        </div>
                    </div>

                    <!-- Room Type D -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
                        <div class="h-48 overflow-hidden">
                            <img src="/api/placeholder/400/300" alt="Tipe Kamar D" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900">Tipe Kamar D</h3>
                            <p class="text-gray-600 text-sm mt-1 mb-3">Suite room dengan jacuzzi pribadi dan pemandangan laut</p>
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-gray-600 text-sm">Max Pengunjung: <span class="font-semibold">2 orang</span></div>
                                <div class="text-gray-600 text-sm">Total Kamar: <span class="font-semibold">1</span></div>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div class="text-gray-900 font-bold">Rp350.000</div>
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">Per malam</span>
                            </div>
                            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-md font-medium text-sm">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Punya rumah kosong atau kamar tersedia?</h3>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md font-medium">Daftarkan sekarang</button>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Kontak Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-gray-300"><i class="far fa-envelope"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-indigo-800 mt-8 pt-8 text-center text-sm text-indigo-300">
                Copyright 2025 - Develop By NazMa Office
            </div>
        </div>
    </footer>
</body>
</html>