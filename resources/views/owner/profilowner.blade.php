<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Owner - Mandhapa</title>
    @vite(['resources/css/owner/profilowner.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-sidebar-owner />
    
    <main class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <h1>Profil Saya</h1>
                <p>Kelola informasi profil Anda</p>
            </div>

            <form method="POST" action="#" class="profile-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-sections">
                    <!-- Personal Information Section -->
                    <div class="form-grid">
                        <div class="form-column">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="phone">No HP</label>
                                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-column">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="province">Provinsi</label>
                                <select id="province" name="province" class="form-control">
                                    <option value="SUMATERA UTARA">SUMATERA UTARA</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="district">Kabupaten</label>
                                <select id="district" name="district" class="form-control">
                                    <option value="KABUPATEN NIAS">KABUPATEN NIAS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subdistrict">Kecamatan</label>
                                <select id="subdistrict" name="subdistrict" class="form-control">
                                    <option value="IDANO GAWO">IDANO GAWO</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="village">Kelurahan</label>
                                <select id="village" name="village" class="form-control">
                                    <option value="BOBOZIOLI LOLOANAA">BOBOZIOLI LOLOANAA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Photo and Address Section -->
                    <div class="additional-info">
                        <div class="photo-address-grid">
                            <div class="form-group photo-upload">
                                <label>Foto</label>
                                <div class="photo-preview-container">
                                    <div class="photo-placeholder" id="photoPlaceholder">
                                        <i class="fas fa-camera"></i>
                                        <span>Pilih Foto</span>
                                    </div>
                                    <img id="photoPreview" src="#" alt="Preview" style="display: none;">
                                    <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>

                            <div class="form-group address-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" class="form-control address-textarea" rows="3">{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn-secondary">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('photoPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>