<!-- filepath: c:\xampp\htdocs\nazmainap\resources\views\owner\homestay\create-step3.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Homestay - Step 3</title>
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
            <h1><i class="fas fa-camera"></i> Foto Homestay</h1>
            <p>Langkah 3: Unggah foto-foto menarik homestay Anda</p>
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
                <div class="step active">
                    <div class="step-number">3</div>
                    <span>Foto</span>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <span>Kamar & Selesai</span>
                </div>
            </div>

            <form action="{{ route('owner.homestay.store.step3') }}" method="POST" enctype="multipart/form-data" class="homestay-form">
                @csrf
                
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-images"></i> Upload Foto Homestay</h3>
                        <p>Tambahkan foto yang menarik untuk menunjukkan keindahan homestay Anda</p>
                    </div>

                    <div class="upload-area">
                        <div class="upload-box" onclick="document.getElementById('photos').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <h4>Klik atau drag & drop foto di sini</h4>
                            <p>Format: JPG, PNG (Maks 5MB per file)</p>
                            <input type="file" 
                                   id="photos" 
                                   name="photos[]" 
                                   multiple 
                                   accept="image/*" 
                                   style="display: none;"
                                   onchange="handleFileUpload(this)">
                        </div>
                        <div id="preview-container" class="preview-grid"></div>
                    </div>

                    <!-- Tips Section -->
                    <div class="tips-section">
                        <h4><i class="fas fa-lightbulb"></i> Tips Foto yang Baik:</h4>
                        <ul class="tips-list">
                            <li>Pastikan pencahayaan cukup terang dan natural</li>
                            <li>Bersihkan ruangan sebelum memotret</li>
                            <li>Ambil foto dari berbagai sudut untuk memberikan gambaran lengkap</li>
                            <li>Tunjukkan detail-detail menarik dan fasilitas unggulan</li>
                            <li>Gunakan resolusi tinggi (minimal 1024x768 pixel)</li>
                        </ul>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('owner.homestay.create.step2') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Lanjutkan ke Kamar
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

        // Handle file upload preview
        function handleFileUpload(input) {
            const previewContainer = document.getElementById('preview-container');
            const files = Array.from(input.files);
            
            previewContainer.innerHTML = '';
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            <button type="button" class="remove-btn" onclick="removePreview(this, ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                            ${index === 0 ? '<span class="cover-badge">Cover</span>' : ''}
                        `;
                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removePreview(button, index) {
            const previewItem = button.parentElement;
            previewItem.remove();
            
            // Update file input
            const input = document.getElementById('photos');
            const dt = new DataTransfer();
            const files = Array.from(input.files);
            
            files.forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });
            
            input.files = dt.files;
            
            // Re-render preview
            handleFileUpload(input);
        }

        // Drag and drop functionality
        const uploadBox = document.querySelector('.upload-box');
        
        uploadBox.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#2c2f75';
            this.style.backgroundColor = '#f8f9ff';
        });

        uploadBox.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#cbd5e1';
            this.style.backgroundColor = '#f8fafc';
        });

        uploadBox.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#cbd5e1';
            this.style.backgroundColor = '#f8fafc';
            
            const files = e.dataTransfer.files;
            document.getElementById('photos').files = files;
            handleFileUpload(document.getElementById('photos'));
        });
    </script>
</body>
</html>