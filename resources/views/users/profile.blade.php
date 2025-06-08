<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - NAZMAINAP</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/profile.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
</head>
<body>
    <x-header></x-header>

    <div class="profile-container">

        <div class="profile-content">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <a href="{{ route('users.profile') }}" class="menu-item{{ request()->routeIs('users.profile') ? ' active' : '' }}">
                        <i class="fas fa-user"></i> Profil
                    </a>
                    <a href="{{ route('users.historycart') }}" class="menu-item{{ request()->routeIs('users.historycart') ? ' active' : '' }}">
                        <i class="fas fa-history"></i> Riwayat
                    </a>
                    <a href="{{ route('logout') }}" class="menu-item logout"
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
                @if(session('show_required_fields'))
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <form id="profileForm" action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <div class="form-group">
                                <label for="nama">
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       class="form-control {{ empty($user->name) ? 'border-red-300 bg-red-50' : '' }}" 
                                       value="{{ old('nama', $user->name) }}"
                                       required>
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
                                <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">
                                    Foto Profil <span class="required-field"></span>
                                </label>
                                <div class="avatar-upload flex flex-col items-center gap-2">
                                    <div
                                        id="avatarPreview"
                                        class="avatar-preview cursor-pointer rounded-full border-2 shadow-sm bg-gray-100 flex items-center justify-center overflow-hidden relative
                                            {{ empty($user->foto) ? 'border-red-300' : 'border-green-300' }}"
                                        style="width: 110px; height: 110px;"
                                        title="Klik untuk ganti foto"
                                    >
                                        @if ($user->foto)
                                            @php
                                                // Cek apakah foto adalah URL (Google) atau file di storage lokal
                                                $foto = filter_var($user->foto, FILTER_VALIDATE_URL)
                                                    ? $user->foto
                                                    : asset('storage/' . $user->foto);
                                            @endphp
                                            <img src="{{ $foto }}" alt="Foto Profil" id="fotoPreviewImg" class="w-full h-full object-cover">
                                        @else
                                            <div class="flex flex-col items-center justify-center h-full">
                                                <i class="fas fa-camera text-4xl text-gray-400"></i>
                                            </div>
                                        @endif
                                        <span class="absolute bottom-2 right-2 bg-white rounded-full shadow p-1 border border-gray-200">
                                            <i class="fas fa-pen text-primary-500 text-xs"></i>
                                        </span>
                                    </div>
                                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" />
                                    @if(empty($user->foto))
                                        <p class="text-sm text-red-500 mt-2">
                                            <i class="fas fa-exclamation-circle"></i>
                                            Wajib Upload Foto Profil
                                        </p>
                                    @endif
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
                                <label for="provinsi">
                                    Provinsi
                                </label>
                                <select id="provinsi" 
                                        name="provinsi" 
                                        class="form-control select {{ empty($user->provinsi) ? 'border-red-300 bg-red-50' : '' }}"
                                        required>
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

    <x-footer></x-footer>
    
    <!-- Modal Cropper -->
<div id="cropperModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-4 rounded shadow-lg max-w-md w-full">
        <div class="mb-2 font-semibold">Crop Foto Profil</div>
        <div>
            <img id="cropperImage" style="max-width:100%; max-height:300px;">
        </div>
        <div class="flex justify-end gap-2 mt-4">
            <button id="cropCancel" class="btn btn-reset">Batal</button>
            <button id="cropSave" class="btn btn-primary">Simpan</button>
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
            const messageContainer = document.createElement('div');
            messageContainer.className = 'photo-upload-message';

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = `
                        <img src="${e.target.result}" alt="Foto Profil" class="w-full h-full object-cover">
                        
                    `;
                    previewContainer.classList.remove('border-red-300');
                    previewContainer.classList.add('border-green-300');
                    
                    // Update message
                    messageContainer.innerHTML = `
                        <i class="fas fa-check-circle text-green-500"></i>
                        <span class="text-green-500">Foto profil telah dipilih</span>
                    `;
                    messageContainer.className = 'photo-upload-message success';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-camera text-4xl text-gray-400"></i>
                        <p class="text-xs text-red-500 mt-2">Wajib upload foto</p>
                    </div>
                `;
                previewContainer.classList.remove('border-green-300');
                previewContainer.classList.add('border-red-300');
                
                // Update message
                messageContainer.innerHTML = `
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span>Silakan pilih file gambar yang valid</span>
                `;
                messageContainer.className = 'photo-upload-message required';
            }

            // Update or add message
            const existingMessage = previewContainer.nextElementSibling;
            if (existingMessage && existingMessage.classList.contains('photo-upload-message')) {
                existingMessage.replaceWith(messageContainer);
            } else {
                previewContainer.parentNode.insertBefore(messageContainer, previewContainer.nextSibling);
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

    // Only set the value if an actual option (not the placeholder) is selected
    document.getElementById('provinsi_nama').value = 
        prov.selectedIndex > 0 ? prov.options[prov.selectedIndex].text : '';
    
    document.getElementById('kabupaten_nama').value = 
        kab.selectedIndex > 0 ? kab.options[kab.selectedIndex].text : '';
    
    document.getElementById('kecamatan_nama').value = 
        kec.selectedIndex > 0 ? kec.options[kec.selectedIndex].text : '';
    
    document.getElementById('kelurahan_nama').value = 
        kel.selectedIndex > 0 ? kel.options[kel.selectedIndex].text : '';
}

// Update setiap kali dropdown berubah
['provinsi', 'kabupaten', 'kecamatan', 'kelurahan'].forEach(id => {
    document.getElementById(id).addEventListener('change', setWilayahNama);
});

// Set saat submit form
const profileForm = document.getElementById('profileForm');
if (profileForm) {
    profileForm.addEventListener('submit', function(e) {
        const requiredFields = [
            'nama',
            'email',
            'nohp',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'alamat'
        ];

        const missingFields = [];
        requiredFields.forEach(field => {
            const input = document.getElementById(field);
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                missingFields.push(input.previousElementSibling.textContent.trim().replace('*', ''));
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (missingFields.length > 0) {
            e.preventDefault();
            const message = 'Silakan lengkapi field berikut: ' + missingFields.join(', ');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-100 text-red-700 px-4 py-2 rounded mb-4';
            errorDiv.textContent = message;
            profileForm.insertBefore(errorDiv, profileForm.firstChild);
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    });
}
});    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
let cropper;
const inputFile = document.getElementById('foto');
const cropperModal = document.getElementById('cropperModal');
const cropperImage = document.getElementById('cropperImage');
const cropCancel = document.getElementById('cropCancel');
const cropSave = document.getElementById('cropSave');

inputFile.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (ev) {
            cropperImage.src = ev.target.result;
            cropperModal.classList.remove('hidden');
            if (cropper) cropper.destroy();
            cropper = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
            });
        };
        reader.readAsDataURL(file);
    }
});

// Batal crop
cropCancel.addEventListener('click', function() {
    cropperModal.classList.add('hidden');
    if (cropper) cropper.destroy();
    inputFile.value = '';
});

// Simpan hasil crop
cropSave.addEventListener('click', function() {
    if (cropper) {
        cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        }).toBlob(function(blob) {
            // Buat file baru dari blob hasil crop
            const croppedFile = new File([blob], "cropped.jpg", {type: "image/jpeg"});
            // Ganti file input dengan hasil crop
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            inputFile.files = dataTransfer.files;

            // Preview hasil crop
            const previewContainer = document.getElementById('avatarPreview');
            const url = URL.createObjectURL(blob);
            previewContainer.innerHTML = `
                <img src="${url}" alt="Foto Profil" class="w-full h-full object-cover">
                
            `;
            previewContainer.classList.remove('border-red-300');
            previewContainer.classList.add('border-green-300');

            cropperModal.classList.add('hidden');
            cropper.destroy();
        }, 'image/jpeg', 0.9);
    }
});
    </script>
</body>
</html>