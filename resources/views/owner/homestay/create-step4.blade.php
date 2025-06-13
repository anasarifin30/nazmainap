<!-- filepath: c:\xampp\htdocs\nazmainap\resources\views\owner\homestay\create-step4.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Homestay - Step 4</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/owner/sidebar-owner.css', 'resources/css/owner/homestay/create-steps.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Include Sidebar -->
    <x-sidebar-owner active-menu="homestay" />

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <div class="page-header">
            <h1><i class="fas fa-bed"></i> Kamar Pertama</h1>
            <p>Langkah 4: Tambahkan kamar pertama untuk menyelesaikan pendaftaran</p>
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
                    <span>Foto</span>
                </div>
                <div class="step active">
                    <div class="step-number">4</div>
                    <span>Kamar & Selesai</span>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="summary-card">
                <h3><i class="fas fa-check-circle"></i> Ringkasan Homestay</h3>
                <div class="summary-content">
                    <div class="summary-item">
                        <strong>Nama:</strong> {{ session('homestay_step1.name') }}
                    </div>
                    <div class="summary-item">
                        <strong>Lokasi:</strong> {{ session('homestay_step2.kelurahan') }}, {{ session('homestay_step2.kecamatan') }}, {{ session('homestay_step2.kabupaten') }}
                    </div>
                    <div class="summary-item">
                        <strong>Foto:</strong> {{ count(session('homestay_step3.photos', [])) }} foto telah diupload
                    </div>
                </div>
            </div>

            <form action="{{ route('owner.homestay.store.step4') }}" method="POST" class="homestay-form">
                @csrf
                
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-plus-circle"></i> Tambah Kamar Pertama</h3>
                        <p>Anda bisa menambah kamar lainnya setelah homestay dibuat</p>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="room_name" class="required">Nama Kamar</label>
                            <input type="text" 
                                   id="room_name" 
                                   name="room_name" 
                                   value="{{ old('room_name') }}"
                                   placeholder="Contoh: Deluxe Room" 
                                   required>
                            @error('room_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="required">Harga per Malam (Rp)</label>
                            <input type="number" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price') }}"
                                   placeholder="100000" 
                                   min="0"
                                   required>
                            @error('price')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_guests" class="required">Kapasitas Maksimal</label>
                            <select id="max_guests" name="max_guests" required>
                                <option value="">Pilih kapasitas</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('max_guests') == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? 'Orang' : 'Orang' }}
                                    </option>
                                @endfor
                            </select>
                            @error('max_guests')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_rooms" class="required">Jumlah Unit Kamar</label>
                            <select id="total_rooms" name="total_rooms" required>
                                <option value="">Pilih jumlah unit</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('total_rooms') == $i ? 'selected' : '' }}>
                                        {{ $i }} Unit
                                    </option>
                                @endfor
                            </select>
                            @error('total_rooms')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="room_description">Deskripsi Kamar (Opsional)</label>
                        <textarea id="room_description" 
                                  name="room_description" 
                                  rows="4" 
                                  placeholder="Deskripsikan fasilitas dan keunggulan kamar ini...">{{ old('room_description') }}</textarea>
                        @error('room_description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-wifi"></i> Fasilitas Kamar</h3>
                        <p>Pilih fasilitas yang tersedia di kamar ini</p>
                    </div>

                    <div class="facilities-grid">
                        @php
                            $commonFacilities = [
                                ['name' => 'WiFi Gratis', 'icon' => 'fa-wifi'],
                                ['name' => 'AC', 'icon' => 'fa-snowflake'],
                                ['name' => 'TV', 'icon' => 'fa-tv'],
                                ['name' => 'Kamar Mandi Dalam', 'icon' => 'fa-bath'],
                                ['name' => 'Air Panas', 'icon' => 'fa-fire'],
                                ['name' => 'Lemari Pakaian', 'icon' => 'fa-door-closed'],
                                ['name' => 'Meja Kerja', 'icon' => 'fa-desk'],
                                ['name' => 'Balkon', 'icon' => 'fa-building'],
                            ];
                            $selectedFacilities = old('facilities', []);
                        @endphp

                        @foreach($commonFacilities as $index => $facility)
                            <div class="facility-item">
                                <input type="checkbox" 
                                       id="facility_{{ $index }}" 
                                       name="facilities[]" 
                                       value="{{ $facility['name'] }}"
                                       {{ in_array($facility['name'], $selectedFacilities) ? 'checked' : '' }}>
                                <label for="facility_{{ $index }}">
                                    <i class="fas {{ $facility['icon'] }}"></i>
                                    {{ $facility['name'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('owner.homestay.create.step3') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Selesai & Publikasikan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Mobile sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            let sidebarOpen = false;
            
            function isMobile() {
                return window.innerWidth <= 768;
            }
            
            function toggleSidebar() {
                if (isMobile()) {
                    sidebarOpen = !sidebarOpen;
                    sidebar.classList.toggle('mobile-open', sidebarOpen);
                    sidebarOverlay.classList.toggle('active', sidebarOpen);
                    document.body.classList.toggle('mobile-sidebar-open', sidebarOpen);
                    
                    const icon = mobileMenuBtn.querySelector('i');
                    if (sidebarOpen) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }
        });

        // Format price input
        document.getElementById('price').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Price formatting on blur
        document.getElementById('price').addEventListener('blur', function() {
            if (this.value) {
                const number = parseInt(this.value);
                this.setAttribute('data-raw', number);
            }
        });
    </script>
</body>
</html>