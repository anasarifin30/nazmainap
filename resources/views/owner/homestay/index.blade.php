<!-- filepath: c:\xampp\htdocs\nazmainap\resources\views\owner\homestay\index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Homestay - Mandhapa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/owner/sidebar-owner.css', 'resources/css/owner/homestay.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Include Sidebar -->
    <x-sidebar-owner active-menu="homestay" />

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <!-- Include Notification -->
        <x-notif />

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Homestay Header -->
        <div class="page-header">
            <div class="header-content">
                <h1>Kelola Homestay</h1>
                <p>Kelola properti dan kamar Anda dengan mudah</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('owner.homestay.create.step1') }}" class="btn-add-homestay">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Homestay
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="stats-overview">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $homestays->count() }}</h3>
                    <p>Total Homestay</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $homestays->where('status', 'terverifikasi')->count() }}</h3>
                    <p>Terverifikasi</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-bed"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ $homestays->sum('rooms_count') }}</h3>
                    <p>Total Kamar</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-details">
                    <h3>{{ number_format($homestays->avg('occupancy_rate'), 1) }}%</h3>
                    <p>Rata-rata Okupansi</p>
                </div>
            </div>
        </div>

        <!-- Homestay Cards -->
        @if($homestays->count() > 0)
            <div class="homestay-grid">
                @foreach($homestays as $homestay)
                    <div class="homestay-card" data-homestay-id="{{ $homestay->id }}">
                        <div class="homestay-header">
                            <img src="{{ $homestay->cover_photo }}" 
                                 alt="{{ $homestay->name }}"
                                 onerror="this.src='{{ asset('images/default-homestay.jpg') }}'">
                            <div class="homestay-status status-{{ $homestay->status_badge['class'] }}">
                                {{ $homestay->status_badge['text'] }}
                            </div>
                            @if($homestay->occupancy_rate > 0)
                                <div class="occupancy-badge">
                                    {{ number_format($homestay->occupancy_rate) }}% Okupansi
                                </div>
                            @endif
                        </div>
                        
                        <div class="homestay-info">
                            <h3>{{ $homestay->name }}</h3>
                            <p class="location">
                                <i class="fas fa-map-marker-alt"></i> 
                                {{ $homestay->kelurahan }}, {{ $homestay->kecamatan }}, {{ $homestay->kabupaten }}
                            </p>
                            
                            <div class="homestay-stats">
                                <div class="stat-item">
                                    <span class="label">Total Kamar</span>
                                    <span class="value">{{ $homestay->rooms_count }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="label">Tersedia</span>
                                    <span class="value">{{ $homestay->available_rooms_count }}</span>
                                </div>
                                @if($homestay->min_price > 0)
                                    <div class="stat-item price-info">
                                        <span class="label">Mulai dari</span>
                                        <span class="value">Rp {{ number_format($homestay->min_price, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Room Section -->
                            <div class="rooms-section">
                                <div class="section-header">
                                    <h4>Daftar Kamar ({{ $homestay->rooms_count }})</h4>
                                    <a href="{{ route('owner.homestay.rooms.create', $homestay->id) }}" 
                                       class="btn-add-room">
                                        <i class="fas fa-plus"></i>
                                        Tambah Kamar
                                    </a>
                                </div>

                                <div class="room-list">
                                    @forelse($homestay->rooms as $room)
                                        <div class="room-item">
                                            <div class="room-thumb">
                                                @if($room->roomPhotos->first())
                                                    <img src="{{ asset('storage/' . $room->roomPhotos->first()->photo_path) }}" 
                                                         alt="{{ $room->name }}">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="room-details">
                                                <h5>{{ $room->name }}</h5>
                                                <div class="room-meta">
                                                    <span><i class="fas fa-users"></i> {{ $room->max_guests }} Tamu</span>
                                                    <span><i class="fas fa-money-bill-wave"></i> Rp {{ number_format($room->price, 0, ',', '.') }}/malam</span>
                                                    <span><i class="fas fa-door-open"></i> {{ $room->total_rooms }} Unit</span>
                                                </div>
                                            </div>
                                            <div class="room-actions">
                                                <a href="{{ route('owner.homestay.rooms.edit', [$homestay->id, $room->id]) }}" 
                                                   class="btn-edit-room" title="Edit Kamar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn-delete-room" 
                                                        title="Hapus Kamar"
                                                        onclick="deleteRoom({{ $room->id }}, '{{ $room->name }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="empty-rooms">
                                            <i class="fas fa-bed"></i>
                                            <p>Belum ada kamar yang ditambahkan</p>
                                            <a href="{{ route('owner.homestay.rooms.create', $homestay->id) }}" 
                                               class="btn-add-first-room">
                                                Tambah Kamar Pertama
                                            </a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="homestay-actions">
                            <a href="{{ route('owner.homestay.show', $homestay->id) }}" 
                               class="btn-view">
                                <i class="fas fa-eye"></i>
                                Lihat Detail
                            </a>
                            <a href="{{ route('owner.homestay.edit', $homestay->id) }}" 
                               class="btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit Homestay
                            </a>
                            <button class="btn-delete" 
                                    onclick="deleteHomestay({{ $homestay->id }}, '{{ $homestay->name }}')">
                                <i class="fas fa-trash"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3>Belum Ada Homestay</h3>
                <p>Mulai menambahkan homestay pertama Anda untuk menerima tamu</p>
                <a href="{{ route('owner.homestay.create.step1') }}" class="btn-add-first">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Homestay Pertama
                </a>
            </div>
        @endif
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Konfirmasi Hapus</h4>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p id="deleteMessage"></p>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm-delete">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Same scripts as before -->
    <script>
        // Mobile sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            let sidebarOpen = false;
            
            function isMobile() {
                return window.innerWidth <= 768;
            }
            
            function toggleSidebar() {
                if (isMobile()) {
                    sidebarOpen = !sidebarOpen;
                    sidebar.classList.toggle('mobile-open', sidebarOpen);
                    sidebarOverlay.classList.toggle('active', sidebarOpen);
                    document.body.classList.toggle('mobile-sidebar-open', sidebarOpen);
                    
                    const icon = mobileMenuBtn.querySelector('i');
                    if (sidebarOpen) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }
        });

        // Delete functions
        function deleteHomestay(homestayId, homestayName) {
            const modal = document.getElementById('deleteModal');
            const message = document.getElementById('deleteMessage');
            const form = document.getElementById('deleteForm');
            
            message.innerHTML = `Apakah Anda yakin ingin menghapus homestay "<strong>${homestayName}</strong>"?<br><small>Tindakan ini akan menghapus semua kamar dan data terkait secara permanen.</small>`;
            form.action = `/owner/homestay/${homestayId}`;
            modal.style.display = 'block';
        }

        function deleteRoom(roomId, roomName) {
            const modal = document.getElementById('deleteModal');
            const message = document.getElementById('deleteMessage');
            const form = document.getElementById('deleteForm');
            
            message.innerHTML = `Apakah Anda yakin ingin menghapus kamar "<strong>${roomName}</strong>"?`;
            form.action = `/owner/homestay/rooms/${roomId}`;
            modal.style.display = 'block';
        }

        // Modal Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('deleteModal');
            const closeBtn = modal.querySelector('.close');
            const cancelBtn = modal.querySelector('.btn-cancel');

            closeBtn.onclick = function() {
                modal.style.display = 'none';
            }

            cancelBtn.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            // Auto hide alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });
        });

        // Smooth animations on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.homestay-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>