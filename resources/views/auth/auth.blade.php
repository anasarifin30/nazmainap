<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar - NAZMAINAP</title>
    @vite(['resources/css/auth.css'])    
    <style>
        .tab-btn.active { background: #2D3072; color: #fff; }
        .tab-btn { background: #fff; color: #2D3072; border: 1px solid #2D3072; border-radius: 10px; padding: 0.5rem 1.5rem; margin: 0 4px; cursor: pointer; }
        .tab-btn:not(.active):hover { background: #2D3072; color: #fff; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .google-btn {
            background: #fff;
            color: #222;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
        }
        .google-btn:hover {
            background: #f7f7f7;
        }
        .google-icon {
            width: 22px;
            height: 22px;
        }
    </style>
</head>
<body>
    <x-header></x-header>
    <x-notif />
    <div class="login-page-center">
        <div class="login-card-container">
            <!-- Left Side -->
            <div class="left-side">
                <div class="illustration" id="illustration">
                    <img src="{{ asset('images/masuk-pengunjung.png') }}" alt="Ilustrasi">
                </div>
            </div>
            <!-- Right Side -->
            <div class="right-side">
                <div class="form-container">
                    <div class="flex justify-center mb-4" id="tabBtnGroup">
                        <button class="tab-btn active" data-tab="login-guest" data-type="login">Login Pengunjung</button>
                        <button class="tab-btn" data-tab="login-owner" data-type="login">Login Pemilik</button>
                        <button class="tab-btn" data-tab="register-guest" data-type="register">Daftar Pengunjung</button>
                        <button class="tab-btn" data-tab="register-owner" data-type="register">Daftar Pemilik</button>
                    </div>
                    <!-- Login Guest -->
                    <div class="tab-content active" id="login-guest">
                        <h1>Masuk Akun Pengunjung</h1>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login_role" value="guest">
                            <div class="form-group">
                                <label for="email_guest">Email</label>
                                <input type="email" id="email_guest" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                                <label for="password_guest">Kata Sandi</label>
                                <input type="password" id="password_guest" name="password" placeholder="Masukkan kata sandi" required>
                            </div>
                            <button type="submit" class="submit-btn">Masuk</button>
                        </form>
                        <div class="register-link mt-2">
                            Belum punya akun? <a href="#" onclick="switchTab('register-guest')">Daftar Pengunjung</a>
                        </div>
                    </div>
                    <!-- Login Owner -->
                    <div class="tab-content" id="login-owner">
                        <h1>Masuk Akun Pemilik</h1>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login_role" value="owner">
                            <div class="form-group">
                                <label for="email_owner">Email</label>
                                <input type="email" id="email_owner" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                                <label for="password_owner">Kata Sandi</label>
                                <input type="password" id="password_owner" name="password" placeholder="Masukkan kata sandi" required>
                            </div>
                            <button type="submit" class="submit-btn">Masuk</button>
                        </form>
                        <div class="register-link mt-2">
                            Belum punya akun? <a href="#" onclick="switchTab('register-owner')">Daftar Pemilik</a>
                        </div>
                    </div>
                    <!-- Register Guest -->
                    <div class="tab-content" id="register-guest">
                        <h1>Daftar Pengunjung</h1>
                        <form action="{{ route('register.guest.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_guest">Nama Lengkap</label>
                                <input type="text" id="nama_guest" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="email_guest_reg">Email</label>
                                <input type="email" id="email_guest_reg" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                                <label for="password_guest_reg">Kata Sandi</label>
                                <input type="password" id="password_guest_reg" name="password" placeholder="Masukkan kata sandi" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation_guest">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation_guest" name="password_confirmation" placeholder="Konfirmasi kata sandi" required>
                            </div>
                            <button type="submit" class="submit-btn">Daftar</button>
                        </form>
                        <div class="login-link mt-2">
                            Sudah punya akun? <a href="#" onclick="switchTab('login-guest')">Masuk Pengunjung</a>
                        </div>
                    </div>
                    <!-- Register Owner -->
                    <div class="tab-content" id="register-owner">
                        <h1>Daftar Pemilik Rumah</h1>
                        <form action="{{ route('register.owner.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_owner">Nama Lengkap</label>
                                <input type="text" id="nama_owner" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="email_owner_reg">Email</label>
                                <input type="email" id="email_owner_reg" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="form-group">
                                <label for="password_owner_reg">Kata Sandi</label>
                                <input type="password" id="password_owner_reg" name="password" placeholder="Masukkan kata sandi" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation_owner">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation_owner" name="password_confirmation" placeholder="Konfirmasi kata sandi" required>
                            </div>
                            <button type="submit" class="submit-btn">Daftar</button>
                        </form>
                        <div class="login-link mt-2">
                            Sudah punya akun? <a href="#" onclick="switchTab('login-owner')">Masuk Pemilik</a>
                        </div>
                    </div>
                    <div class="flex justify-center mb-3" id="googleBtnGroup">
                        {{-- Untuk tab owner --}}
                        <a href="{{ route('google.login', ['role' => 'owner']) }}" class="google-btn" id="google-btn-owner" style="display:none;">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="google-icon"> 
                            <span>Login dengan Google</span>
                        </a>

                        {{-- Untuk tab guest --}}
                        <a href="{{ route('google.login', ['role' => 'guest']) }}" class="google-btn" id="google-btn-guest" style="display:none;">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="google-icon"> 
                            <span>Login dengan Google</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
    <script>
        function updateTabButtons(tabId) {
            // Sembunyikan semua tombol
            document.querySelectorAll('.tab-btn').forEach(btn => btn.style.display = 'none');
            // Tampilkan tombol sesuai tipe tab
            if(tabId.startsWith('login')) {
                document.querySelectorAll('.tab-btn[data-type="login"]').forEach(btn => btn.style.display = '');
            } else {
                document.querySelectorAll('.tab-btn[data-type="register"]').forEach(btn => btn.style.display = '');
            }
        }

        function updateGoogleBtn(tabId) {
            // Sembunyikan semua tombol Google
            document.getElementById('google-btn-owner').style.display = 'none';
            document.getElementById('google-btn-guest').style.display = 'none';
            // Tampilkan sesuai tab aktif
            if(tabId.includes('owner')) {
                document.getElementById('google-btn-owner').style.display = 'flex';
            } else if(tabId.includes('guest')) {
                document.getElementById('google-btn-guest').style.display = 'flex';
            }
        }

        // Modifikasi switchTab agar update tombol juga
        function switchTab(tabId) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.tab === tabId);
            });
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.toggle('active', tab.id === tabId);
            });
            // Ganti ilustrasi sesuai tab
            const illus = document.getElementById('illustration').querySelector('img');
            if(tabId.includes('owner')) {
                illus.src = '{{ asset('images/masuk-pemilik-rumah.png') }}';
            } else {
                illus.src = '{{ asset('images/masuk-pengunjung.png') }}';
            }
            updateTabButtons(tabId);
            updateGoogleBtn(tabId);
        }

        // Tab button click
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                switchTab(this.dataset.tab);
            });
        });

        // Inisialisasi tombol saat load
        document.addEventListener('DOMContentLoaded', function() {
            updateTabButtons('login-guest');
            updateGoogleBtn('login-guest');
        });
    </script>
</body>
</html>