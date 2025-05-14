<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacienda Watukarung - Detail Homestay</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/detailhomestay.css'])
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <x-header></x-header>

    <!-- Main content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Main image and gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Main Image -->
            <div class="md:col-span-2 h-80 bg-gray-300 rounded-lg overflow-hidden">
                <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Hacienda Watukarung" class="w-full h-full object-cover">
            </div>

            <!-- Side Images -->
            <div class="grid grid-rows-2 gap-4">
                <!-- Image 1 -->
                <div class="bg-gray-300 rounded-lg overflow-hidden h-40">
                    <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Hammock" class="w-full h-full object-cover">
                </div>

                <!-- Image 2 with Overlay -->
                <div class="bg-gray-300 rounded-lg overflow-hidden h-40 relative">
                    <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Default Room" class="w-full h-48 object-cover">
                    <div class="absolute bottom-0 right-0 bg-orange-500 text-white px-3 py-1 m-2 rounded text-sm">
                        <a href="{{ route('homestays.photos', $homestay->id) }}" class="hover:underline">Lihat semua foto</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main details and room types -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left side - Descriptions -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $homestay->name }}</h1>
                    <p class="text-gray-600 mb-4">
                        {{ $homestay->description }}
                    </p>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Alamat</h2>
                        <p class="text-gray-600">{{ $homestay->address }}, {{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}, {{ $homestay->provinsi }}</p>
                    </div>

                    <!-- Kode BUMDes -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Kode BUMDes</h2>
                        <p class="text-gray-600">{{ $homestay->kodebumdes }}</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Status</h2>
                        <p class="text-gray-600">{{ ucfirst($homestay->status) }}</p>
                    </div>

                    <!-- Peraturan Homestay -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Peraturan Homestay</h2>
                        <ul class="list-disc list-inside text-gray-600">
                            @foreach ($homestay->rules as $rule)
                                <li>{{ $rule->rule_text }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right side - Room types -->
            <div>
                <h2 class="text-lg font-bold mb-4">Tipe Kamar</h2>

                <!-- Room Type A -->
                @foreach ($homestay->rooms as $room)
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                    <!-- Foto Utama -->
                    @if ($room->photos->isNotEmpty())
                        <img src="{{ asset('storage/images-room/' . $room->photos->first()->photo_path) }}" alt="{{ $room->name }}" class="w-full h-48 object-cover">
                    @else
                        <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Default Room" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">{{ $room->name }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $room->description }}</p>
                        <p class="text-sm text-gray-500 mb-4">Max Pengunjung: {{ $room->max_guests }}</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                            <a href="{{ route('rooms.show', $room->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-md text-sm hover:bg-orange-600">Detail Rooms</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>
</body>

</html>