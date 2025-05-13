<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - NAZMAINAP</title>
    @vite(['resources/css/loginowner.css'])
</head>
<body>
    <x-notif></x-notif>

    <div class="container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="illustration">
                <img src="{{ asset('images/ilustrasi-register.png') }}" alt="Ilustrasi Registrasi">
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="form-container">
                <h1>Masuk Akun Anda</h1>
                
                <!-- User Type Selector -->
                <div class="user-type-selector">
                    <a href="{{ route('login.guest') }}" class="user-type-btn {{ request()->routeIs('login.guest') ? 'active' : '' }}">Pengunjung</a>
                    <a href="{{ route('login.owner') }}" class="user-type-btn {{ request()->routeIs('login.owner') ? 'active' : '' }}">Pemilik Rumah</a>
                </div>
                
                
                <!-- Login Form -->
                <form id="loginowner-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="login_role" value="owner">

                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                    </div>

                    <button type="submit" class="submit-btn">Masuk</button>
                </form>
                
                <!-- Register Link -->
                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register.owner') }}">Daftar</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script to handle user type selection
        document.getElementById('pemilik-btn').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('pengunjung-btn').classList.remove('active');
        });
        
        document.getElementById('pengunjung-btn').addEventListener('click', function() {
            this.classList.add('active');
            document.getElementById('pemilik-btn').classList.remove('active');
        });
    </script>
</body>
</html>