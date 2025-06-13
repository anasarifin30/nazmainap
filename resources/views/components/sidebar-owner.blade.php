<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - {{ config('app.name') }}</title>
    @vite(['resources/css/owner/sidebar-owner.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    @props(['activeMenu' => 'dashboard'])

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="{{ asset('storage/logo/mandhapaputih.png') }}" alt="Mandhapa" class="logo-img">
            </div>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-chevron-left"></i>
            </button>
            <!-- Mini avatar untuk collapsed state -->
            <div class="mini-avatar" id="miniAvatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('owner.dashboard') }}" class="nav-link" data-tooltip="Dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu === 'homestay' ? 'active' : '' }}">
                    <a href="{{ route('owner.homestay') }}" class="nav-link" data-tooltip="Homestay">
                        <i class="fas fa-building"></i>
                        <span>Homestay</span>
                        @php
                            $homestayCount = Auth::user()->homestays ? Auth::user()->homestays->count() : 0;
                        @endphp
                        @if($homestayCount > 0)
                            <span class="nav-badge">{{ $homestayCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu === 'pemesanan' ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-tooltip="Pemesanan">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Pemesanan</span>
                        @php
                            $pendingBookings = 0;
                            if (Auth::user()->homestays) {
                                $pendingBookings = Auth::user()->homestays()
                                    ->withCount(['bookings' => function($query) {
                                        $query->whereIn('status', ['belum dibayar', 'menunggu']);
                                    }])
                                    ->get()
                                    ->sum('bookings_count');
                            }
                        @endphp
                        @if($pendingBookings > 0)
                            <span class="nav-badge pending">{{ $pendingBookings }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu === 'rooms' ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-tooltip="Kamar">
                        <i class="fas fa-bed"></i>
                        <span>Kamar</span>
                        @php
                            $totalRooms = 0;
                            if (Auth::user()->homestays) {
                                $totalRooms = Auth::user()->homestays()
                                    ->with('rooms')
                                    ->get()
                                    ->flatMap->rooms
                                    ->sum('total_rooms');
                            }
                        @endphp
                        @if($totalRooms > 0)
                            <span class="nav-badge rooms">{{ $totalRooms }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu === 'analytics' ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-tooltip="Analitik">
                        <i class="fas fa-chart-line"></i>
                        <span>Analitik</span>
                    </a>
                </li>
                <li class="nav-item {{ $activeMenu === 'settings' ? 'active' : '' }}">
                    <a href="#" class="nav-link" data-tooltip="Pengaturan">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
            
            <!-- Divider -->
            <div class="nav-divider"></div>
            
            <!-- Quick Stats - Hidden on mobile -->
            <div class="nav-stats">
                <div class="stat-item">
                    <div class="stat-icon revenue">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Pendapatan Bulan Ini</span>
                        @php
                            $monthlyRevenue = 0;
                            if (Auth::user()->homestays) {
                                $monthlyRevenue = Auth::user()->homestays()
                                    ->withSum(['bookings' => function($query) {
                                        $query->where('status', 'selesai')
                                              ->where('created_at', '>=', now()->startOfMonth());
                                    }], 'total_price')
                                    ->get()
                                    ->sum('bookings_sum_total_price') ?? 0;
                            }
                        @endphp
                        <span class="stat-value">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon bookings">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Booking Aktif</span>
                        @php
                            $activeBookings = 0;
                            if (Auth::user()->homestays) {
                                $activeBookings = Auth::user()->homestays()
                                    ->withCount(['bookings' => function($query) {
                                        $query->where('status', 'aktif')
                                              ->where('check_in', '<=', now())
                                              ->where('check_out', '>', now());
                                    }])
                                    ->get()
                                    ->sum('bookings_count');
                            }
                        @endphp
                        <span class="stat-value">{{ $activeBookings }}</span>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Updated Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar-container">
                    @if(Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="user-avatar-img">
                    @else
                        <div class="user-avatar-placeholder">
                            <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="online-indicator"></div>
                </div>
                
                <div class="user-info">
                    <div class="user-name">{{ Str::limit(Auth::user()->name, 15) }}</div>
                    <div class="user-role">
                        <i class="fas fa-crown"></i>
                        <span>Pemilik Homestay</span>
                    </div>
                    <div class="verification-status">
                        @if(Auth::user()->email_verified_at)
                            <div class="verified">
                                <i class="fas fa-check-circle"></i>
                                <span>Terverifikasi</span>
                            </div>
                        @else
                            <div class="unverified">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Belum Verifikasi</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="footer-actions">
                <button class="action-btn notification-btn" onclick="toggleNotifications()" title="Notifikasi">
                    <i class="fas fa-bell"></i>
                    @php
                        $totalNotifications = $pendingBookings + ($monthlyRevenue > 0 ? 1 : 0);
                    @endphp
                    @if($totalNotifications > 0)
                        <span class="notification-count">{{ $totalNotifications }}</span>
                    @endif
                </button>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="action-btn logout-btn" title="Keluar">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Notification Panel dengan Overlay -->
    <div class="notification-overlay" id="notificationOverlay"></div>

    <div class="notification-panel" id="notificationPanel">
        <div class="notification-header">
            <h4>
                <i class="fas fa-bell"></i>
                Notifikasi
            </h4>
            <button class="close-btn" onclick="toggleNotifications()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="notification-list">
            @if($pendingBookings > 0)
                <div class="notification-item important">
                    <div class="notification-icon">
                        <i class="fas fa-calendar-exclamation"></i>
                    </div>
                    <div class="notification-content">
                        <h5>Pemesanan Memerlukan Perhatian</h5>
                        <p>{{ $pendingBookings }} pemesanan baru menunggu konfirmasi dari Anda</p>
                        <time>{{ now()->format('H:i, d M Y') }}</time>
                    </div>
                </div>
            @endif
            
            @if($monthlyRevenue > 0)
                <div class="notification-item success">
                    <div class="notification-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="notification-content">
                        <h5>Laporan Pendapatan</h5>
                        <p>Total pendapatan bulan ini: Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                        <time>{{ now()->format('H:i, d M Y') }}</time>
                    </div>
                </div>
            @endif

            @php
                $recentBookings = 0;
                if (Auth::user()->homestays) {
                    $recentBookings = Auth::user()->homestays()
                        ->withCount(['bookings' => function($query) {
                            $query->where('created_at', '>=', now()->subDays(7));
                        }])
                        ->get()
                        ->sum('bookings_count');
                }
            @endphp

            @if($recentBookings > 0)
                <div class="notification-item">
                    <div class="notification-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="notification-content">
                        <h5>Aktivitas Pemesanan</h5>
                        <p>{{ $recentBookings }} pemesanan baru dalam 7 hari terakhir</p>
                        <time>{{ now()->format('H:i, d M Y') }}</time>
                    </div>
                </div>
            @endif
            
            @if($pendingBookings === 0 && $monthlyRevenue === 0 && $recentBookings === 0)
                <div class="notification-empty">
                    <i class="fas fa-bell-slash"></i>
                    <p>Tidak ada notifikasi terbaru</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Same JavaScript as before -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const mainContent = document.querySelector('.main-content');
            const miniAvatar = document.getElementById('miniAvatar');
            
            // State management
            let sidebarOpen = false;
            let sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            let notificationOpen = false;
            
            // Check if mobile
            function isMobile() {
                return window.innerWidth <= 768;
            }
            
            // Initialize sidebar state
            function initializeSidebar() {
                if (!isMobile() && sidebarCollapsed) {
                    sidebar.classList.add('collapsed');
                    if (mainContent) {
                        mainContent.classList.add('sidebar-collapsed');
                    }
                }
                
                // Show mobile menu button on mobile
                if (isMobile() && mobileMenuBtn) {
                    mobileMenuBtn.style.display = 'block';
                }
            }
            
            // Update sidebar state
            function updateSidebarState() {
                if (isMobile()) {
                    // Mobile behavior - Reset collapsed state
                    sidebar.classList.remove('collapsed');
                    sidebar.classList.toggle('mobile-open', sidebarOpen);
                    sidebarOverlay.classList.toggle('active', sidebarOpen);
                    document.body.classList.toggle('mobile-sidebar-open', sidebarOpen);
                    
                    if (mainContent) {
                        mainContent.classList.remove('sidebar-collapsed');
                    }
                    
                    // Show mobile menu button
                    if (mobileMenuBtn) {
                        mobileMenuBtn.style.display = 'block';
                    }
                } else {
                    // Desktop behavior
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                    document.body.classList.remove('mobile-sidebar-open');
                    sidebar.classList.toggle('collapsed', sidebarCollapsed);
                    
                    if (mainContent) {
                        mainContent.classList.toggle('sidebar-collapsed', sidebarCollapsed);
                    }
                    
                    // Hide mobile menu button
                    if (mobileMenuBtn) {
                        mobileMenuBtn.style.display = 'none';
                    }
                }
            }
            
            // Toggle sidebar function
            function toggleSidebar() {
                if (isMobile()) {
                    sidebarOpen = !sidebarOpen;
                    updateSidebarState();
                    
                    // Animate hamburger icon on mobile
                    if (mobileMenuBtn) {
                        const mobileIcon = mobileMenuBtn.querySelector('i');
                        if (sidebarOpen) {
                            mobileIcon.classList.remove('fa-bars');
                            mobileIcon.classList.add('fa-times');
                        } else {
                            mobileIcon.classList.remove('fa-times');
                            mobileIcon.classList.add('fa-bars');
                        }
                    }
                } else {
                    // Desktop toggle collapse
                    sidebarCollapsed = !sidebarCollapsed;
                    localStorage.setItem('sidebarCollapsed', sidebarCollapsed);
                    updateSidebarState();
                }
            }
            
            // Close sidebar on mobile
            function closeSidebar() {
                if (isMobile()) {
                    sidebarOpen = false;
                    updateSidebarState();
                    
                    // Reset hamburger icon
                    if (mobileMenuBtn) {
                        const mobileIcon = mobileMenuBtn.querySelector('i');
                        mobileIcon.classList.remove('fa-times');
                        mobileIcon.classList.add('fa-bars');
                    }
                }
            }
            
            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }
            
            // Mini avatar click to expand on desktop when collapsed
            if (miniAvatar) {
                miniAvatar.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (!isMobile() && sidebarCollapsed) {
                        toggleSidebar();
                    }
                });
            }
            
            // Close sidebar when overlay is clicked
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    closeSidebar();
                });
            }
            
            // Close sidebar when nav link is clicked on mobile
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (isMobile()) {
                        setTimeout(() => {
                            closeSidebar();
                        }, 150);
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                // Debounce resize event
                clearTimeout(window.resizeTimer);
                window.resizeTimer = setTimeout(() => {
                    const wasMobile = sidebar.classList.contains('mobile-open');
                    updateSidebarState();
                    
                    // If switching from mobile to desktop, close mobile sidebar
                    if (wasMobile && !isMobile()) {
                        sidebarOpen = false;
                        closeSidebar();
                    }
                }, 100);
            });
            
            // Close sidebar/notifications when clicking outside
            document.addEventListener('click', function(e) {
                // Close sidebar if clicked outside on mobile
                if (isMobile() && sidebarOpen && 
                    !sidebar.contains(e.target) && 
                    !sidebarToggle.contains(e.target) && 
                    !mobileMenuBtn.contains(e.target)) {
                    closeSidebar();
                }
                
                // Close notifications if clicked outside
                if (notificationOpen && 
                    !document.getElementById('notificationPanel').contains(e.target) && 
                    !e.target.closest('.notification-btn')) {
                    toggleNotifications();
                }
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (sidebarOpen) {
                        closeSidebar();
                    }
                    if (notificationOpen) {
                        toggleNotifications();
                    }
                }
                
                // Ctrl + B to toggle sidebar on desktop
                if (e.ctrlKey && e.key === 'b' && !isMobile()) {
                    e.preventDefault();
                    toggleSidebar();
                }
            });
            
            // Initialize
            initializeSidebar();
            updateSidebarState();
        });

        // Notification toggle function dengan overlay
        function toggleNotifications() {
            const panel = document.getElementById('notificationPanel');
            const overlay = document.getElementById('notificationOverlay');
            const isOpen = panel.classList.contains('open');
            
            if (isOpen) {
                panel.classList.remove('open');
                if (overlay) overlay.classList.remove('active');
                notificationOpen = false;
                document.body.style.overflow = '';
            } else {
                panel.classList.add('open');
                if (overlay) overlay.classList.add('active');
                notificationOpen = true;
                // Prevent body scroll on mobile when notification is open
                if (window.innerWidth <= 768) {
                    document.body.style.overflow = 'hidden';
                }
            }
        }
    </script>
</body>
</html>