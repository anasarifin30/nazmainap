<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - NAZMAINAP</title>
    @vite(['resources/css/loginowner.css'])
</head>
<body>
    
    <div class="container">
        <!-- Left Side -->
        <div class="left-side">
            <div class="illustration">
                <img src="images/ilustrasi-register.png" alt="Ilustrasi Registrasi">
            </div>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <div class="form-container">
                <h1>Masuk Akun Anda</h1>
                
                <!-- User Type Selector -->
                <div class="user-type-selector">
                    <button class="user-type-btn active" id="pengunjung-btn">Pengunjung</button>
                    <button class="user-type-btn" id="pemilik-btn">Pemilik Rumah</button>
                </div>
                
                <!-- Login Form -->
                <form id="loginowner-form" action="loginowner.php" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    
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
                    Apakah sudah punya akun? <a href="register.html">Masuk</a>
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