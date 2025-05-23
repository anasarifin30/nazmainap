<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - NAZMAINAP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/userprofile.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <x-header></x-header>

    <div class="profile-container">
        <div class="breadcrumb">
            Beranda <span class="mx-2">></span> Pengguna
        </div>
        
        <div class="profile-content">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <a href="{{ route('users.profile') }}" class="menu-item active">
                        <i class="fas fa-user"></i> Profil
                    </a>
                    <a href="{{ route('users.historycart') }}" class="menu-item">
                        <i class="fas fa-history"></i> Riwayat
                    </a>
                    <a href="{{ route('logout') }}" class="menu-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
            
            <!-- Main Form Content -->
            <div class="main-content">
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="nohp">No HP</label>
                                <input type="text" id="nohp" name="nohp" class="form-control" value="{{ old('nohp', $user->nomorhp) }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <div class="avatar-upload">
                                    <div class="avatar-preview cursor-pointer w-24 h-24 rounded-full border border-gray-300 flex items-center justify-center overflow-hidden bg-gray-100" id="avatarPreview">
                                        @if ($user->foto)
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" id="fotoPreviewImg" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-camera text-4xl text-gray-400" id="cameraIcon"></i>
                                        @endif
                                    </div>
                                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="previewFoto(event)">
                                </div>
                            </div>
                            
                        </div>
                        
                        <!-- Right Column -->
                        <div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select">
                                    <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" name="provinsi" class="form-control select">
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select id="kabupaten" name="kabupaten" class="form-control select">
                                    <option value="">-- Pilih Kabupaten --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan" class="form-control select">
                                    <option value="">-- Pilih Kecamatan --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kelurahan">Kelurahan</label>
                                <select id="kelurahan" name="kelurahan" class="form-control select">
                                    <option value="">-- Pilih Kelurahan --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" class="form-control" rows="3">{{ old('alamat', $user->address) }}</textarea>
                            </div>
                            
                        </div>
                    </div>
                    <input type="hidden" name="provinsi_nama" id="provinsi_nama">
                    <input type="hidden" name="kabupaten_nama" id="kabupaten_nama">
                    <input type="hidden" name="kecamatan_nama" id="kecamatan_nama">
                    <input type="hidden" name="kelurahan_nama" id="kelurahan_nama">
                    <!-- Form Buttons -->
                    <div class="form-buttons mt-4">
                        <button type="reset" class="btn btn-reset" onclick="window.location.reload(); return false;">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const avatarPreview = document.getElementById('avatarPreview');
            const inputFile = document.getElementById('foto');

            avatarPreview.addEventListener('click', () => {
                inputFile.click(); // trigger upload
            });
        

        function previewFoto(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('avatarPreview');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Foto Profil" id="fotoPreviewImg" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `<i class="fas fa-camera text-4xl text-gray-400"></i>`;
            }
        }
  
    // --- AUTO SELECT WILAYAH SAAT HALAMAN DIMUAT ---
    // 1. Provinsi
    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(res => res.json())
        .then(data => {
            let provinsiSelect = document.getElementById('provinsi');
            let selectedProvId = '';
            data.forEach(item => {
                let selected = '';
                if (item.name == "{{ $user->provinsi }}") {
                    selected = 'selected';
                    selectedProvId = item.id;
                }
                provinsiSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
            });
            if (selectedProvId) {
                provinsiSelect.value = selectedProvId;
                provinsiSelect.dispatchEvent(new Event('change'));
            }
        });

    // 2. Kabupaten
    document.getElementById('provinsi').addEventListener('change', function () {
        let provId = this.value;
        let kabupatenSelect = document.getElementById('kabupaten');
        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
        document.getElementById('kecamatan').innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        document.getElementById('kelurahan').innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (!provId) return;
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provId + '.json')
            .then(res => res.json())
            .then(data => {
                let selectedKabId = '';
                data.forEach(item => {
                    let selected = '';
                    if (item.name == "{{ $user->kabupaten }}") {
                        selected = 'selected';
                        selectedKabId = item.id;
                    }
                    kabupatenSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
                if (selectedKabId) {
                    kabupatenSelect.value = selectedKabId;
                    kabupatenSelect.dispatchEvent(new Event('change'));
                }
            });
    });

    // 3. Kecamatan
    document.getElementById('kabupaten').addEventListener('change', function () {
        let kabId = this.value;
        let kecamatanSelect = document.getElementById('kecamatan');
        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        document.getElementById('kelurahan').innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (!kabId) return;
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + kabId + '.json')
            .then(res => res.json())
            .then(data => {
                let selectedKecId = '';
                data.forEach(item => {
                    let selected = '';
                    if (item.name == "{{ $user->kecamatan }}") {
                        selected = 'selected';
                        selectedKecId = item.id;
                    }
                    kecamatanSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
                if (selectedKecId) {
                    kecamatanSelect.value = selectedKecId;
                    kecamatanSelect.dispatchEvent(new Event('change'));
                }
            });
    });

    // 4. Kelurahan
    document.getElementById('kecamatan').addEventListener('change', function () {
        let kecId = this.value;
        let kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
        if (!kecId) return;
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + kecId + '.json')
        .then(res => res.json())
        .then(data => {
            let selectedKelId = '';
            data.forEach(item => {
                let selected = '';
                if (item.name == "{{ $user->kelurahan }}") {
                    selected = 'selected';
                    selectedKelId = item.id;
                }
                kelurahanSelect.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
            });
            if (selectedKelId) {
                kelurahanSelect.value = selectedKelId;
            }
        });
    });

    function setWilayahNama() {
    let prov = document.getElementById('provinsi');
    let kab = document.getElementById('kabupaten');
    let kec = document.getElementById('kecamatan');
    let kel = document.getElementById('kelurahan');
    document.getElementById('provinsi_nama').value = prov.options[prov.selectedIndex]?.text || '';
    document.getElementById('kabupaten_nama').value = kab.options[kab.selectedIndex]?.text || '';
    document.getElementById('kecamatan_nama').value = kec.options[kec.selectedIndex]?.text || '';
    document.getElementById('kelurahan_nama').value = kel.options[kel.selectedIndex]?.text || '';
}

// Update setiap kali dropdown berubah
['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'].forEach(id => {
    document.getElementById(id).addEventListener('change', setWilayahNama);
});

// Set saat submit form
document.querySelector('form').addEventListener('submit', setWilayahNama);
});   
    </script>
</body>
</html>