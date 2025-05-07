<x-app-admin></x-app-admin>
<x-sidebar>
    @section('isi')

    <div class="p-6">
        <!-- Informasi Homestay -->
        <h1 class="text-2xl font-bold">{{ $homestay->name }}</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $homestay->description }}</p>
        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Alamat:</strong> {{ $homestay->address }}</p>
        <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Status:</strong> {{ ucfirst($homestay->status) }}</p>

        <!-- Aturan Homestay -->
        <h2 class="text-xl font-semibold mt-6">Aturan Homestay</h2>
        <ul class="list-disc list-inside mt-2 text-gray-600 dark:text-gray-400">
            @foreach ($homestay->rules as $rule)
                <li>{{ $rule->rule_text }}</li>
            @endforeach
        </ul>

        <!-- Daftar Kamar -->
        <h2 class="text-xl font-semibold mt-6">Daftar Kamar</h2>
        @foreach ($homestay->rooms as $room)
            <div class="mt-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-800">
                <h3 class="text-lg font-bold">{{ $room->name }}</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ $room->description }}</p>
                <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Harga:</strong> Rp {{ number_format($room->price, 2) }}</p>
                <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Kapasitas:</strong> {{ $room->max_guests }} tamu</p>
                <p class="mt-2 text-gray-600 dark:text-gray-400"><strong>Total Kamar:</strong> {{ $room->total_rooms }}</p>

                <!-- Foto Kamar -->
                <h4 class="text-md font-semibold mt-4">Foto Kamar</h4>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    @foreach ($room->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Kamar" class="rounded-lg">
                    @endforeach
                </div>

                <!-- Fasilitas Kamar -->
                <h4 class="text-md font-semibold mt-4">Fasilitas</h4>
                <ul class="list-disc list-inside mt-2 text-gray-600 dark:text-gray-400">
                    @foreach ($room->facilities as $facility)
                        <li>{{ $facility->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    @endsection
</x-sidebar>
