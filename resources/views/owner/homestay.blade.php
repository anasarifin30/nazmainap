<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Homestay - Mandhapa</title>
    @vite(['resources/css/owner/homestay.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <x-sidebar-owner />
    <main class="main-content">
        <!-- Homestay Header -->
        <div class="page-header">
            <div class="header-content">
                <h1>Kelola Homestay</h1>
                <p>Kelola properti dan kamar Anda dengan mudah</p>
            </div>
            <div class="header-actions">
                <button class="btn-add-homestay" onclick="addHomestay()">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Homestay
                </button>
            </div>
        </div>

        <!-- Homestay Cards -->
        <div class="homestay-grid">
            <!-- Existing Homestay Card -->
            <div class="homestay-card">
                <div class="homestay-header">
                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Homestay Asri">
                    <div class="homestay-status">Aktif</div>
                </div>
                
                <div class="homestay-info">
                    <h3>Homestay Asri</h3>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> Jl. Pantai Sorake No. 123, Nias</p>
                    
                    <div class="homestay-stats">
                        <div class="stat-item">
                            <span class="label">Total Kamar</span>
                            <span class="value">5</span>
                        </div>
                        <div class="stat-item">
                            <span class="label">Tersedia</span>
                            <span class="value">3</span>
                        </div>
                    </div>

                    <!-- Room Section -->
                    <div class="rooms-section">
                        <div class="section-header">
                            <h4>Daftar Kamar</h4>
                            <button class="btn-add-room" onclick="addRoom()">
                                <i class="fas fa-plus"></i>
                                Tambah Kamar
                            </button>
                        </div>

                        <div class="room-list">
                            <!-- Room Item -->
                            <div class="room-item">
                                <div class="room-thumb">
                                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kamar Deluxe">
                                </div>
                                <div class="room-details">
                                    <h5>Kamar Deluxe</h5>
                                    <div class="room-meta">
                                        <span><i class="fas fa-bed"></i> 2 Tamu</span>
                                        <span><i class="fas fa-money-bill-wave"></i> Rp 500.000/malam</span>
                                    </div>
                                </div>
                                <div class="room-actions">
                                    <button class="btn-edit-room" title="Edit Kamar" onclick="editRoom()">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-delete-room" title="Hapus Kamar" onclick="deleteRoom()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="room-item">
                                <div class="room-thumb">
                                    <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kamar Standard">
                                </div>
                                <div class="room-details">
                                    <h5>Kamar Standard</h5>
                                    <div class="room-meta">
                                        <span><i class="fas fa-bed"></i> 1 Tamu</span>
                                        <span><i class="fas fa-money-bill-wave"></i> Rp 300.000/malam</span>
                                    </div>
                                </div>
                                <div class="room-actions">
                                    <button class="btn-edit-room" title="Edit Kamar" onclick="editRoom()">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-delete-room" title="Hapus Kamar" onclick="deleteRoom()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="homestay-actions">
                    <button class="btn-edit" onclick="editHomestay()">
                        <i class="fas fa-edit"></i>
                        Edit Homestay
                    </button>
                    <button class="btn-delete" onclick="deleteHomestay()">
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>

            <!-- Additional Homestay Card -->
            <div class="homestay-card" style="animation-delay: 0.2s;">
                <div class="homestay-header">
                    <img src="https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Villa Pantai">
                    <div class="homestay-status">Aktif</div>
                </div>
                
                <div class="homestay-info">
                    <h3>Villa Pantai Indah</h3>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> Jl. Pantai Lagundri No. 45, Nias</p>
                    
                    <div class="homestay-stats">
                        <div class="stat-item">
                            <span class="label">Total Kamar</span>
                            <span class="value">8</span>
                        </div>
                        <div class="stat-item">
                            <span class="label">Tersedia</span>
                            <span class="value">5</span>
                        </div>
                    </div>

                    <div class="rooms-section">
                        <div class="section-header">
                            <h4>Daftar Kamar</h4>
                            <button class="btn-add-room" onclick="addRoom()">
                                <i class="fas fa-plus"></i>
                                Tambah Kamar
                            </button>
                        </div>

                        <div class="room-list">
                            <div class="room-item">
                                <div class="room-thumb">
                                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Suite Premium">
                                </div>
                                <div class="room-details">
                                    <h5>Suite Premium</h5>
                                    <div class="room-meta">
                                        <span><i class="fas fa-bed"></i> 4 Tamu</span>
                                        <span><i class="fas fa-money-bill-wave"></i> Rp 1.200.000/malam</span>
                                    </div>
                                </div>
                                <div class="room-actions">
                                    <button class="btn-edit-room" title="Edit Kamar" onclick="editRoom()">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn-delete-room" title="Hapus Kamar" onclick="deleteRoom()">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="homestay-actions">
                    <button class="btn-edit" onclick="editHomestay()">
                        <i class="fas fa-edit"></i>
                        Edit Homestay
                    </button>
                    <button class="btn-delete" onclick="deleteHomestay()">
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Interactive Functions
        function addHomestay() {
            alert('Fitur Tambah Homestay akan segera tersedia!');
        }

        function addRoom() {
            alert('Fitur Tambah Kamar akan segera tersedia!');
        }

        function editHomestay() {
            alert('Fitur Edit Homestay akan segera tersedia!');
        }

        function editRoom() {
            alert('Fitur Edit Kamar akan segera tersedia!');
        }

        function deleteHomestay() {
            if (confirm('Apakah Anda yakin ingin menghapus homestay ini?')) {
                alert('Homestay berhasil dihapus!');
            }
        }

        function deleteRoom() {
            if (confirm('Apakah Anda yakin ingin menghapus kamar ini?')) {
                alert('Kamar berhasil dihapus!');
            }
        }

        // Smooth animations on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.homestay-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
            });
        });

        // Mobile sidebar toggle (if needed)
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0px)' ? 'translateX(-100%)' : 'translateX(0px)';
        }
    </script>
</body>
</html>