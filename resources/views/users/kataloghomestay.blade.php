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
            <form action="{{ route('users.kataloghomestay') }}" method="GET" class="search-form">
                <i class="fas fa-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Lokasi penginapan" value="{{ request('search') }}">
                <button type="submit" class="search-button">Cari</button>
            </form>
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
                <img src="{{ $homestay->image ? asset('storage/homestay_images/' . $homestay->image) : asset('storage/images-room/default-room.jpg') }}" alt="{{ $homestay->name }}" />
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
@if ($homestays->hasPages())
    <div class="flex justify-center mt-6">
        <nav class="inline-flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($homestays->onFirstPage())
                <span class="px-3 py-1 text-sm text-gray-400 bg-gray-200 rounded">«</span>
            @else
                <a href="{{ $homestays->previousPageUrl() }}" class="px-3 py-1 text-sm text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-100">«</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($homestays->getUrlRange(1, $homestays->lastPage()) as $page => $url)
                @if ($page == $homestays->currentPage())
                    <span class="px-3 py-1 text-sm text-white bg-blue-500 rounded">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1 text-sm text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-100">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($homestays->hasMorePages())
                <a href="{{ $homestays->nextPageUrl() }}" class="px-3 py-1 text-sm text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-100">»</a>
            @else
                <span class="px-3 py-1 text-sm text-gray-400 bg-gray-200 rounded">»</span>
            @endif
        </nav>
    </div>
@endif

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