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
                                        <span>Maks: {{ $room->max_guests }} Tamu</span>
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
                            <div id="availabilityInfo" class="mb-2"></div>
                            <select id="quantity" 
                                    name="quantity" 
                                    class="quantity-select w-full" 
                                    required>
                                <option value="">Pilih jumlah kamar</option>
                                <!-- Options akan diisi oleh JavaScript -->
                            </select>
                        </div>

                        <!-- Price Summary -->
                        <div class="price-summary mb-6">
                            <div class="price-row">
                                <span>Total Malam</span>
                                <span id="totalNights">0 malam</span>
                            </div>
                            <div class="price-row">
                                <span>Total Kamar</span>
                                <span id="totalRooms">0 kamar</span>
                            </div>
                            <div class="price-row total">
                                <span>Total Harga</span>
                                <span id="totalPrice">Rp 0</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="booking-buttons">
                            @if(!$existingDetail)
                                <button type="submit" class="book-button" id="bookButton" disabled>
                                    <i class="bx bx-loader-alt bx-spin"></i>
                                    Mengecek Ketersediaan...
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
                                <p class="text-sm text-gray-500">harga /malam</p>
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
document.addEventListener('DOMContentLoaded', function() {
    // Gallery functionality
    const mainImage = document.querySelector('.gallery-main-image');
    const thumbnails = document.querySelectorAll('.gallery-thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            mainImage.src = this.src;
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Main booking functionality
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const quantitySelect = document.getElementById('quantity');
    const totalNightsElement = document.getElementById('totalNights');
    const totalPriceElement = document.getElementById('totalPrice');
    const totalRoomsElement = document.getElementById('totalRooms');
    const bookingForm = document.getElementById('bookingForm');
    const bookButton = document.getElementById('bookButton');
    const availabilityInfo = document.getElementById('availabilityInfo');
    
    const roomId = {{ $room->id }};
    const roomPrice = {{ $room->price }};
    const otherRoomsInCart = @json($otherRoomsInCart);
    const existingBooking = @json($existingBooking ?? null);

    console.log('=== PAGE LOADED ===', {
        roomId,
        roomPrice,
        otherRoomsInCart,
        existingBooking,
        elements: {
            checkInInput: !!checkInInput,
            checkOutInput: !!checkOutInput,
            bookButton: !!bookButton,
            availabilityInfo: !!availabilityInfo
        }
    });

    // Set minimum dates
    if (checkInInput && checkOutInput) {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        checkInInput.min = today.toISOString().split('T')[0];
        checkOutInput.min = tomorrow.toISOString().split('T')[0];
        
        // Set default dates jika belum ada
        if (!checkInInput.value && !otherRoomsInCart) {
            checkInInput.value = today.toISOString().split('T')[0];
            checkOutInput.value = tomorrow.toISOString().split('T')[0];
        }
    }

    // SINGLE updateAvailableRooms function
    async function updateAvailableRooms() {
        let checkIn, checkOut;
        
        if (otherRoomsInCart && existingBooking) {
            checkIn = existingBooking.check_in;
            checkOut = existingBooking.check_out;
        } else {
            checkIn = checkInInput?.value;
            checkOut = checkOutInput?.value;
        }
        
        console.log('=== CHECKING AVAILABILITY ===', {checkIn, checkOut, roomId});
        
        if (checkIn && checkOut) {
            try {
                const response = await fetch(`/rooms/${roomId}/available?check_in=${checkIn}&check_out=${checkOut}`);
                const data = await response.json();
                
                console.log('=== API RESPONSE ===', data);
                
                if (data.error) {
                    console.error('API Error:', data.error);
                    return;
                }
                
                const availableRooms = data.available_rooms;
                
                // Update availability message
                if (availabilityInfo) {
                    if (availableRooms > 0) {
                        availabilityInfo.innerHTML = `<p class="text-green-600">✅ Tersedia ${availableRooms} dari ${data.total_rooms} kamar</p>`;
                    } else {
                        availabilityInfo.innerHTML = '<p class="text-red-600">❌ Tidak ada kamar tersedia untuk tanggal yang dipilih</p>';
                    }
                }
                
                // Update quantity select
                if (quantitySelect) {
                    quantitySelect.innerHTML = '<option value="">Pilih jumlah kamar</option>';
                    
                    if (availableRooms > 0) {
                        for (let i = 1; i <= Math.min(availableRooms, 5); i++) {
                            const option = document.createElement('option');
                            option.value = i;
                            option.textContent = `${i} Kamar`;
                            quantitySelect.appendChild(option);
                        }
                        quantitySelect.disabled = false;
                    } else {
                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'Tidak tersedia';
                        quantitySelect.appendChild(option);
                        quantitySelect.disabled = true;
                    }
                }
                
                // Update book button - INI YANG PENTING!
                if (bookButton) {
                    if (availableRooms > 0) {
                        bookButton.disabled = false;
                        bookButton.innerHTML = `
                            <i class="bx bx-check-circle"></i>
                            ${otherRoomsInCart ? 'Tambah ke Keranjang' : 'Pesan Sekarang'}
                        `;
                        bookButton.style.backgroundColor = '#ed7e21';
                        bookButton.style.cursor = 'pointer';
                        bookButton.style.opacity = '1';
                    } else {
                        bookButton.disabled = true;
                        bookButton.innerHTML = `
                            <i class="bx bx-x-circle"></i>
                            Kamar Tidak Tersedia
                        `;
                        bookButton.style.backgroundColor = '#9ca3af';
                        bookButton.style.cursor = 'not-allowed';
                        bookButton.style.opacity = '0.7';
                    }
                }
                
                updateTotalPrice();
                
            } catch (error) {
                console.error('=== FETCH ERROR ===', error);
                if (availabilityInfo) {
                    availabilityInfo.innerHTML = 
                        '<p class="text-yellow-600">⚠️ Tidak dapat mengecek ketersediaan kamar</p>';
                }
                // Jika error, enable button with warning
                if (bookButton) {
                    bookButton.disabled = false;
                    bookButton.innerHTML = `
                        <i class="bx bx-error-circle"></i>
                        ${otherRoomsInCart ? 'Tambah ke Keranjang' : 'Pesan Sekarang'}
                    `;
                    bookButton.style.backgroundColor = '#f59e0b';
                }
            }
        } else {
            // Jika tidak ada tanggal, disable button
            if (bookButton) {
                bookButton.disabled = true;
                bookButton.innerHTML = `
                    <i class="bx bx-calendar"></i>
                    Pilih Tanggal Check-in & Check-out
                `;
                bookButton.style.backgroundColor = '#9ca3af';
            }
        }
    }

    function updateTotalPrice() {
        if (!checkInInput || !checkOutInput || !quantitySelect) return;
        
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        const quantity = parseInt(quantitySelect.value) || 0;
        
        if (checkIn && checkOut && checkOut > checkIn && quantity > 0) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const totalPrice = nights * roomPrice * quantity;
            
            if (totalNightsElement) totalNightsElement.textContent = `${nights} malam`;
            if (totalRoomsElement) totalRoomsElement.textContent = `${quantity} kamar`;
            if (totalPriceElement) totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        } else {
            if (totalNightsElement) totalNightsElement.textContent = '0 malam';
            if (totalRoomsElement) totalRoomsElement.textContent = '0 kamar';
            if (totalPriceElement) totalPriceElement.textContent = 'Rp 0';
        }
    }

    // Event listeners
    if (!otherRoomsInCart) {
        checkInInput?.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);
            
            if (checkOutInput) {
                checkOutInput.min = nextDay.toISOString().split('T')[0];
                
                if (new Date(checkOutInput.value) <= selectedDate) {
                    checkOutInput.value = nextDay.toISOString().split('T')[0];
                }
            }
            
            updateAvailableRooms();
        });

        checkOutInput?.addEventListener('change', function() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(this.value);
            
            if (checkOut <= checkIn) {
                const nextDay = new Date(checkIn);
                nextDay.setDate(nextDay.getDate() + 1);
                this.value = nextDay.toISOString().split('T')[0];
            }
            
            updateAvailableRooms();
        });
    }

    quantitySelect?.addEventListener('change', updateTotalPrice);

    // Form submission
    bookingForm?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const checkIn = checkInInput?.value;
        const checkOut = checkOutInput?.value;
        const quantity = quantitySelect?.value;

        if (!checkIn || !checkOut) {
            showError('Silakan pilih tanggal check-in dan check-out');
            return;
        }

        if (!quantity) {
            showError('Silakan pilih jumlah kamar');
            return;
        }

        // Show loading state
        if (bookButton) {
            bookButton.disabled = true;
            bookButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Memproses...';
        }

        this.submit();
    });

    // JALANKAN AVAILABILITY CHECK PADA LOAD - INI YANG PENTING!
    console.log('=== INITIAL LOAD CHECK ===');
    if (otherRoomsInCart && existingBooking) {
        if (checkInInput) checkInInput.value = existingBooking.check_in;
        if (checkOutInput) checkOutInput.value = existingBooking.check_out;
    }
    
    // Selalu jalankan availability check saat load
    setTimeout(() => {
        updateAvailableRooms();
    }, 100);
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
    if (container) {
        container.insertAdjacentHTML('afterbegin', alertHtml);
        
        setTimeout(() => {
            const alert = container.querySelector('.alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    }
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
</script>
</body>
</html>