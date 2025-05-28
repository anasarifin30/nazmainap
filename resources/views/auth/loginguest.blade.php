<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Guest</title>
    @vite(['resources/css/loginguest.css'])
</head>
<body>
    <x-header></x-header>
    <x-notif></x-notif>

    <div class="login-page-center">
        <div class="login-card-container">
            <!-- Left Side -->
            <div class="left-side">
                <div class="illustration">
                    <img src="{{ asset('images/masuk-pengunjung.png') }}" alt="Ilustrasi Registrasi">
                </div>
            </div>
            <!-- Right Side -->
            <div class="right-side">
                <div class="form-container">
                    <h1>Masuk Akun Anda</h1>
                    <div class="user-type-selector">
                        <a href="{{ route('login.guest') }}" class="user-type-btn {{ request()->routeIs('login.guest') ? 'active' : '' }}">Pengunjung</a>
                        <a href="{{ route('login.owner') }}" class="user-type-btn {{ request()->routeIs('login.owner') ? 'active' : '' }}">Pemilik Rumah</a>
                    </div>
                    <form id="loginguest-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <input type="hidden" name="login_role" value="guest">
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
                    <div class="register-link">
                        Belum punya akun? <a href="{{ route('register.guest') }}">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>