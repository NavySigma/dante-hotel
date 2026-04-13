<!-- resources/views/pages/customer/kamar.blade.php -->
@extends('components.customer.layout')

@section('title', 'Daftar Kamar Hotel')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 animate-fade-in">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Daftar Kamar Hotel</h2>
        <p class="text-gray-500 text-sm">Cari berbagai pilihan kamar terbaik untuk Anda</p>
    </div>

    <!-- Search Bar -->
<form method="GET" action="" class="mb-6">
    <div class="relative">
        <input 
            type="text" 
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari berdasarkan nama kamar, tipe, dan lainnya..." 
            class="w-full px-4 py-2.5 pl-10 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
        >
        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</form>


    <!-- Room Cards Grid -->
    @if(isset($rooms) && $rooms->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach($rooms as $room)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group">
        
        <!-- ROOM IMAGE -->
        <div class="relative h-40 overflow-hidden">
            <img 
                src="{{ asset('storage/' . $room->kamar_img) }}" 
                alt="{{ $room->kamar_nama }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
            >

            <!-- STATUS -->
            <span class="bg-green-600 absolute top-2 right-2 text-white text-xs px-2.5 py-1 rounded-full font-medium ">
                Tersedia
            </span>
        </div>

        <!-- ROOM CONTENT -->
        <div class="p-4">
            
            <!-- NAME + RATING -->
            <div class="flex justify-between items-center mb-1">
                <h3 class="text-base font-bold text-gray-800">
                    {{ $room->kamar_nama }}
                </h3>

                <!-- Rating -->
                <span class="flex items-center text-yellow-500 text-sm font-medium">
                    ⭐ {{ number_format($room->kamar_rating, 1) }}
                </span>
            </div>

            <!-- TYPE / KATEGORI -->
            <h4 class=" text-gray-500 ">{{ $room->kategori->kategori_nama ?? '-' }}</h4>

            <p class="text-xs text-gray-500 ">{{ $room->kategori->kategori_deskripsi }}</p>

            <p class="text-black mb-2">Nomor Kamar :  {{ $room->kamar_no }}</p>

            <!-- PRICE -->
            <div class="mb-3">
                <p class="text-lg font-bold text-gray-900">
                    Rp. {{ number_format($room->kamar_harga, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-400">per malam</p>
            </div>

            <!-- ACTION BUTTON -->
            <button 
    onclick="openModalPemesanan(
        {{ $room->kamar_id }},
        '{{ $room->kamar_nama }}',
        '{{ $room->kategori->kategori_nama ?? '-' }}',
        {{ $room->kamar_harga }},
        {{ $room->kamar_kapasitas }}
    )"
    class="block w-full bg-gray-800 hover:bg-gray-900 text-white text-center py-2 rounded-lg text-sm font-medium">
    Pesan Kamar
</button>

        </div>
    </div>
    @endforeach
</div>

    @else
    <!-- Empty State Message -->
    <div class="py-16 text-center">
        <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <p class="text-gray-500 text-sm font-medium mb-1">Belum Ada Kamar Tersedia</p>
        <p class="text-gray-400 text-xs">Data kamar akan muncul setelah admin menginputkan kamar</p>
    </div>
    @endif

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        <div class="inline-flex items-center gap-1 px-3 py-2 -full ">
            {{ $rooms->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

<!-- Include Modal Pemesanan -->
@include('components.customer.modal-pemesanan')

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    function openModalPemesanan(roomId, roomName, roomType, roomPrice, kapasitas) {
    document.getElementById('modal-room-name').textContent = roomName;
    document.getElementById('modal-room-type').textContent = roomType;
    document.getElementById('room_id').value = roomId;

    // Kapasitas
    document.getElementById('jumlah_orang').max = kapasitas;
    document.getElementById('textjumlah_orang').textContent = kapasitas;

    // Set harga
    document.getElementById('harga-per-malam').textContent = 
        'Rp. ' + roomPrice.toLocaleString('id-ID');

    document.getElementById('total-harga').textContent = 
        'Rp. ' + roomPrice.toLocaleString('id-ID');

    // Simpan harga raw
    window.hargaPerMalam = roomPrice;

    document.getElementById('modal-pemesanan').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

    function closeModalPemesanan() {
        document.getElementById('modal-pemesanan').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Hitung total harga berdasarkan tanggal
    function hitungTotal() {
    const checkIn = document.getElementById('check_in').value;
    const lama = parseInt(document.getElementById('lama_menginap').value);

    if (lama < 1) return;

    // Hitung total
    const total = window.hargaPerMalam * lama;

    // Tampilkan total
    document.getElementById('total-harga').textContent =
        'Rp. ' + total.toLocaleString('id-ID');
}



    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('modal-pemesanan');
        if (event.target === modal) {
            closeModalPemesanan();
        }
    });
</script>
@endpush