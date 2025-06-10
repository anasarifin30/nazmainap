<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Homestay - Mandhapa</title>
    @vite(['resources/css/owner/homestay/addhomestay.css'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Sidebar -->
    @include('components.sidebar-owner')
    
    <main class="main-content">
        <div class="page-header">
            <div class="header-content">
                <h1>Tambahkan Homestay</h1>
                <p>Yuk, bantu calon penyewa mengetahui homestay yang akan Anda sewakan.</p>
            </div>
        </div>

        <div class="form-container">
            <form action="/owner/homestay/store" method="POST" enctype="multipart/form-data">
                <div class="form-section">
                    <h2>Data Homestay</h2>
                    
                    <div class="form-group">
                        <label for="nama">Nama Homestay</label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: Kos Spasi">
                        <small>Saran: Kos (spasi) Nama Kos, Tanpa Nama Kecamatan dan Kota</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Homestay</label>
                        <div class="file-upload">
                            <input type="file" id="foto" name="foto[]" multiple accept="image/*">
                            <label for="foto" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Pilih foto atau seret ke sini</span>
                            </label>
                        </div>
                        <div id="preview" class="preview-container"></div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Informasi Tambahan</h2>
                    
                    <div class="form-group">
                        <label>Tipe Kamar</label>
                        <div class="checkbox-group">
                            <label class="checkbox">
                                <input type="checkbox" name="multiple_rooms">
                                <span>Homestay ini punya lebih dari 1 tipe kamar</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Disewakan Untuk</label>
                        <div class="radio-group">
                            <label class="radio">
                                <input type="radio" name="gender" value="putra">
                                <span>Putra</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="gender" value="putri">
                                <span>Putri</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="gender" value="campur">
                                <span>Campur</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary" onclick="window.location.href='/owner/homestay'">Kembali</button>
                    <button type="submit" class="btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>