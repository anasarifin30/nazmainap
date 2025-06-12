<!DOCTYPE html>
<html lang="id">
     @vite(['resources/css/footer.css'])
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
<body>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- Punya Rumah Kosong -->
            <div class="footer-content">
                <div class="footer-cta">
                    <h3 class="footer-heading">Punya rumah kosong atau kamar tersedia?</h3>
                    <button class="register-btn">Daftarkan sekarang</button>
                </div>
            </div>

            <!-- Kontak Kami -->
            <div class="footer-contact">
                <h3 class="footer-heading">Kontak Kami</h3>
                <div class="social-links">
                    <!-- Email icon -->
                    <a href="#" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                        </svg>
                    </a>
                    <!-- Instagram icon -->
                    <a href="#" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <!-- Facebook icon -->
                    <a href="#" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.675 12.001c0-5.901-4.774-10.675-10.675-10.675S1.325 6.1 1.325 12c0 5.3 3.861 9.685 8.893 10.571v-7.47H7.077v-3.1h3.141V9.845c0-3.1 1.866-4.805 4.683-4.805 1.357 0 2.774.242 2.774.242v3.049h-1.563c-1.539 0-2.016.956-2.016 1.937v2.325h3.429l-.548 3.1h-2.881v7.47c5.031-.886 8.892-5.271 8.892-10.572z"/>
                        </svg>
                    </a>

                    <!-- LinkedIn icon -->
                    <a href="#" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zm-46.44-341a53.52 53.52 0 1 1 53.52-53.52 53.5 53.5 0 0 1-53.52 53.52zM447.9 448h-92.4V302.4c0-34.7-12.5-58.4-43.6-58.4-23.8 0-38 16-44.3 31.4-2.3 5.6-2.8 13.3-2.8 21.1V448h-92.6s1.2-263.4 0-290.1h92.6v41.1c-.2.3-.5.7-.7 1h.7v-1c12.3-18.9 34.2-45.9 83.2-45.9 60.8 0 106.5 39.7 106.5 125.1V448z"/>
                        </svg>
                    </a>

                    <!-- Youtube icon -->
                    <a href="#" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 576 512">
                            <path d="M549.7 124.1c-6.3-24-25.1-42.7-49.1-49.1C456.5 64 288 64 288 64S119.5 64 75.4 75c-24 6.3-42.8 25.1-49.1 49.1C16 168.2 16 256 16 256s0 87.8 10.3 131.9c6.3 24 25.1 42.7 49.1 49.1 44.1 11 212.6 11 212.6 11s168.5 0 212.6-11c24-6.3 42.8-25.1 49.1-49.1C560 343.8 560 256 560 256s0-87.8-10.3-131.9zM232 336V176l142.7 80L232 336z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Garis Putih -->
            <div class="footer-divider"></div>

            <!-- Copyright -->
            <div class="copyright">
                <div class="copyright-text">
                    Copyright 2025 - Develop by Nazma Office
                </div>
                <div class="footer-links">
                    <a href="/about">Tentang Kami</a>
                    <a href="/terms">Syarat dan Ketentuan</a>
                    <a href="/privacy">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>