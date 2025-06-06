<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - NAZMAINAP</title>
    @vite(['resources/css/registerowner.css'])
</head>
<body>
    <!-- Header -->
    <x-header></x-header>
    <x-notif></x-notif>

    <div class="login-page-center">
        <div class="register-owner-card">
            <!-- Left Side -->
            <div class="left-side">
                <div class="illustration">
                    <img src="{{ asset('images/daftar-pemilik-rumah.png') }}" alt="Ilustrasi Registrasi">
                </div>
            </div>

            <!-- Right Side -->
            <div class="right-side">
                <div class="form-container">
                    <h1>Buat Akun Anda</h1>
                    
                    <div class="user-type-selector">
                        <a href="{{ route('register.guest') }}" class="user-type-btn {{ request()->routeIs('register.guest') ? 'active' : '' }}">Pengunjung</a>
                        <a href="{{ route('register.owner') }}" class="user-type-btn {{ request()->routeIs('register.owner') ? 'active' : '' }}">Pemilik Rumah</a>
                    </div>
                    
                    <form id="register-form" action="register.php" method="POST">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="whatsapp">No HP/Whatsapp</label>
                            <input type="tel" id="whatsapp" name="whatsapp" placeholder="Masukkan nomor HP/Whatsapp" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm-password">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Konfirmasi kata sandi" required>
                        </div>
                        
                        <button type="submit" class="submit-btn">Buat Akun</button>
                    </form>
                    
                    <div class="login-link">
                        Apakah sudah punya akun? <a href="{{ route('login.owner') }}">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>