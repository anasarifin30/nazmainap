<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan Kamar - Owner Dashboard</title>
    @vite(['resources/css/owner/homestay/addavailability.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h2>Ketersediaan & Harga Kamar</h2>
                <p>Atur ketersediaan kamar dan periode booking untuk penginapan Anda</p>
            </div>

            <div class="form-container">
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step completed">
                        <div class="step-number">✓</div>
                        <span>Data Penginapan</span>
                    </div>
                    <div class="step completed">
                        <div class="step-number">✓</div>
                        <span>Alamat</span>
                    </div>
                    <div class="step completed">
                        <div class="step-number">✓</div>
                        <span>Foto Penginapan</span>
                    </div>
                    <div class="step active">
                        <div class="step-number">4</div>
                        <span>Ketersediaan</span>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="form-content">
                    <h3>Pengaturan Ketersediaan</h3>
                    <p class="form-subtitle">Tentukan kapasitas, harga, dan periode booking untuk menarik lebih banyak tamu</p>

                    <form class="homestay-form">
                        <!-- Informasi Dasar Kamar -->
                        <div class="section-card">
                            <div class="section-header">
                                <h4>🏠 Informasi Dasar Kamar</h4>
                                <p class="section-description">Detail kapasitas dan tipe kamar yang tersedia</p>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Jumlah Kamar Tidur</label>
                                    <select id="bedroom-count" class="form-select">
                                        <option value="">Pilih jumlah kamar</option>
                                        <option value="1">1 Kamar</option>
                                        <option value="2">2 Kamar</option>
                                        <option value="3">3 Kamar</option>
                                        <option value="4">4 Kamar</option>
                                        <option value="5+">5+ Kamar</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kapasitas Maksimal Tamu</label>
                                    <select id="guest-capacity" class="form-select">
                                        <option value="">Pilih kapasitas</option>
                                        <option value="2">2 Orang</option>
                                        <option value="4">4 Orang</option>
                                        <option value="6">6 Orang</option>
                                        <option value="8">8 Orang</option>
                                        <option value="10">10 Orang</option>
                                        <option value="12+">12+ Orang</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Tempat Tidur</label>
                                    <div class="checkbox-group">
                                        <label class="checkbox-item">
                                            <input type="checkbox" value="single">
                                            <span class="checkmark"></span>
                                            Single Bed
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" value="double">
                                            <span class="checkmark"></span>
                                            Double Bed
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" value="queen">
                                            <span class="checkmark"></span>
                                            Queen Bed
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" value="king">
                                            <span class="checkmark"></span>
                                            King Bed
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ketersediaan Kalender -->
                        <div class="section-card">
                            <div class="section-header">
                                <h4>📅 Pengaturan Ketersediaan</h4>
                                <p class="section-description">Tentukan tanggal yang tersedia untuk booking</p>
                            </div>
                            
                            <div class="availability-options">
                                <div class="availability-toggle">
                                    <label class="toggle-option">
                                        <input type="radio" name="availability" value="always" checked>
                                        <span class="radio-mark"></span>
                                        <div class="option-content">
                                            <strong>Selalu Tersedia</strong>
                                            <p>Kamar tersedia setiap hari kecuali yang sudah dibooking</p>
                                        </div>
                                    </label>
                                    
                                    <label class="toggle-option">
                                        <input type="radio" name="availability" value="custom">
                                        <span class="radio-mark"></span>
                                        <div class="option-content">
                                            <strong>Atur Tanggal Tertentu</strong>
                                            <p>Pilih tanggal spesifik yang ingin dibuka untuk booking</p>
                                        </div>
                                    </label>
                                </div>

                                <div id="custom-dates" class="custom-dates-section" style="display: none;">
                                    <div class="date-range-picker">
                                        <div class="form-group">
                                            <label>Tanggal Mulai Tersedia</label>
                                            <input type="date" id="available-from" class="form-input">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Berakhir Tersedia</label>
                                            <input type="date" id="available-until" class="form-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hari Tidak Tersedia -->
                            <div class="blocked-days">
                                <h5>Hari yang Tidak Tersedia</h5>
                                <div class="days-checkbox">
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="sunday">
                                        <span class="checkmark"></span>
                                        Minggu
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="monday">
                                        <span class="checkmark"></span>
                                        Senin
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="tuesday">
                                        <span class="checkmark"></span>
                                        Selasa
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="wednesday">
                                        <span class="checkmark"></span>
                                        Rabu
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="thursday">
                                        <span class="checkmark"></span>
                                        Kamis
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="friday">
                                        <span class="checkmark"></span>
                                        Jumat
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" value="saturday">
                                        <span class="checkmark"></span>
                                        Sabtu
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="/owner/addphoto" class="btn btn-secondary">Kembali</a>
                            <a href="/owner/homestayowner" class="btn btn-primary">Selesai & Publish</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Handle availability type toggle
        document.querySelectorAll('input[name="availability"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const customDatesSection = document.getElementById('custom-dates');
                if (this.value === 'custom') {
                    customDatesSection.style.display = 'block';
                } else {
                    customDatesSection.style.display = 'none';
                }
            });
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('available-from').min = today;
        document.getElementById('available-until').min = today;

        // Update available-until minimum when available-from changes
        document.getElementById('available-from').addEventListener('change', function() {
            document.getElementById('available-until').min = this.value;
        });

        // Form validation and submission
        document.querySelector('.homestay-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            let errors = [];

            // Required fields validation
            const requiredFields = [
                { id: 'bedroom-count', name: 'Jumlah Kamar Tidur' },
                { id: 'guest-capacity', name: 'Kapasitas Maksimal Tamu' },
                { id: 'bathroom-count', name: 'Jumlah Kamar Mandi' },
                { id: 'base-price', name: 'Harga Dasar' }
            ];

            requiredFields.forEach(field => {
                const element = document.getElementById(field.id);
                if (!element.value || element.value.trim() === '') {
                    isValid = false;
                    errors.push(`${field.name} harus diisi`);
                    element.style.borderColor = '#ef4444';
                } else {
                    element.style.borderColor = '#d1d5db';
                }
            });

            // Validate bed types
            const bedTypes = document.querySelectorAll('input[type="checkbox"][value]');
            const checkedBedTypes = Array.from(bedTypes).filter(cb => cb.checked);
            if (checkedBedTypes.length === 0) {
                isValid = false;
                errors.push('Pilih minimal satu tipe tempat tidur');
            }

            // Validate pricing
            const basePrice = parseFloat(document.getElementById('base-price').value);
            const weekendPrice = parseFloat(document.getElementById('weekend-price').value);
            const highSeasonPrice = parseFloat(document.getElementById('high-season-price').value);

            if (basePrice && basePrice < 50000) {
                isValid = false;
                errors.push('Harga dasar minimal Rp 50.000');
            }

            if (weekendPrice && weekendPrice < basePrice) {
                isValid = false;
                errors.push('Harga weekend tidak boleh lebih rendah dari harga dasar');
            }

            if (highSeasonPrice && highSeasonPrice < basePrice) {
                isValid = false;
                errors.push('Harga high season tidak boleh lebih rendah dari harga dasar');
            }

            // Validate min/max stay
            const minStay = parseInt(document.getElementById('min-stay').value);
            const maxStay = parseInt(document.getElementById('max-stay').value);

            if (maxStay > 0 && minStay >= maxStay) {
                isValid = false;
                errors.push('Durasi maksimal harus lebih besar dari durasi minimal');
            }

            // Validate custom dates if selected
            const availabilityType = document.querySelector('input[name="availability"]:checked').value;
            if (availabilityType === 'custom') {
                const availableFrom = document.getElementById('available-from').value;
                const availableUntil = document.getElementById('available-until').value;
                
                if (!availableFrom || !availableUntil) {
                    isValid = false;
                    errors.push('Tanggal ketersediaan harus diisi jika memilih atur tanggal tertentu');
                } else if (new Date(availableFrom) >= new Date(availableUntil)) {
                    isValid = false;
                    errors.push('Tanggal berakhir harus setelah tanggal mulai');
                }
            }

            // Validate check-in/check-out times
            const checkinFrom = document.getElementById('checkin-from').value;
            const checkinUntil = document.getElementById('checkin-until').value;
            const checkoutFrom = document.getElementById('checkout-from').value;
            const checkoutUntil = document.getElementById('checkout-until').value;

            if (checkinFrom >= checkinUntil) {
                isValid = false;
                errors.push('Waktu check-in tidak valid');
            }

            if (checkoutFrom >= checkoutUntil) {
                isValid = false;
                errors.push('Waktu check-out tidak valid');
            }

            if (!isValid) {
                alert('Mohon perbaiki kesalahan berikut:\n\n' + errors.join('\n'));
                return;
            }

            // If validation passes, show success message
            alert('Selamat! Penginapan Anda berhasil dibuat dan siap untuk menerima booking.\n\nData akan diproses dan listing Anda akan aktif dalam 24 jam.');
            
            // Here you would typically submit the form data to the server
            console.log('Form submitted successfully!');
        });

        // Format number inputs for prices
        document.querySelectorAll('.price-input').forEach(input => {
            input.addEventListener('input', function() {
                // Remove non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            input.addEventListener('blur', function() {
                if (this.value) {
                    // Format number with thousand separators
                    const number = parseInt(this.value);
                    this.value = number.toLocaleString('id-ID').replace(/,/g, '');
                }
            });
        });

        // Auto-fill weekend and high season prices based on base price
        document.getElementById('base-price').addEventListener('blur', function() {
            const basePrice = parseInt(this.value);
            if (basePrice && basePrice > 0) {
                const weekendInput = document.getElementById('weekend-price');
                const highSeasonInput = document.getElementById('high-season-price');
                
                if (!weekendInput.value) {
                    weekendInput.value = Math.round(basePrice * 1.2); // 20% markup
                }
                
                if (!highSeasonInput.value) {
                    highSeasonInput.value = Math.round(basePrice * 1.5); // 50% markup
                }
            }
        });

        // Show/hide upload box based on max limit for continuity with previous page
        function updateFormState() {
            // Any additional form state management can go here
            console.log('Form state updated');
        }

        // Initialize form
        document.addEventListener('DOMContentLoaded', function() {
            updateFormState();
        });
    </script>
</body>
</html>