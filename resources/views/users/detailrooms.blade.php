<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->name }} - Detail Room</title>
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
                    <h1 class="text-2xl font-bold mb-2">{{ $room->name }}</h1>
                    <p class="text-sm text-gray-600">
                        {{ $room->description }}
                    </p>
                </div>

                <!-- Room Gallery with Multiple Images -->
                <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
                    <div class="room-gallery">
                        <!-- Foto Utama -->
                        @if ($room->photos->isNotEmpty())
                            <img src="{{ asset('storage/images-room/' . $room->photos->first()->photo_path) }}" alt="{{ $room->name }}" class="gallery-main-image rounded-lg">
                        @else
                            <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Default Room" class="gallery-main-image rounded-lg">
                        @endif

                        <!-- Thumbnail Images -->
                        <div class="gallery-thumbnails">
                            @foreach ($room->photos as $photo)
                                <img src="{{ asset('storage/images-room/' . $photo->photo_path) }}" alt="{{ $room->name }}" class="gallery-thumbnail">
                            @endforeach
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
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <span>Check-in: {{ $room->check_in_time }}</span>
                                    </li>
                                </ul>
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <span>Check-out: {{ $room->check_out_time }}</span>
                                    </li>
                                </ul>
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <span>Max: {{ $room->max_guests }} Tamu</span>
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
                            @foreach ($room->facilities as $facility)
                                <ul class="space-y-2">
                                    <li class="flex items-center">
                                        <span>{{ $facility->name }}</span>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>

                    <!-- Deskripsi Kamar -->
                    <div class="detail-section mb-6">
                        <h3 class="text-lg font-bold flex items-center mb-4">
                            <span class="border-l-4 border-orange-500 pl-3">Deskripsi Kamar</span>
                        </h3>
                        <p class="text-gray-700 mb-4">
                            {{ $room->description }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Booking Section -->
            <div class="w-full lg:w-4/12 px-4">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
                    <h2 class="text-xl font-bold mb-4">Rp {{ number_format($room->price, 0, ',', '.') }}</h2>
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
                                @for ($i = 1; $i <= $room->max_guests; $i++)
                                    <option value="{{ $i }}">{{ $i }} Tamu</option>
                                @endfor
                            </select>
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
        <h2 class="text-2xl font-bold mb-6">Tipe Kamar Lainnya di {{ $room->homestay->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($relatedRooms as $relatedRoom)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden room-preview-card">
                    <!-- Foto Utama -->
                    @if ($relatedRoom->photos->isNotEmpty())
                        <img src="{{ asset('storage/images-room/' . $relatedRoom->photos->first()->photo_path) }}" alt="{{ $relatedRoom->name }}" class="w-full h-48 object-cover">
                    @else
                        <img src="{{ asset('storage/images-room/default-room.jpg') }}" alt="Default Room" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="font-bold mb-2">{{ $relatedRoom->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $relatedRoom->description }}</p>
                        <p class="text-sm text-gray-500 mb-3">Max Pengunjung: {{ $relatedRoom->max_guests }} orang</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="font-bold">Rp {{ number_format($relatedRoom->price, 0, ',', '.') }}</span>
                            <a href="{{ route('rooms.show', $relatedRoom->id) }}" class="px-4 py-2 bg-orange-500 text-white rounded-md">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Tidak ada kamar lain yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
<x-footer></x-footer>
</body>
</html>