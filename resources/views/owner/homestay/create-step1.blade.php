<!-- filepath: c:\xampp\htdocs\nazmainap\resources\views\owner\homestay\create-step1.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Homestay - Step 1</title>
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
            <h1><i class="fas fa-home"></i> Tambah Homestay Baru</h1>
            <p>Langkah 1: Data Penginapan</p>
        </div>

        <div class="form-container">
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <span>Data Penginapan</span>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <span>Alamat</span>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <span>Foto</span>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <span>Kamar & Selesai</span>
                </div>
            </div>

            <form action="{{ route('owner.homestay.store.step1') }}" method="POST" class="homestay-form">
                @csrf
                
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-info-circle"></i> Informasi Dasar</h3>
                        <p>Berikan informasi dasar tentang homestay Anda</p>
                    </div>

                    <div class="form-group">
                        <label for="name" class="required">Nama Homestay</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', session('homestay_step1.name')) }}"
                               placeholder="Contoh: Villa Sejuk Bantul" 
                               required>
                        <small class="form-hint">Berikan nama yang menarik dan mudah diingat</small>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="required">Deskripsi Homestay</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="6" 
                                  placeholder="Ceritakan tentang homestay Anda, fasilitas yang tersedia, lokasi strategis, dan keunggulan lainnya. Minimal 50 karakter."
                                  required>{{ old('description', session('homestay_step1.description')) }}</textarea>
                        <small class="form-hint">Deskripsi yang detail akan membantu menarik tamu</small>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Fasilitas Homestay Section -->
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-star"></i> Fasilitas Homestay</h3>
                        <p>Pilih fasilitas yang tersedia di homestay Anda</p>
                    </div>

                    @php
                        $facilities = \App\Models\Facility::active()->ordered()->get()->groupBy('category');
                        $selectedFacilities = old('facilities', session('homestay_step1.facilities', []));
                        
                        $facilityCategories = [
                            'basic' => 'Fasilitas Dasar',
                            'entertainment' => 'Hiburan',
                            'outdoor' => 'Area Luar',
                            'business' => 'Bisnis',
                            'general' => 'Fasilitas Umum'
                        ];
                    @endphp

                    @foreach($facilities as $category => $categoryFacilities)
                        <div class="facilities-category">
                            <h4 class="category-title">
                                <i class="fas fa-{{ $category === 'basic' ? 'home' : ($category === 'entertainment' ? 'gamepad' : ($category === 'outdoor' ? 'tree' : ($category === 'business' ? 'briefcase' : 'cog'))) }}"></i>
                                {{ $facilityCategories[$category] ?? ucfirst($category) }}
                            </h4>
                            
                            <div class="facilities-grid">
                                @foreach($categoryFacilities as $facility)
                                    <div class="facility-item">
                                        <input type="checkbox" 
                                               id="facility_{{ $facility->id }}" 
                                               name="facilities[]" 
                                               value="{{ $facility->id }}"
                                               {{ in_array($facility->id, $selectedFacilities) ? 'checked' : '' }}>
                                        <label for="facility_{{ $facility->id }}">
                                            <span class="facility-icon">
                                                <i class="{{ $facility->icon }}"></i>
                                            </span>
                                            <span class="facility-text">{{ $facility->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @if($facilities->isEmpty())
                        <div class="empty-facilities">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Tidak ada template fasilitas tersedia. Silakan hubungi administrator.</p>
                        </div>
                    @endif

                    <div class="facilities-summary">
                        <h4 class="summary-title">
                            <i class="fas fa-check-circle"></i>
                            Ringkasan Fasilitas Terpilih
                        </h4>
                        <div class="selected-facilities" id="selectedFacilities">
                            <span class="no-selection">Belum ada fasilitas yang dipilih</span>
                        </div>
                    </div>
                </div>

                <!-- Rules Section -->
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-list-ul"></i> Peraturan Homestay</h3>
                        <p>Pilih peraturan yang berlaku di homestay Anda</p>
                    </div>

                    @php
                        $ruleTemplates = \App\Models\RuleTemplate::active()->ordered()->get()->groupBy('category');
                        $selectedRules = old('rules', session('homestay_step1.rules', []));
                        
                        $categoryLabels = [
                            'check_in_out' => 'Check-in & Check-out',
                            'behavior' => 'Perilaku Tamu',
                            'facility' => 'Penggunaan Fasilitas',
                            'general' => 'Peraturan Umum'
                        ];
                    @endphp

                    @foreach($ruleTemplates as $category => $rules)
                        <div class="rules-category">
                            <h4 class="category-title">
                                <i class="fas fa-{{ $category === 'check_in_out' ? 'clock' : ($category === 'behavior' ? 'user-check' : ($category === 'facility' ? 'tools' : 'shield-alt')) }}"></i>
                                {{ $categoryLabels[$category] ?? ucfirst($category) }}
                            </h4>
                            
                            <div class="rules-grid">
                                @foreach($rules as $rule)
                                    <div class="rule-item">
                                        <input type="checkbox" 
                                               id="rule_{{ $rule->id }}" 
                                               name="rules[]" 
                                               value="{{ $rule->id }}"
                                               {{ in_array($rule->id, $selectedRules) ? 'checked' : '' }}>
                                        <label for="rule_{{ $rule->id }}">
                                            <span class="checkmark"></span>
                                            <span class="rule-text">{{ $rule->rule_text }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    @if($ruleTemplates->isEmpty())
                        <div class="empty-rules">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Tidak ada template peraturan tersedia. Silakan hubungi administrator.</p>
                        </div>
                    @endif

                    <div class="custom-rule-section">
                        <h4 class="category-title">
                            <i class="fas fa-plus-circle"></i>
                            Peraturan Tambahan (Opsional)
                        </h4>
                        <div class="form-group">
                            <textarea name="custom_rules" 
                                      id="custom_rules"
                                      rows="3"
                                      placeholder="Tambahkan peraturan khusus lainnya jika diperlukan...">{{ old('custom_rules', session('homestay_step1.custom_rules')) }}</textarea>
                            <small class="form-hint">Pisahkan setiap peraturan dengan baris baru</small>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('owner.homestay') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Lanjutkan ke Alamat
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

        // Character counter for description
        document.getElementById('description').addEventListener('input', function() {
            const char = this.value.length;
            const min = 50;
            
            if (char < min) {
                this.style.borderColor = '#ef4444';
            } else {
                this.style.borderColor = '#10b981';
            }
        });

        // Facilities selection handler
        document.addEventListener('DOMContentLoaded', function() {
            const facilityCheckboxes = document.querySelectorAll('input[name="facilities[]"]');
            const selectedFacilitiesContainer = document.getElementById('selectedFacilities');
            
            function updateSelectedFacilities() {
                const selected = Array.from(facilityCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => {
                        const label = document.querySelector(`label[for="${checkbox.id}"]`);
                        const icon = label.querySelector('i').className;
                        const text = label.querySelector('.facility-text').textContent;
                        return { icon, text };
                    });
                
                if (selected.length === 0) {
                    selectedFacilitiesContainer.innerHTML = '<span class="no-selection">Belum ada fasilitas yang dipilih</span>';
                } else {
                    selectedFacilitiesContainer.innerHTML = selected.map(facility => 
                        `<span class="selected-facility">
                            <i class="${facility.icon}"></i>
                            ${facility.text}
                        </span>`
                    ).join('');
                }
            }
            
            facilityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedFacilities);
            });
            
            updateSelectedFacilities(); // Initial update
        });

        // Rules selection counter
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="rules[]"]');
            const updateCounter = () => {
                const selected = document.querySelectorAll('input[name="rules[]"]:checked').length;
                console.log(`${selected} peraturan dipilih`);
            };
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCounter);
            });
            
            updateCounter(); // Initial count
        });
    </script>
</body>
</html>