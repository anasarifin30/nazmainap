<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Penginapan - Owner Dashboard</title>
    @vite(['resources/css/owner/homestay/addalamat.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h2>Alamat Penginapan</h2>
                <p>Tentukan lokasi penginapan Anda agar mudah ditemukan oleh tamu</p>
            </div>

            <div class="form-container">
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step completed">
                        <div class="step-number">✓</div>
                        <span>Data Penginapan</span>
                    </div>
                    <div class="step active">
                        <div class="step-number">2</div>
                        <span>Alamat</span>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <span>Foto Utama</span>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <span>Foto Kamar</span>
                    </div>
                    <div class="step">
                        <div class="step-number">5</div>
                        <span>Fasilitas</span>
                    </div>
                    <div class="step">
                        <div class="step-number">6</div>
                        <span>Ketersediaan</span>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="form-content">
                    <h3>Alamat Lengkap Penginapan</h3>
                    <p class="form-subtitle">Masukkan alamat yang akurat agar tamu dapat menemukan lokasi dengan mudah.</p>

                    <form class="homestay-form">
                        <!-- Alamat Lengkap -->
                        <div class="form-group">
                            <label for="alamat-lengkap">Alamat Lengkap</label>
                            <p class="form-hint">Contoh: Jl. Malioboro No. 123, RT 02/RW 05</p>
                            <textarea id="alamat-lengkap" name="alamat-lengkap" rows="3" placeholder="Masukkan alamat lengkap beserta nomor rumah, RT/RW" required></textarea>
                        </div>

                        <!-- Kelurahan/Desa -->
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan/Desa</label>
                            <input type="text" id="kelurahan" name="kelurahan" placeholder="Contoh: Sosromenduran" required>
                        </div>

                        <!-- Kecamatan -->
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="Banguntapan">Banguntapan</option>
                                <option value="Berbah">Berbah</option>
                                <option value="Depok">Depok</option>
                                <option value="Gamping">Gamping</option>
                                <option value="Godean">Godean</option>
                                <option value="Jetis">Jetis</option>
                                <option value="Kasihan">Kasihan</option>
                                <option value="Kretek">Kretek</option>
                                <option value="Mlati">Mlati</option>
                                <option value="Ngaglik">Ngaglik</option>
                                <option value="Ngemplak">Ngemplak</option>
                                <option value="Pajangan">Pajangan</option>
                                <option value="Pleret">Pleret</option>
                                <option value="Prambanan">Prambanan</option>
                                <option value="Sanden">Sanden</option>
                                <option value="Sedayu">Sedayu</option>
                                <option value="Sewon">Sewon</option>
                                <option value="Seyegan">Seyegan</option>
                                <option value="Sleman">Sleman</option>
                                <!-- Yogyakarta City -->
                                <option value="Danurejan">Danurejan</option>
                                <option value="Gedongtengen">Gedongtengen</option>
                                <option value="Gondokusuman">Gondokusuman</option>
                                <option value="Gondomanan">Gondomanan</option>
                                <option value="Jetis">Jetis</option>
                                <option value="Kotagede">Kotagede</option>
                                <option value="Kraton">Kraton</option>
                                <option value="Mantrijeron">Mantrijeron</option>
                                <option value="Mergangsan">Mergangsan</option>
                                <option value="Ngampilan">Ngampilan</option>
                                <option value="Pakualaman">Pakualaman</option>
                                <option value="Tegalrejo">Tegalrejo</option>
                                <option value="Umbulharjo">Umbulharjo</option>
                                <option value="Wirobrajan">Wirobrajan</option>
                            </select>
                        </div>

                        <!-- Kabupaten/Kota -->
                        <div class="form-group">
                            <label for="kabupaten">Kabupaten/Kota</label>
                            <select id="kabupaten" name="kabupaten" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                                <option value="Bantul">Kabupaten Bantul</option>
                                <option value="Gunungkidul">Kabupaten Gunungkidul</option>
                                <option value="Kulonprogo">Kabupaten Kulon Progo</option>
                                <option value="Sleman">Kabupaten Sleman</option>
                                <option value="Yogyakarta">Kota Yogyakarta</option>
                            </select>
                        </div>

                        <!-- Kode Pos -->
                        <div class="form-group">
                            <label for="kode-pos">Kode Pos</label>
                            <input type="text" id="kode-pos" name="kode-pos" placeholder="Contoh: 55271" maxlength="5" pattern="[0-9]{5}" required>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary">Kembali</button>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Get current location
        document.querySelector('.btn-location').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                    document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                    alert('Lokasi berhasil didapatkan!');
                }, function() {
                    alert('Tidak dapat mengakses lokasi. Pastikan Anda mengizinkan akses lokasi.');
                });
            } else {
                alert('Browser Anda tidak mendukung geolocation.');
            }
        });

        // Auto-update kecamatan based on kabupaten selection
        document.getElementById('kabupaten').addEventListener('change', function() {
            const kecamatanSelect = document.getElementById('kecamatan');
            const selectedKabupaten = this.value;
            
            // Clear current options
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            
            // Define kecamatan options for each kabupaten
            const kecamatanOptions = {
                'Yogyakarta': [
                    'Danurejan', 'Gedongtengen', 'Gondokusuman', 'Gondomanan', 
                    'Jetis', 'Kotagede', 'Kraton', 'Mantrijeron', 'Mergangsan', 
                    'Ngampilan', 'Pakualaman', 'Tegalrejo', 'Umbulharjo', 'Wirobrajan'
                ],
                'Sleman': [
                    'Berbah', 'Cangkringan', 'Depok', 'Gamping', 'Godean', 
                    'Kalasan', 'Minggir', 'Mlati', 'Moyudan', 'Ngaglik', 
                    'Ngemplak', 'Pakem', 'Prambanan', 'Seyegan', 'Sleman', 
                    'Tempel', 'Turi'
                ],
                'Bantul': [
                    'Bambanglipuro', 'Banguntapan', 'Bantul', 'Dlingo', 'Imogiri', 
                    'Jetis', 'Kasihan', 'Kretek', 'Pajangan', 'Pandak', 
                    'Piyungan', 'Pleret', 'Sanden', 'Sedayu', 'Sewon', 
                    'Srandakan', 'Ubud'
                ],
                'Gunungkidul': [
                    'Gedangsari', 'Girisubo', 'Karangmojo', 'Ngawen', 'Nglipar', 
                    'Patuk', 'Playen', 'Ponjong', 'Purwosari', 'Rongkop', 
                    'Semanu', 'Semin', 'Tanjungsari', 'Tepus', 'Wonosari'
                ],
                'Kulonprogo': [
                    'Galur', 'Girimulyo', 'Kalibawang', 'Kokap', 'Lendah', 
                    'Nanggulan', 'Pengasih', 'Panjatan', 'Samigaluh', 'Sentolo', 
                    'Temon', 'Wates'
                ]
            };
            
            if (kecamatanOptions[selectedKabupaten]) {
                kecamatanOptions[selectedKabupaten].forEach(kecamatan => {
                    const option = document.createElement('option');
                    option.value = kecamatan;
                    option.textContent = kecamatan;
                    kecamatanSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>