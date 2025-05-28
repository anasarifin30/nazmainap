@if (session('success') || session('error') || $message)
    <div class="alert-wrapper" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        <div class="alert alert-{{ $type ?? (session('error') ? 'error' : 'success') }}" 
             role="alert"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2">
            
            <i class="bx {{ session('error') ? 'bx-x-circle' : 'bx-check-circle' }}"></i>
            <div>
                <h3 class="font-medium">{{ session('error') ? 'Gagal!' : 'Berhasil!' }}</h3>
                <p>{{ $message ?? session('success') ?? session('error') }}</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => {
                        alert.parentElement.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
@endif