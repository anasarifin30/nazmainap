<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Foto - NAZMAINAP</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Include custom CSS -->
    @vite(['resources/css/allphotohomestay.css'])
</head>
<!-- Header -->
<x-header></x-header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="back-button">
                Kembali
            </a>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Semua Foto {{ $homestay->name }}</h2>
        @forelse($categories as $category)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-3">{{ $category->name }}</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse($category->homestayPhotos as $photo)
                        <a href="{{ asset('storage/images-homestay/' . $photo->photo_path) }}" data-lightbox="homestay-gallery-{{ $category->id }}" data-title="{{ $category->name }}">
                            <img src="{{ asset('storage/images-homestay/' . $photo->photo_path) }}" alt="{{ $category->name }}" class="rounded-lg shadow-md w-full h-40 object-cover">
                        </a>
                    @empty
                        <div class="col-span-4 text-gray-400 italic">Tidak ada foto pada kategori ini.</div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="text-gray-500">Belum ada foto untuk homestay ini.</div>
        @endforelse

        
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>