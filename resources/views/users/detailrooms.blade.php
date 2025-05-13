<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/detailrooms.css'])
</head>
<!-- Header -->
<x-header></x-header>
<body class="bg-gray-50">
    <!-- Main Content -->
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-4">
        <!-- Left Column - Room Details -->
        <div class="w-full lg:w-8/12 px-4 mb-8">
            <!-- Room Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-2">Tipe Kamar A - Standard Room</h1>
                <p class="text-sm text-gray-600">
                    Kamar nyaman dengan pemandangan halaman, ukuran sedang, tempat tidur nyaman. Dilengkapi dengan shower.
                </p>
            </div>

            <!-- Room Gallery with Multiple Images -->
            <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
                <div class="room-gallery">
                    <img src="images/hacienda.jpg" alt="Tipe Kamar A" class="gallery-main-image rounded-lg">
                    <div class="gallery-thumbnails">
                        <img src="images/hacienda.jpg" alt="Tipe Kamar A - 1" class="gallery-thumbnail active">
                        <img src="images/hacienda.jpg" alt="Tipe Kamar A - 2" class="gallery-thumbnail">
                        <img src="images/hacienda.jpg" alt="Tipe Kamar A - 3" class="gallery-thumbnail">
                        <img src="images/hacienda.jpg" alt="Tipe Kamar A - 4" class="gallery-thumbnail">
                        <img src="images/hacienda.jpg" alt="Tipe Kamar A - 5" class="gallery-thumbnail">
                    </div>
                </div>
            </div>

            <!-- Detail Sections -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <!-- Detail Kamar -->
                <div class="detail-section mb-6">
                    <h3 class="text-lg font-bold flex items-center mb-4">
                        <span class="border-l-4 border-orange-500 pl-3">Detail Kamar</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <span>Tipe: A (Standard)</span>
                                </li>
                                <li class="flex items-center">
                                    <span>Ukuran: 24 m²</span>
                                </li>
                                <li class="flex items-center">
                                    <span>Kasur: 1 Queen Bed (160x200)</span>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <ul class="space-y-2">
                                <li class="flex items-center">
                                    <span>Check-in: 14:00</span>
                                </li>
                                <li class="flex items-center">
                                    <span>Check-out: 12:00</span>
                                </li>
                                <li class="flex items-center">
                                    <span>Max: 2 Tamu (Dewasa/Anak)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Kamar -->
                <div class="detail-section mb-6">
                    <h3 class="text-lg font-bold flex items-center mb-4">
                        <span class="border-l-4 border-orange-500 pl-3">Fasilitas Kamar</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span>Air Conditioning</span>
                            </li>
                            <li class="flex items-center">
                                <span>Smart TV</span>
                            </li>
                            <li class="flex items-center">
                                <span>Free WiFi</span>
                            </li>
                        </ul>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span>Water Kettle</span>
                            </li>
                            <li class="flex items-center">
                                <span>Coffee/Tea Set</span>
                            </li>
                            <li class="flex items-center">
                                <span>Mini Fridge</span>
                            </li>
                        </ul>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span>Bath Amenities</span>
                            </li>
                            <li class="flex items-center">
                                <span>In-room Safe</span>
                            </li>
                            <li class="flex items-center">
                                <span>Hairdryer</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Deskripsi Kamar -->
                <div class="detail-section mb-6">
                    <h3 class="text-lg font-bold flex items-center mb-4">
                        <span class="border-l-4 border-orange-500 pl-3">Deskripsi Kamar</span>
                    </h3>
                    <p class="text-gray-700 mb-4">
                        Nikmati pengalaman menginap di Standard Room kami yang nyaman. Kamar ini dilengkapi dengan berbagai fasilitas modern untuk menjamin kenyamanan Anda selama menginap.
                    </p>
                    <p class="text-gray-700">
                        Pemandangan halaman yang menyegarkan, tempat tidur Queen Size yang nyaman untuk beristirahat, dan kamar mandi dengan shower menjadikan kamar ini pilihan tepat untuk liburan Anda di Nusantara.
                    </p>
                    <p class="text-gray-700 mt-4">
                        Tersedia layanan kamar 24 jam, minibar dengan minuman gratis (diisi kembali setiap hari), dan <span class="text-blue-600">pembersihan kamar harian (upon request)</span>.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking Section -->
        <div class="w-full lg:w-4/12 px-4">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
                <h2 class="text-xl font-bold mb-4">Rp 200.000</h2>
                <p class="text-sm text-gray-600 mb-4">*Harga untuk 1 kamar per malam</p>

                <!-- Booking Form -->
                <form>
                    <div class="mb-4">
                        <label for="check-in" class="block text-sm font-medium text-gray-700 mb-1">Check-in</label>
                        <input type="date" id="check-in" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="check-out" class="block text-sm font-medium text-gray-700 mb-1">Check-out</label>
                        <input type="date" id="check-out" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tamu</label>
                        <select id="guests" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="1">1 Tamu</option>
                            <option value="2">2 Tamu</option>
                        </select>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t border-gray-200 pt-4 mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Rp 200.000 x 1 malam</span>
                            <span class="text-gray-700">Rp 200.000</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Pajak & Biaya</span>
                            <span class="text-gray-700">Rp 20.000</span>
                        </div>
                        <div class="flex justify-between border-t border-gray-200 pt-2 mt-2">
                            <span class="font-bold">Total</span>
                            <span class="font-bold">Rp 220.000</span>
                        </div>
                    </div>

                    <!-- Booking Buttons -->
                    <button type="button" class="w-full py-3 book-button text-white font-medium rounded-md mb-3">
                        Pesan Sekarang
                    </button>
                    <button type="button" class="w-full py-3 chat-button text-white font-medium rounded-md">
                        Hubungi Pemilik
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Related Rooms -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Tipe Kamar Lainnya di Nusantara Wanderlung</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Room Card 1 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden room-preview-card">
                <img src="images/hacienda.jpg" alt="Tipe Kamar B" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Tipe Kamar B</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar lebih luas dengan pemandangan kebun yang indah.</p>
                    <p class="text-sm text-gray-500 mb-3">Max Pengunjung: 2 orang</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">Rp 250.000</span>
                        <button class="px-4 py-2 bg-orange-500 text-white rounded-md">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Room Card 2 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden room-preview-card">
                <img src="https://via.placeholder.com/400x250" alt="Tipe Kamar C" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Tipe Kamar C</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar deluxe dengan fasilitas premium dan jacuzzi.</p>
                    <p class="text-sm text-gray-500 mb-3">Max Pengunjung: 3 orang</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">Rp 350.000</span>
                        <button class="px-4 py-2 bg-orange-500 text-white rounded-md">Detail</button>
                    </div>
                </div>
            </div>

            <!-- Room Card 3 -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden room-preview-card">
                <img src="https://via.placeholder.com/400x250" alt="Tipe Suite A" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold mb-2">Tipe Suite A</h3>
                    <p class="text-sm text-gray-600 mb-3">Suite mewah dengan ruang tamu terpisah dan pemandangan kota.</p>
                    <p class="text-sm text-gray-500 mb-3">Max Pengunjung: 4 orang</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold">Rp 450.000</span>
                        <button class="px-4 py-2 bg-orange-500 text-white rounded-md">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>