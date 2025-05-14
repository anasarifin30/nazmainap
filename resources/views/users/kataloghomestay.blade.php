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
            @foreach($homestays as $homestay)
            <div class="card">
                <img src="{{ asset('storage/homestay_images/' . $homestay->image) }}" alt="{{ $homestay->name }}" />
                <div class="card-body">
                    <h3>{{ $homestay->name }}</h3>
                    <p>{{ $homestay->location }}</p>
                    <div class="tags">{{ $homestay->tags }}</div>
                    <div class="price-detail">
                        <div>
                            <p class="price">Rp{{ number_format($homestay->price, 0, ',', '.') }}</p>
                            <p class="stock">Sisa {{ $homestay->stock }} Kamar</p>
                        </div>
                        <a href="{{ route('homestays.show', $homestay->id) }}" class="btn-detail">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $homestays->links() }}
        </div>
    </section>
</div>

    <x-footer></x-footer>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });
        });
    </script>

</body>
</html>