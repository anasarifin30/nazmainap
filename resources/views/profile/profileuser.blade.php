<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - User Profile</title>
    @vite(['resources/css/profileuser.css'])
</head>
<body>

    <div class="breadcrumb">
        <a href="#">Beranda</a>
        <span>›</span>
        <a href="#">Pengguna</a>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="#" class="menu-item active">Profil</a>
            <a href="#" class="menu-item">Riwayat</a>
            <a href="#" class="menu-item">Keluar</a>
            
            <div class="logo-container">
                NAZMAINAP
            </div>
        </div>

        <div class="content">
            <form>
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" value="Budi Santoso">
                </div>

                <div class="form-group">
                    <label class="form-label">No Hp</label>
                    <input type="tel" class="form-control" value="081568415696">
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="budi@gmail.com">
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <input type="text" class="form-control" value="Pengunjung" readonly>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" value="Bantul, Yogyakarta">
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="dropdown">
                        <div class="dropdown-select">
                            <span>Laki-laki</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control password-field" value="********">
                </div>

                <div class="form-group">
                    <label class="form-label">Foto</label>
                    <div class="photo-upload"></div>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>