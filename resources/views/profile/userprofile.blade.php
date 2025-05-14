<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - NAZMAINAP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/userprofile.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <x-header></x-header>
    <!-- Navigation -->

    <!-- Main Content -->
    <div class="profile-container">
        <div class="breadcrumb">
            Beranda <span class="mx-2">></span> Pengguna
        </div>
        
        <div class="profile-content">
            <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-menu">
            <a href="#" class="menu-item active">
                <i class="fas fa-user"></i> Profil
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-history"></i> Riwayat
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </div>
            
            <!-- Main Form Content -->
            <div class="main-content">
                <form action="#" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="Budi Santoso">
                            </div>
                            
                            <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="text" id="nohp" name="nohp" class="form-control" value="081566456456">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="budi@gmail.com">
                            </div>
                            
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control select">
                                    <option value="pengunjung" selected>Pengunjung</option>
                                    <option value="admin">Admin</option>
                                    <option value="moderator">Moderator</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3">Bantul, Yogyakarta</textarea>
                            </div>
                        </div>
                        
                        <!-- Right Column -->
                        <div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control select">
                                    <option value="diy" selected>DI Yogyakarta</option>
                                    <option value="jateng">Jawa Tengah</option>
                                    <option value="jabar">Jawa Barat</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select id="kabupaten" name="kabupaten" class="form-control select">
                                    <option value="bantul" selected>Bantul</option>
                                    <option value="sleman">Sleman</option>
                                    <option value="kulonprogo">Kulon Progo</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control select">
                                    <option value="kasihan" selected>Kasihan</option>
                                    <option value="sewon">Sewon</option>
                                    <option value="banguntapan">Banguntapan</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select">
                                    <option value="laki-laki" selected>Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control" value="*******">
                            </div>
                            
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Buttons -->
                    <div class="form-buttons">
                        <button type="reset" class="btn btn-reset">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>