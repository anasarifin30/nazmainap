<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/confirpayment.css'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <x-header></x-header>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Property Image and Details -->
            <div class="flex flex-col md:flex-row">
                <!-- Property Image -->
                <div class="md:w-1/2">
                    <img src="{{ asset('images/homestay.jpg') }}" alt="Hacienda Watukarung" class="w-full h-full object-cover">
                </div>
                
                <!-- Booking Details Form -->
                <div class="md:w-1/2 p-6">
                    <h1 class="text-2xl font-bold mb-1">Hacienda Watukarung</h1>
                    <p class="text-gray-600 mb-4">Bingkusan, Pemesanan</p>
                    
                    <!-- Booking Form -->
                    <form action="{{ route('payment.confirm') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Masuk</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="date" name="check_in" value="{{ $booking->check_in }}" class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md" readonly>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Keluar</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="date" name="check_out" value="{{ $booking->check_out }}" class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" name="guests" value="2" class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md" readonly>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="location" value="Pacitan" class="form-input block w-full px-3 py-2 border border-gray-300 rounded-md" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-4">
                            <h3 class="text-lg font-semibold">Rincian Harga</h3>
                            <div class="flex justify-between items-center mt-2">
                                <span>Biaya Kamar</span>
                                <span>Rp{{ number_format($booking->base_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center mt-1">
                                <span>Biaya Layanan</span>
                                <span>Rp{{ number_format($booking->service_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center mt-4 pt-2 border-t border-gray-200">
                                <span class="font-semibold">Total</span>
                                <span class="font-bold text-lg">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                                Lanjutkan ke Pembayaran
                            </button>
                            <p class="text-xs text-gray-500 text-center mt-2">
                                Dengan menekan tombol di atas, Anda setuju dengan syarat dan ketentuan yang berlaku
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Pilih Metode Pembayaran</h3>
                <button class="close-modal text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-md p-3 flex items-center justify-between hover:bg-gray-50 cursor-pointer payment-method" data-method="bank_transfer">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <span>Transfer Bank</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                
                <div class="border border-gray-200 rounded-md p-3 flex items-center justify-between hover:bg-gray-50 cursor-pointer payment-method" data-method="credit_card">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <span>Kartu Kredit/Debit</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                
                <div class="border border-gray-200 rounded-md p-3 flex items-center justify-between hover:bg-gray-50 cursor-pointer payment-method" data-method="e_wallet">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span>E-Wallet</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
            
            <div class="mt-6">
                <button id="completePayment" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-md transition duration-200">
                    Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
    
    <script>
        // Show payment modal
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('paymentModal').classList.remove('hidden');
        });
        
        // Close payment modal
        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('paymentModal').classList.add('hidden');
        });
        
        // Handle payment method selection
        document.querySelectorAll('.payment-method').forEach(function(method) {
            method.addEventListener('click', function() {
                document.querySelectorAll('.payment-method').forEach(function(m) {
                    m.classList.remove('border-blue-500', 'bg-blue-50');
                });
                this.classList.add('border-blue-500', 'bg-blue-50');
            });
        });
        
        // Complete payment
        document.getElementById('completePayment').addEventListener('click', function() {
            // Get selected payment method
            const selectedMethod = document.querySelector('.payment-method.border-blue-500');
            if (!selectedMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu!');
                return;
            }
            
            const paymentMethod = selectedMethod.getAttribute('data-method');
            
            // Create a form to submit the data
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("payment.process") }}';
            
            // Add CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            // Add booking ID
            const bookingIdInput = document.createElement('input');
            bookingIdInput.type = 'hidden';
            bookingIdInput.name = 'booking_id';
            bookingIdInput.value = '{{ $booking->id }}';
            form.appendChild(bookingIdInput);
            
            // Add payment method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = 'payment_method';
            methodInput.value = paymentMethod;
            form.appendChild(methodInput);
            
            // Add form to document and submit
            document.body.appendChild(form);
            form.submit();
        });
    </script>
    <x-footer></x-footer>
</body>
</html>