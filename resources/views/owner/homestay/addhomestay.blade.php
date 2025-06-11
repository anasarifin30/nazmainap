<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penginapan - Owner Dashboard</title>
    @vite(['resources/css/owner/homestay/addhomestay.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h2>Tambah Penginapan Baru</h2>
                <p>Lengkapi data penginapan Anda untuk mulai menerima tamu</p>
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
                        <span>Foto Penginapan</span>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <span>Ketersediaan</span>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="form-content">
                    <h3>Silakan lengkapi data penginapan</h3>
                    <p class="form-subtitle">Bantu calon tamu mengetahui penginapan yang akan Anda tawarkan.</p>

                    <form class="homestay-form">
                        <!-- Nama Penginapan -->
                        <div class="form-group">
                            <label for="nama-penginapan">Nama Penginapan</label>
                            <p class="form-hint">Berikan nama yang menarik dan mudah diingat untuk penginapan Anda</p>
                            <input type="text" id="nama-penginapan" name="nama-penginapan" placeholder="Masukkan nama penginapan Anda" required>
                        </div>

                        <!-- Deskripsi Penginapan -->
                        <div class="form-group">
                            <label for="deskripsi-penginapan">Deskripsi Penginapan</label>
                            <p class="form-hint">Ceritakan tentang penginapan Anda, fasilitas unggulan, dan hal menarik lainnya</p>
                            <textarea id="deskripsi-penginapan" name="deskripsi-penginapan" rows="5" placeholder="Deskripsi lengkap tentang penginapan Anda, lokasi strategis, fasilitas yang tersedia, dan keunggulan lainnya..." required></textarea>
                        </div>

                        <!-- Status Verifikasi -->
                        <div class="form-group">
                            <label>Status Verifikasi BUMDes</label>
                            <p class="form-hint">Status verifikasi penginapan dari BUMDes</p>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="terverifikasi" name="status-verifikasi" value="terverifikasi">
                                    <label for="terverifikasi">✅ Terverifikasi BUMDes</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="pending" name="status-verifikasi" value="pending" checked>
                                    <label for="pending">⏳ Menunggu Verifikasi</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="ditolak" name="status-verifikasi" value="ditolak">
                                    <label for="ditolak">❌ Ditolak</label>
                                </div>
                            </div>
                        </div>

                        <!-- Peraturan Penginapan -->
                        <div class="form-group">
                            <label>Peraturan Penginapan</label>
                            <p class="form-hint">Pilih peraturan yang berlaku di penginapan Anda</p>
                            <div class="checkbox-group-vertical">
                                <div class="checkbox-option">
                                    <input type="checkbox" id="checkin-time" name="peraturan" value="checkin-time">
                                    <label for="checkin-time">Check-in: 14:00 - 22:00, Check-out: 12:00</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="no-smoking" name="peraturan" value="no-smoking">
                                    <label for="no-smoking">Dilarang merokok di dalam kamar</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="no-pets" name="peraturan" value="no-pets">
                                    <label for="no-pets">Dilarang membawa hewan peliharaan</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="cleanliness" name="peraturan" value="cleanliness">
                                    <label for="cleanliness">Tamu wajib menjaga kebersihan</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="damage-fee" name="peraturan" value="damage-fee">
                                    <label for="damage-fee">Kerusakan fasilitas akan dikenakan denda</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="curfew" name="peraturan" value="curfew">
                                    <label for="curfew">Jam malam: 23:00 WIB</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="noise" name="peraturan" value="noise">
                                    <label for="noise">Tidak diperbolehkan membuat keributan</label>
                                </div>
                                <div class="checkbox-option">
                                    <input type="checkbox" id="visitors" name="peraturan" value="visitors">
                                    <label for="visitors">Tamu luar tidak diperbolehkan menginap</label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <a href="/owner/addaddress" class="btn btn-primary">Lanjutkan</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>