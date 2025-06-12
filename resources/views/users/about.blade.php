<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Main Content */
        main {
            min-height: calc(100vh - 200px);
            padding: 4rem 0;
        }
        
        .about-section {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .about-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 700;
        }
        
        .about-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #666;
            margin-bottom: 1.5rem;
            text-align: justify;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .about-content p:last-child {
            margin-bottom: 0;
        }
        
        /* Values Section */
        .values-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        .value-card h3 {
            color: #667eea;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .value-card p {
            color: #666;
            text-align: center;
        }
        
        /* Footer Styles */
        x-footer {
            display: block;
            background: #2c3e50;
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }
        
        x-footer .container {
            text-align: center;
        }
        
        x-footer p {
            margin-bottom: 0.5rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .about-section {
                padding: 2rem 1rem;
            }
            
            .about-content h2 {
                font-size: 2rem;
            }
            
            .about-content p {
                font-size: 1rem;
                text-align: left;
            }
            
            x-header .container {
                flex-direction: column;
                gap: 1rem;
            }
            
            x-header nav ul {
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <x-header></x-header>

    <main>
        <div class="container">
            <section class="about-section">
                
                <div class="about-content">
                    <h2>Tentang Kami</h2>
                    
                    <p>
                        Mandhapa adalah sistem informasi penginapan berbasis web yang dirancang untuk memudahkan wisatawan dalam menemukan dan memesan penginapan lokal di desa secara praktis dan transparan. Kami hadir untuk menghubungkan wisatawan dengan pemilik penginapan desa, serta memberikan pengalaman menginap yang otentik dan berkesan.
                    </p>
                    
                    <p>
    Tujuan utama kami adalah memberdayakan masyarakat desa melalui digitalisasi layanan penginapan yang dikelola secara profesional. Mandhapa dikelola oleh tim yang berkolaborasi dengan Badan Usaha Milik Desa (BUMDes) dan pemilik penginapan lokal agar proses verifikasi, manajemen kamar, dan pemesanan dapat dilakukan dengan efisien dan terpercaya.
</p>

<p>
    Sistem ini juga dibangun dengan semangat inovasi dan pelayanan yang berfokus pada kenyamanan pengguna. Kami percaya bahwa teknologi dapat menjadi jembatan untuk membuka potensi lokal yang lebih luas, mendukung sektor pariwisata desa, dan menciptakan dampak positif bagi masyarakat.
</p>

<p>
    Terima kasih telah mempercayakan kebutuhan penginapan Anda kepada Mandhapa. Kami berkomitmen untuk terus mengembangkan layanan kami agar dapat menjadi solusi terbaik bagi semua pihak yang terlibat dalam ekosistem wisata desa.
</p>
                </div>
            </section>
            
            <div class="values-section">
                <div class="value-card">
                    <h3>Inovasi Digital</h3>
                    <p>Kami memanfaatkan teknologi untuk menyederhanakan proses pencarian, pemesanan, dan pengelolaan penginapan di desa.</p>
                </div>
                
                <div class="value-card">
                    <h3>Transparisasi</h3>
                    <p>Kami menjunjung tinggi kejujuran dan kemudahan akses informasi bagi wisatawan maupun pemilik penginapan.</p>
                </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer>
        <div class="container">
            <p>&copy; 2025 Perusahaan Kami. Semua hak dilindungi undang-undang.</p>
            <p>Alamat: Jl. Contoh No. 123, Kota, Provinsi 12345</p>
            <p>Email: info@perusahaan.com | Telepon: (021) 123-4567</p>
        </div>
    </x-footer>
</body>
</html>