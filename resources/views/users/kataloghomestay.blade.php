<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAZMAINAP - Katalog Penginapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/kataloghomestay.css'])
</head>
<body>

    <!-- Header -->
    <x-header></x-header>

            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Lokasi penginapan">
                    <button>Cari</button>
                </div>
            </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Recommendations -->
        <h2>Katalog Penginapan di Pacitan</h2>
        
        <!-- Catalog -->
        <section class="catalog">
            <div class="catalog-grid">
                <div class="card">
                    <img src="images/hacienda.jpg" alt="Hacienda Watukarung" />
                    <div class="card-body">
                        <h3>Hacienda Watukarung</h3>
                        <p>Pacitan</p>
                        <div class="tags">WiFi &bull; Kamar &bull; Terverifikasi</div>
                        <div class="price-detail">
                            <div>
                                <p class="price">Rp200.000</p>
                                <p class="stock">Sisa 1 Kamar</p>
                            </div>
                            <a href="#" class="btn-detail">Detail</a>
                        </div>
                    </div>
                </div>
                
                <!-- Additional cards for demonstration -->
                <div class="card">
                    <img src="images/hacienda.jpg" alt="Villa Panorama" />
                    <div class="card-body">
                        <h3>Villa Panorama</h3>
                        <p>Pacitan</p>
                        <div class="tags">WiFi &bull; Kamar &bull; Pool</div>
                        <div class="price-detail">
                            <div>
                                <p class="price">Rp350.000</p>
                                <p class="stock">Sisa 3 Kamar</p>
                            </div>
                            <a href="#" class="btn-detail">Detail</a>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <img src="images/hacienda.jpg" alt="Pacitan Beach House" />
                    <div class="card-body">
                        <h3>Pacitan Beach House</h3>
                        <p>Pacitan</p>
                        <div class="tags">WiFi &bull; Dapur &bull; AC</div>
                        <div class="price-detail">
                            <div>
                                <p class="price">Rp275.000</p>
                                <p class="stock">Sisa 2 Kamar</p>
                            </div>
                            <a href="#" class="btn-detail">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <a href="#"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <span>...</span>
                <a href="#">8</a>
                <a href="#"><i class="fas fa-chevron-right"></i></a>
            </div>
        </section>
    </div>
</body>
</html>