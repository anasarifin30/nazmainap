<!-- filepath: c:\xampp\htdocs\nazmainap\resources\views\owner\homestay\create-step2.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Homestay - Step 2</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    @vite(['resources/css/owner/sidebar-owner.css', 'resources/css/owner/homestay/create-steps.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        #map { height: 320px; border-radius: 12px; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1.5rem; }
    </style>
</head>
<body>
    <x-sidebar-owner active-menu="homestay" />
    <main class="main-content">
        <div class="page-header">
            <h1><i class="fas fa-map-marker-alt"></i> Tambah Homestay Baru</h1>
            <p>Langkah 2: Alamat Homestay</p>
        </div>
        <div class="form-container">
            <div class="progress-steps">
                <div class="step completed"><div class="step-number">1</div><span>Data Penginapan</span></div>
                <div class="step active"><div class="step-number">2</div><span>Alamat</span></div>
                <div class="step"><div class="step-number">3</div><span>Foto</span></div>
                <div class="step"><div class="step-number">4</div><span>Kamar & Selesai</span></div>
            </div>
            <form action="{{ route('owner.homestay.store.step2') }}" method="POST" class="homestay-form">
                @csrf
                <div class="section-card">
                    <div class="section-header">
                        <h3><i class="fas fa-map-marker-alt"></i> Cari alamat homestay di peta</h3>
                        <p>Posisikan pin untuk tampilkan alamat. Lengkapi dengan nomor rumah dan RT/RW jika belum ada.</p>
                    </div>
                    <!-- MAP -->
                    <div class="form-group">
                        <div id="map"></div>
                    </div>
                    <!-- ALAMAT -->
                    <div class="form-group">
                        <label for="address" class="required">Alamat</label>
                        <textarea id="address" name="address" class="form-control" rows="2" required>{{ old('address', session('homestay_step2.address')) }}</textarea>
                        <small class="form-hint">Alamat otomatis terisi dari peta, bisa diedit jika perlu.</small>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- WILAYAH -->
                    <div class="form-group">
                        <label for="provinsi" class="required">Provinsi</label>
                        <select id="provinsi" name="provinsi" class="form-control select" required>
                            <option value="">-- Pilih Provinsi --</option>
                        </select>
                        @error('provinsi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kabupaten" class="required">Kabupaten/Kota</label>
                        <select id="kabupaten" name="kabupaten" class="form-control select" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                        </select>
                        @error('kabupaten')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kecamatan" class="required">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="form-control select" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        @error('kecamatan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kelurahan" class="">Kelurahan/Desa</label>
                        <select id="kelurahan" name="kelurahan" class="form-control select">
                            <option value="">-- Pilih Kelurahan/Desa --</option>
                        </select>
                        @error('kelurahan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- CATATAN ALAMAT -->
                    <div class="form-group">
                        <label for="catatan_alamat">Catatan Alamat</label>
                        <textarea id="catatan_alamat" name="catatan_alamat" class="form-control" rows="2" placeholder="Deskripsi patokan agar homestay mudah ditemukan. (opsional)">{{ old('catatan_alamat', session('homestay_step2.catatan_alamat')) }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="{{ route('owner.homestay.create.step1') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Lanjutkan ke Foto
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Jangan lupa hidden input latitude & longitude di dalam form -->
    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', session('homestay_step2.latitude')) }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', session('homestay_step2.longitude')) }}">

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    @stack('scripts')

    <script>
    let defaultLat = {{ old('latitude', session('homestay_step2.latitude', '-7.801194')) }};
    let defaultLng = {{ old('longitude', session('homestay_step2.longitude', '110.364917')) }};
    let map = L.map('map').setView([defaultLat, defaultLng], 17);
    let marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);

    // Tile Layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Geocoder (search box)
    L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Masukkan nama lokasi/ area/ alamat'
    })
    .on('markgeocode', function(e) {
        let latlng = e.geocode.center;
        map.setView(latlng, 18);
        marker.setLatLng(latlng);
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        reverseGeocode(latlng.lat, latlng.lng);
    })
    .addTo(map);

    // Marker drag event
    marker.on('dragend', function(e) {
        let latlng = marker.getLatLng();
        document.getElementById('latitude').value = latlng.lat;
        document.getElementById('longitude').value = latlng.lng;
        reverseGeocode(latlng.lat, latlng.lng);
    });

    // Click on map to move marker
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
        reverseGeocode(e.latlng.lat, e.latlng.lng);
    });

    // Reverse geocode & auto-fill wilayah
    function reverseGeocode(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=id`)
            .then(res => res.json())
            .then(data => {
                if (data.display_name) {
                    document.getElementById('address').value = data.display_name;
                }
                const comp = data.address || {};
                if (comp.state) {
                    setSelectByText('provinsi', comp.state, function() {
                        let kab = comp.county || comp.city || comp.town || '';
                        if (kab) {
                            setSelectByText('kabupaten', kab, function() {
                                if (comp.district) {
                                    setSelectByText('kecamatan', comp.district, function() {
                                        let kel = comp.village || comp.suburb || comp.hamlet || '';
                                        if (kel) setSelectByText('kelurahan', kel);
                                    });
                                }
                            });
                        }
                    });
                }
            });
    }

    // Helper untuk set value select berdasarkan text, lalu jalankan callback jika ada
    function setSelectByText(selectId, text, callback) {
        const select = document.getElementById(selectId);
        if (!select) return;
        let found = false;
        for (let i = 0; i < select.options.length; i++) {
            if (select.options[i].text.toLowerCase().includes(text.toLowerCase())) {
                select.selectedIndex = i;
                select.dispatchEvent(new Event('change'));
                found = true;
                break;
            }
        }
        // Tambahkan log untuk debugging
        if (!found) console.log(`Tidak ditemukan: ${text} pada ${selectId}`);
        // Tambah delay agar data anak sudah pasti ter-load
        if (callback) setTimeout(callback, 1200);
    }

    // Provinsi
    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(res => res.json())
        .then(data => {
            let provinsiSelect = document.getElementById('provinsi');
            data.forEach(item => {
                provinsiSelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
            });
        });

    document.getElementById('provinsi').addEventListener('change', function () {
        let provName = this.value;
        let provId = '';
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(res => res.json())
            .then(data => {
                data.forEach(item => {
                    if (item.name == provName) provId = item.id;
                });
                let kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                document.getElementById('kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
                document.getElementById('kelurahan').innerHTML = '<option value="">-- Pilih Kelurahan/Desa --</option>';
                if (!provId) return;
                fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provId + '.json')
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(item => {
                            kabupatenSelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
                        });
                    });
            });
    });

    // Lanjutkan event listener kabupaten dan kecamatan seperti pola di atas...
    </script>
</body>
</html>