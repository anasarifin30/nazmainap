<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $room->name }} - Detail Room</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/detailrooms.css'])
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<!-- Header -->
<x-header></x-header>
<body class="bg-gray-50">
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Alert Messages -->
        <x-alert />

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('homestays.show', $room->homestay_id) }}" class="back-button inline-flex items-center px-4 py-2 rounded-md text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali 
            </a>
        </div>
        
        <div class="flex flex-wrap -mx-4">
            <!-- Left Column - Room Details -->
            <div class="w-full lg:w-8/12 px-4 mb-8 static-column">
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
                    <!-- 
                     -->
                    <div class="detail-section mb-6">
                        <h3 class="text-lg font-bold flex items-center mb-4">
                            <span class="border-l-4 border-orange-500 pl-3">Detail Kamar</span>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2">
                                        <i class="bx bx-log-in-circle text-orange-500 text-xl"></i>
                                        <span>Check-in: 14:00</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="bx bx-log-out-circle text-orange-500 text-xl"></i>
                                        <span>Check-out: 12:00</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="bx bx-user text-orange-500 text-xl"></i>
                                        <span>Max: {{ $room->max_guests }} Tamu</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="bx bxl-whatsapp text-green-500 text-xl"></i>
                                        <span>
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $room->homestay->user->phone ?? '') }}" target="_blank" class="hover:underline">
                                                {{ $room->homestay->user->phone ?? '-' }}
                                            </a>
                                        </span>
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
                                    <li class="flex items-center gap-2">
                                        <i class="bx bx-check-circle text-orange-500 text-xl"></i>
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
                    <div class="mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Rp {{ number_format($room->price, 0, ',', '.') }}</h2>
                        <p class="text-sm text-gray-500">*Harga untuk 1 kamar per malam</p>
                    </div>

                    <!-- Booking Form -->
                    <form id="bookingForm" action="{{ route('rooms.book', $room->id) }}" method="POST">
                        @csrf
                        
                        <!-- Date Selection -->
                        <div class="mb-6">
                            @if($otherRoomsInCart)
                                <div class="bg-blue-50 p-4 rounded-lg mb-4">
                                    <div class="flex items-center gap-2">
                                        <i class="bx bx-info-circle text-blue-600"></i>
                                        <p class="text-sm text-blue-700">Tanggal menginap akan mengikuti pemesanan sebelumnya</p>
                                    </div>
                                </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4">
                                <div class="date-input">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="bx bx-calendar text-orange-500"></i> Check-in
                                    </label>
                                    @if($otherRoomsInCart || $existingDetail)
                                        <input type="date" 
                                               value="{{ $existingBooking->check_in }}" 
                                               class="date-picker bg-gray-50 w-full" 
                                               readonly>
                                        <input type="hidden" name="check_in" value="{{ $existingBooking->check_in }}">
                                    @else
                                        <input type="date" 
                                               id="check_in" 
                                               name="check_in" 
                                               class="date-picker w-full" 
                                               min="{{ date('Y-m-d') }}" 
                                               required>
                                    @endif
                                </div>
                                
                                <div class="date-input">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="bx bx-calendar text-orange-500"></i> Check-out
                                    </label>
                                    @if($otherRoomsInCart || $existingDetail)
                                        <input type="date" 
                                               value="{{ $existingBooking->check_out }}" 
                                               class="date-picker bg-gray-50 w-full" 
                                               readonly>
                                        <input type="hidden" name="check_out" value="{{ $existingBooking->check_out }}">
                                    @else
                                        <input type="date" 
                                               id="check_out" 
                                               name="check_out" 
                                               class="date-picker w-full" 
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                               required>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Existing Booking Warning -->
                        @if($existingDetail)
                            <div class="existing-booking-info bg-red-50 p-4 rounded-lg mb-6 border-l-4 border-red-500">
                                <div class="flex items-start gap-3">
                                    <div class="text-red-500">
                                        <i class="bx bx-info-circle text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-red-700 font-semibold mb-2">Kamar Ini Sudah Ada di Keranjang</h4>
                                        <div class="text-sm text-red-600 space-y-2">
                                            <div class="flex items-center gap-2">
                                                <i class="bx bx-calendar"></i>
                                                <span>{{ \Carbon\Carbon::parse($existingBooking->check_in)->format('d M Y') }} - 
                                                      {{ \Carbon\Carbon::parse($existingBooking->check_out)->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="bx bx-building-house"></i>
                                                <span>{{ $existingDetail->quantity }} Kamar</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Room Quantity -->
                        <div class="mb-6">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="bx bx-building-house text-orange-500"></i> Jumlah Kamar
                            </label>
                            <select id="quantity" name="quantity" class="quantity-select w-full{{ $existingDetail ? ' disabled' : '' }}" 
                                    {{ $existingDetail ? 'disabled' : '' }} required>
                                @for ($i = 1; $i <= min($room->total_rooms, 5); $i++)
                                    <option value="{{ $i }}" {{ ($existingDetail?->quantity ?? old('quantity', 1)) == $i ? 'selected' : '' }}>
                                        {{ $i }} Kamar
                                    </option>
                                @endfor
                            </select>
                            @if($room->total_rooms == 1)
                                <p class="text-sm text-gray-500 mt-1">*Hanya tersedia 1 kamar</p>
                            @endif
                        </div>

                        <!-- Price Summary -->
                        <div class="price-summary mb-6">
                            <div class="price-row">
                                <span>Total Malam</span>
                                <span id="totalNights">0 malam</span>
                            </div>
                            <div class="price-row">
                                <span>Total Kamar</span>
                                <span id="totalRooms">1 kamar</span>
                            </div>
                            <div class="price-row total">
                                <span>Total Harga</span>
                                <span id="totalPrice">Rp 0</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="booking-buttons">
                            @if(!$existingDetail)
                                <button type="submit" class="book-button" id="bookButton">
                                    <i class="bx bx-check-circle"></i>
                                    {{ $otherRoomsInCart ? 'Tambah ke Keranjang' : 'Pesan Sekarang' }}
                                </button>
                            @else
                                <a href="{{ route('users.cart') }}" class="book-button">
                                    <i class="bx bx-cart"></i>
                                    Lihat Keranjang
                                </a>
                            @endif

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $room->homestay->user->phone ?? '') }}" 
                               target="_blank" 
                               class="chat-button">
                                <i class="bx bxl-whatsapp"></i>
                                Hubungi Pemilik
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Rooms -->
    <div class="container mx-auto px-4 mb-12">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-[#2a3990]">Tipe Kamar Lainnya</h2>
            <p class="text-gray-600">Pilihan kamar lain di {{ $room->homestay->name }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($relatedRooms as $relatedRoom)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden room-preview-card">
                    <!-- Room Image -->
                    <div class="relative h-48">
                        @if ($relatedRoom->photos->isNotEmpty())
                            <img src="{{ asset('storage/images-room/' . $relatedRoom->photos->first()->photo_path) }}" 
                                 alt="{{ $relatedRoom->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/images-room/default-room.jpg') }}" 
                                 alt="Default Room" 
                                 class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Room Details -->
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-[#2a3990]">{{ $relatedRoom->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $relatedRoom->description }}</p>
                        
                        <!-- Room Features -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="flex items-center gap-1">
                                <i class="bx bx-user text-orange-500"></i>
                                <span class="text-sm text-gray-600">{{ $relatedRoom->max_guests }} Tamu</span>
                            </div>
                            @if($relatedRoom->facilities->isNotEmpty())
                                <div class="flex items-center gap-1">
                                    <i class="bx bx-check-circle text-orange-500"></i>
                                    <span class="text-sm text-gray-600">{{ $relatedRoom->facilities->count() }} Fasilitas</span>
                                </div>
                            @endif
                        </div>

                        <!-- Price and Action -->
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-lg font-bold text-[#2a3990]">
                                    Rp {{ number_format($relatedRoom->price, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500">per malam</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('rooms.show', $relatedRoom->id) }}" 
                                   class="detail-button">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-8">
                    <i class="bx bx-info-circle text-4xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">Tidak ada kamar lain yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<x-footer></x-footer>

<script>
    // JavaScript for gallery image switching
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.querySelector('.gallery-main-image');
        const thumbnails = document.querySelectorAll('.gallery-thumbnail');
        
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.src;
                
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const totalNightsElement = document.getElementById('totalNights');
    const totalPriceElement = document.getElementById('totalPrice');
    const roomPrice = {{ $room->price }};
    const quantitySelect = document.getElementById('quantity');
    
    function updateTotalPrice() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const quantity = parseInt(quantitySelect.value);
        
        if (checkIn && checkOut && checkOut > checkIn) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const totalPrice = nights * roomPrice * quantity;
            
            totalNightsElement.textContent = `${nights} malam`;
            document.getElementById('totalRooms').textContent = `${quantity} kamar`;
            totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        } else {
            totalNightsElement.textContent = '0 malam';
            totalPriceElement.textContent = 'Rp 0';
        }
    }

    // Set minimum date for check-in and check-out
    const today = new Date().toISOString().split('T')[0];
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];

    checkInInput.min = today;
    checkOutInput.min = tomorrowStr;

    // Update check-out min date when check-in changes
    checkInInput.addEventListener('change', function() {
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        checkOutInput.min = nextDay.toISOString().split('T')[0];
        if (checkOutInput.value && checkOutInput.value <= this.value) {
            checkOutInput.value = nextDay.toISOString().split('T')[0];
        }
        updateTotalPrice();
    });

    checkOutInput.addEventListener('change', updateTotalPrice);
    quantitySelect.addEventListener('change', updateTotalPrice);

    // Form validation
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);

        if (!checkInInput.value || !checkOutInput.value) {
            alert('Silakan pilih tanggal check-in dan check-out');
            return;
        }

        if (checkOut <= checkIn) {
            alert('Tanggal check-out harus lebih besar dari tanggal check-in');
            return;
        }

        // Check availability before submitting
        fetch(`/rooms/${room.id}/check-availability?check_in=${checkInInput.value}&check_out=${checkOutInput.value}`)
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    this.submit();
                } else {
                    alert('Maaf, kamar tidak tersedia untuk tanggal yang dipilih');
                }
            });
    });

    // Form handling with loading state
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const bookButton = document.getElementById('bookButton');
        if (!bookButton) return; // Exit if button doesn't exist (cart view)
        
        const checkIn = document.getElementById('check_in').value;
        const checkOut = document.getElementById('check_out').value;

        // Validation
        if (!checkIn || !checkOut) {
            showError('Silakan pilih tanggal check-in dan check-out');
            return;
        }

        if (new Date(checkOut) <= new Date(checkIn)) {
            showError('Tanggal check-out harus lebih besar dari tanggal check-in');
            return;
        }

        // Show loading state
        const originalText = bookButton.innerHTML;
        bookButton.disabled = true;
        bookButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Memproses...';

        // Submit form after short delay to show loading state
        setTimeout(() => {
            this.submit();
        }, 500);
    });

    function showError(message) {
        const alertHtml = `
            <div class="alert alert-error" role="alert">
                <i class="bx bx-x-circle"></i>
                <div>
                    <h3 class="font-medium">Gagal!</h3>
                    <p>${message}</p>
                </div>
            </div>
        `;
        
        const container = document.querySelector('.container');
        container.insertAdjacentHTML('afterbegin', alertHtml);
        
        // Auto dismiss after 5 seconds
        const alert = container.querySelector('.alert');
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    }

    // Auto dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const quantitySelect = document.getElementById('quantity');
    const guestsSelect = document.getElementById('guests');
    const maxGuestsPerRoom = {{ $room->max_guests }};

    function updateGuestOptions() {
        const selectedRooms = parseInt(quantitySelect.value);
        const maxTotalGuests = selectedRooms * maxGuestsPerRoom;
        
        // Enable guest select
        guestsSelect.disabled = false;
        
        // Clear existing options
        guestsSelect.innerHTML = '';
        
        // Add new options based on room quantity
        for (let i = selectedRooms; i <= maxTotalGuests; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = `${i} Tamu`;
            guestsSelect.appendChild(option);
        }

        // Select first option
        guestsSelect.value = selectedRooms;
        
        // Update price calculation
        updateTotalPrice();
    }

    // Update guest options when room quantity changes
    quantitySelect.addEventListener('change', updateGuestOptions);
    
    // Initial setup
    updateGuestOptions();
});

// Update the existing updateTotalPrice function
function updateTotalPrice() {
    const checkIn = new Date(checkInInput.value);
    const checkOut = new Date(checkOutInput.value);
    const quantity = parseInt(quantitySelect.value);
    
    if (checkIn && checkOut && checkOut > checkIn) {
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        const totalPrice = nights * roomPrice * quantity;
        
        totalNightsElement.textContent = `${nights} malam`;
        document.getElementById('totalRooms').textContent = `${quantity} kamar`;
        totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }
}
</script>
</body>
</html>