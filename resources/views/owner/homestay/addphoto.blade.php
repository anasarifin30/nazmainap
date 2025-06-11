<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foto Kamar - Owner Dashboard</title>
    @vite(['resources/css/owner/homestay/addphoto.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h2>Foto Kamar & Fasilitas</h2>
                <p>Unggah foto-foto berkualitas untuk menarik perhatian tamu dan memberikan gambaran yang jelas</p>
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
                        <div class="step-number">3</div>
                        <span>Foto Penginapan</span>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <span>Ketersediaan</span>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="form-content">
                    <h3>Upload Foto Penginapan</h3>
                    <p class="form-subtitle">Tambahkan foto-foto yang menarik untuk setiap kategori. Pastikan foto memiliki pencahayaan yang baik dan resolusi tinggi.</p>

                    <form class="homestay-form">
                        <!-- Foto Kamar Tidur -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>🛏️ Foto Kamar</h4>
                                <p class="category-description">Tunjukkan kenyamanan dan suasana kamar Anda</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="bedroom-grid">
                                    <div class="upload-box" onclick="triggerFileInput('bedroom')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="bedroom" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'bedroom-grid')">
                                <p class="photo-count">0/10 foto (Minimal 3 foto)</p>
                            </div>
                        </div>

                        <!-- Foto Kamar Mandi -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>🚿 Foto Kamar Mandi</h4>
                                <p class="category-description">Tampilkan kebersihan dan fasilitas kamar mandi</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="bathroom-grid">
                                    <div class="upload-box" onclick="triggerFileInput('bathroom')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="bathroom" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'bathroom-grid')">
                                <p class="photo-count">0/8 foto (Minimal 2 foto)</p>
                            </div>
                        </div>

                        <!-- Foto Ruang Tamu/Bersama -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>🛋️ Foto Ruang Tamu/Bersama</h4>
                                <p class="category-description">Area berkumpul dan bersantai untuk tamu</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="livingroom-grid">
                                    <div class="upload-box" onclick="triggerFileInput('livingroom')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="livingroom" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'livingroom-grid')">
                                <p class="photo-count">0/6 foto (Opsional)</p>
                            </div>
                        </div>

                        <!-- Foto Dapur -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>🍳 Foto Dapur</h4>
                                <p class="category-description">Fasilitas memasak yang tersedia untuk tamu</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="kitchen-grid">
                                    <div class="upload-box" onclick="triggerFileInput('kitchen')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="kitchen" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'kitchen-grid')">
                                <p class="photo-count">0/5 foto (Opsional)</p>
                            </div>
                        </div>

                        <!-- Foto Area Luar/Taman -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>🌿 Foto Area Luar/Taman</h4>
                                <p class="category-description">Pemandangan dan area outdoor penginapan</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="outdoor-grid">
                                    <div class="upload-box" onclick="triggerFileInput('outdoor')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="outdoor" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'outdoor-grid')">
                                <p class="photo-count">0/8 foto (Opsional)</p>
                            </div>
                        </div>

                        <!-- Foto Fasilitas Tambahan -->
                        <div class="photo-category">
                            <div class="category-header">
                                <h4>⭐ Foto Fasilitas Tambahan</h4>
                                <p class="category-description">Fasilitas khusus seperti kolam renang, parkir, dll</p>
                            </div>
                            
                            <div class="upload-section">
                                <div class="upload-grid" id="facilities-grid">
                                    <div class="upload-box" onclick="triggerFileInput('facilities')">
                                        <div class="upload-icon">📷</div>
                                        <p>Klik untuk upload foto</p>
                                        <span class="upload-hint">JPG, PNG (Maks 5MB)</span>
                                    </div>
                                </div>
                                <input type="file" id="facilities" accept="image/*" multiple style="display: none;" onchange="handleFileUpload(this, 'facilities-grid')">
                                <p class="photo-count">0/10 foto (Opsional)</p>
                            </div>
                        </div>

                        <!-- Tips Upload -->
                        <div class="tips-section">
                            <h4>💡 Tips Foto yang Baik:</h4>
                            <ul class="tips-list">
                                <li>Pastikan pencahayaan cukup terang dan natural</li>
                                <li>Bersihkan ruangan sebelum memotret</li>
                                <li>Ambil foto dari berbagai sudut untuk memberikan gambaran lengkap</li>
                                <li>Hindari foto yang buram atau terlalu gelap</li>
                                <li>Tunjukkan detail-detail menarik dan fasilitas unggulan</li>
                                <li>Gunakan resolusi tinggi (minimal 1024x768 pixel)</li>
                            </ul>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="/owner/addaddress" class="btn btn-secondary">Kembali</a>
                            <a href="/owner/addavailability" class="btn btn-primary">Lanjutkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Store uploaded files for each category
        const uploadedFiles = {
            bedroom: [],
            bathroom: [],
            livingroom: [],
            kitchen: [],
            outdoor: [],
            facilities: []
        };

        // Maximum files for each category
        const maxFiles = {
            bedroom: 10,
            bathroom: 8,
            livingroom: 6,
            kitchen: 5,
            outdoor: 8,
            facilities: 10
        };

        // Minimum files for each category
        const minFiles = {
            bedroom: 3,
            bathroom: 2,
            livingroom: 0,
            kitchen: 0,
            outdoor: 0,
            facilities: 0
        };

        function triggerFileInput(category) {
            if (uploadedFiles[category].length >= maxFiles[category]) {
                alert(`Maksimal ${maxFiles[category]} foto untuk kategori ini`);
                return;
            }
            document.getElementById(category).click();
        }

        function handleFileUpload(input, gridId) {
            const files = Array.from(input.files);
            const category = input.id;
            const grid = document.getElementById(gridId);
            
            files.forEach(file => {
                if (uploadedFiles[category].length >= maxFiles[category]) {
                    alert(`Maksimal ${maxFiles[category]} foto untuk kategori ini`);
                    return;
                }

                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File ${file.name} terlalu besar. Maksimal 5MB per file.`);
                    return;
                }

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert(`File ${file.name} bukan gambar yang valid.`);
                    return;
                }

                uploadedFiles[category].push(file);
                addPhotoPreview(file, category, gridId);
            });

            updatePhotoCount(category);
            input.value = ''; // Reset input
        }

        function addPhotoPreview(file, category, gridId) {
            const grid = document.getElementById(gridId);
            const reader = new FileReader();

            reader.onload = function(e) {
                const photoDiv = document.createElement('div');
                photoDiv.className = 'photo-preview';
                photoDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button class="remove-btn" onclick="removePhoto(this, '${category}', '${file.name}')">×</button>
                `;

                // Insert before the upload box (last child)
                const uploadBox = grid.querySelector('.upload-box');
                grid.insertBefore(photoDiv, uploadBox);
            };

            reader.readAsDataURL(file);
        }

        function removePhoto(button, category, fileName) {
            // Remove from uploaded files array
            uploadedFiles[category] = uploadedFiles[category].filter(file => file.name !== fileName);
            
            // Remove preview element
            button.parentElement.remove();
            
            // Update photo count
            updatePhotoCount(category);
        }

        function updatePhotoCount(category) {
            const grid = document.getElementById(category + '-grid');
            const countElement = grid.parentElement.querySelector('.photo-count');
            const currentCount = uploadedFiles[category].length;
            const maxCount = maxFiles[category];
            const minCount = minFiles[category];
            
            let countText = `${currentCount}/${maxCount} foto`;
            if (minCount > 0) {
                countText += ` (Minimal ${minCount} foto)`;
            } else {
                countText += ' (Opsional)';
            }
            
            countElement.textContent = countText;
            
            // Change color based on requirement
            if (minCount > 0 && currentCount < minCount) {
                countElement.style.color = '#ef4444';
            } else {
                countElement.style.color = '#6b7280';
            }

            // Hide/show upload box based on max limit
            const uploadBox = grid.querySelector('.upload-box');
            if (currentCount >= maxCount) {
                uploadBox.style.display = 'none';
            } else {
                uploadBox.style.display = 'flex';
            }
        }

        // Form validation before submit
        document.querySelector('.homestay-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;
            let errors = [];

            // Check minimum requirements
            Object.keys(minFiles).forEach(category => {
                const minRequired = minFiles[category];
                const currentCount = uploadedFiles[category].length;
                
                if (minRequired > 0 && currentCount < minRequired) {
                    isValid = false;
                    const categoryNames = {
                        bedroom: 'Kamar Tidur',
                        bathroom: 'Kamar Mandi',
                        livingroom: 'Ruang Tamu',
                        kitchen: 'Dapur',
                        outdoor: 'Area Luar',
                        facilities: 'Fasilitas Tambahan'
                    };
                    errors.push(`${categoryNames[category]}: minimal ${minRequired} foto (saat ini ${currentCount})`);
                }
            });

            if (!isValid) {
                alert('Mohon lengkapi foto yang diperlukan:\n\n' + errors.join('\n'));
                return;
            }

            // If validation passes, proceed to next step
            alert('Foto berhasil diupload! Melanjutkan ke langkah berikutnya...');
            // Here you would typically submit the form or navigate to next step
        });
    </script>
</body>
</html>