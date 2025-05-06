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
<body class="bg-gray-50">
    <!-- Header -->
    <x-header></x-header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Semua Foto</h2>
        <div class="photo-grid">
            <img src="https://images.unsplash.com/photo-1615571022219-eb45cf7faa9d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                 alt="Foto 1" class="photo-item">
            <img src="https://images.unsplash.com/photo-1590523741831-ab7e8b8f9c7f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" 
                 alt="Foto 2" class="photo-item">
            <img src="https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                 alt="Foto 3" class="photo-item">
            <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                 alt="Foto 4" class="photo-item">
            <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" 
                 alt="Foto 5" class="photo-item">
        </div>
        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="back-button">
                Kembali
            </a>
        </div>
    </main>

    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>