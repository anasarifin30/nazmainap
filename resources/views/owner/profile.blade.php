<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Owner - Mandhapa</title>
    @vite('resources/css/owner/profile.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
   <x-sidebar-owner />
    <!-- Main Content -->
    <main class="main-content">
        <div class="content-wrapper">
                <h1>Profil Saya</h1>
                <p>Kelola informasi profil Anda</p>
            </div>

            <div class="profile-container">
                <form method="POST" action="#" class="profile-form" enctype="multipart/form-data">
                    <div class="form-sections">
                        <!-- Personal Information Section -->
                        <div class="form-grid">
                            <div class="form-column">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">No HP</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Contoh: 08123456789">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Kata Sandi</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                                </div>
                            </div>

                            <div class="form-column">
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select id="gender" name="gender" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="province">Provinsi</label>
                                    <select id="province" name="province" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        <option value="SUMATERA UTARA">Sumatera Utara</option>
                                        <option value="JAKARTA">DKI Jakarta</option>
                                        <option value="JAWA BARAT">Jawa Barat</option>
                                        <option value="JAWA TENGAH">Jawa Tengah</option>
                                        <option value="JAWA TIMUR">Jawa Timur</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="district">Kabupaten</label>
                                    <select id="district" name="district" class="form-control">
                                        <option value="">Pilih Kabupaten</option>
                                        <option value="KABUPATEN NIAS">Kabupaten Nias</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="subdistrict">Kecamatan</label>
                                    <select id="subdistrict" name="subdistrict" class="form-control">
                                        <option value="">Pilih Kecamatan</option>
                                        <option value="IDANO GAWO">Idano Gawo</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="village">Kelurahan</label>
                                    <select id="village" name="village" class="form-control">
                                        <option value="">Pilih Kelurahan</option>
                                        <option value="BOBOZIOLI LOLOANAA">Bobozioli Loloanaa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Photo and Address Section -->
                        <div class="additional-info">
                            <h3><i class="fas fa-user-edit"></i> Informasi Tambahan</h3>
                            <div class="photo-address-grid">
                                <div class="form-group photo-upload">
                                    <label>Foto Profil</label>
                                    <div class="photo-preview-container">
                                        <div class="photo-placeholder" id="photoPlaceholder" onclick="document.getElementById('photo').click()">
                                            <i class="fas fa-camera"></i>
                                            <span>Pilih Foto</span>
                                        </div>
                                        <img id="photoPreview" src="#" alt="Preview" style="display: none;">
                                        <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(this)">
                                    </div>
                                </div>

                                <div class="form-group address-group">
                                    <label for="address">Alamat Lengkap</label>
                                    <textarea id="address" name="address" class="form-control address-textarea" rows="6" placeholder="Masukkan alamat lengkap Anda..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn-primary" onclick="submitForm(event)">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        function previewImage(input) {
            const preview = document.getElementById('photoPreview');
            const placeholder = document.getElementById('photoPlaceholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetForm() {
            const preview = document.getElementById('photoPreview');
            const placeholder = document.getElementById('photoPlaceholder');
            
            preview.style.display = 'none';
            placeholder.style.display = 'flex';
            
            // Reset all form controls
            document.querySelectorAll('.form-control, .address-textarea').forEach(input => {
                input.classList.remove('success');
            });
        }

        function submitForm(event) {
            event.preventDefault();
            
            // Add loading animation
            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                // Add success animation to all filled inputs
                document.querySelectorAll('.form-control, .address-textarea').forEach(input => {
                    if (input.value.trim() !== '') {
                        input.classList.add('success');
                    }
                });
                
                // Reset button
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Berhasil!';
                submitBtn.style.background = '#10b981';
                
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    submitBtn.style.background = '';
                }, 2000);
            }, 1500);
        }

        // Add real-time validation
        document.querySelectorAll('.form-control, .address-textarea').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.classList.add('success');
                } else {
                    this.classList.remove('success');
                }
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !sidebarToggle.contains(event.target) && 
                sidebar.classList.contains('open')) {
                sidebar.classList.remove('open');
            }
        });
    </script>
</body>
</html>