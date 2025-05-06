<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacienda Watukarung - NAZMAINAP</title>
    <!-- Include Tailwind CSS from CDN for preview purposes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Include custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <x-header></x-header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <!-- Image Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="md:col-span-2 h-48 md:h-64 overflow-hidden rounded-lg">
                <img src="https://images.unsplash.com/photo-1615571022219-eb45cf7faa9d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                     alt="Main Villa Image" 
                     class="w-full h-full object-cover">
            </div>
            <div class="grid grid-rows-2 gap-4">
                <div class="overflow-hidden rounded-lg h-48">
                    <img src="https://images.unsplash.com/photo-1590523741831-ab7e8b8f9c7f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" 
                         alt="Hammock Detail" 
                         class="w-full h-full object-cover">
                </div>
                <div class="relative overflow-hidden rounded-lg h-48">
                    <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                         alt="Pool Image" 
                         class="w-full h-full object-cover brightness-75">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                            Lihat semua foto
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column - Property Details -->
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Hacienda Watukarung</h1>
                
                <p class="text-gray-700 mb-6">
                    Hacienda Villa Watukarung menyediakan akomodasi dengan taman di Watukarung. Properti ini menyediakan tempat parkir pribadi gratis, serta berjarak 3 menit jalan kaki dari Pantai Watu Karung dan 2,3 km dari Pantai Kasap.
                </p>

                <!-- Address -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Alamat</h2>
                    <p class="text-gray-700">
                        Ketro, Watukarung, Kec. Pringkuku, Kabupaten Pacitan, Jawa Timur 63552, Watukarung 63552
                    </p>
                </div>

                <!-- Contact -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">No HP</h2>
                    <p class="text-gray-700">081687906467</p>
                </div>

                <!-- BUMDES -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Kode Bumdes</h2>
                    <p class="text-gray-700">BUMDES1</p>
                </div>

                <!-- Room Facilities -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Fasilitas Kamar</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-snowflake text-gray-500 mr-2"></i>
                            <span>AC</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bed text-gray-500 mr-2"></i>
                            <span>Kasur</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-table text-gray-500 mr-2"></i>
                            <span>Meja</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tshirt text-gray-500 mr-2"></i>
                            <span>Lemari Baju</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-fan text-gray-500 mr-2"></i>
                            <span>Ventilasi</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bed text-gray-500 mr-2"></i>
                            <span>Bantal</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-blanket text-gray-500 mr-2"></i>
                            <span>Guling</span>
                        </div>
                    </div>
                </div>

                <!-- Rules -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Peraturan</h2>
                    <ol class="list-decimal pl-5 space-y-3 text-gray-700">
                        <li>Seluruh fasilitas penginapan, hanya diperuntukkan bagi penyewa bukan untuk umum</li>
                        <li>Penyewa penginapan dilarang menerima tamu dan/atau membawa teman ke kamar. Sebaiknya menerima tamu atau teman di tempat terbka atau tempat umum lainnya, seperti cafe/resto</li>
                        <li>Penyewa dilarang membawa tamu atau teman lawan jenis</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Room Types Section -->
        <section class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tipe Kamar</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Room Type A -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                         alt="Room Type A" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1">Tipe Kamar A</h3>
                        <p class="text-gray-500 text-sm mb-2">Pacitan</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span>9x9 Kamar • Terverifikasi</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">Rp200.000</p>
                            <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-1 px-3 rounded transition duration-300">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Room Type B -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                         alt="Room Type B" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1">Tipe Kamar B</h3>
                        <p class="text-gray-500 text-sm mb-2">Pacitan</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span>9x9 Kamar • Terverifikasi</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="font-bold text-gray-900">Rp200.000</p>
                            <button class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-1 px-3 rounded transition duration-300">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>