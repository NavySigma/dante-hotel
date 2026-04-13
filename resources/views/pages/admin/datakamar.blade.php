


<!-- resources/views/pages/admin/kamar/index.blade.php -->
@extends('components.admin.layout')

@section('title', 'Data Kamar')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 animate-fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-base font-semibold text-gray-900">Management Data Kamar Hotel</h2>
        <button onclick="openModalTambah()" class="flex items-center gap-2 bg-black hover:bg-gray-800 text-white px-4 py-2 rounded-md transition-colors text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kamar
        </button>
    </div>

    <!-- Search Bar -->
     <form method="GET" action="{{ route('kamar.index') }}">
    <div class="mb-4">
        <div class="relative">
            <input 
                type="text" 
                name="search"
                value="{{ request('search') }}"
                id="search-kamar"
                placeholder="Cari berdasarkan nomor kamar, tipe, harga, atau status..." 
                class="w-full px-4 py-2.5 pl-10 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 text-sm text-gray-600 placeholder-gray-400"
            >
            <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
    </form>


    <!-- Table -->
    @if(isset($kamars) && $kamars->count() > 0)
    <div class="overflow-x-auto border border-gray-300 rounded-lg mb-4">
        <table class="w-full">
            <thead class="bg-white">
                <tr class="border-b border-gray-300">
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Nama Kamar</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Tipe Kamar</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Harga</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Lantai</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Kapasitas</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Rating</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Status</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-900 text-xs">Deskripsi</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-900 text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($kamars as $index => $kamar)
                <tr class="border-b border-gray-200">
                    <script type="application/json" id="kamar-json-{{ $kamar->kamar_id }}">
    {!! json_encode($kamar) !!}
</script>

                    <td class="py-3 px-4 text-xs text-gray-700">
                        <div class="flex items-center gap-2">
                            <span>{{ $kamar->kamar_nama }}</span>
                            @if($kamar->kamar_img)
                                <img src="{{ asset('storage/' . $kamar->kamar_img) }}" 
                                    alt="Foto Kamar" 
                                    class="w-10 h-10 object-cover rounded">
                            @endif
                        </div>
                    </td>
                    <td class="py-3 px-4 text-xs text-gray-600">{{ $kamar->kategori->kategori_nama }}</td>
                    <td class="py-3 px-4 text-xs text-gray-700">Rp. {{ number_format($kamar->kamar_harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-xs text-gray-600">{{ $kamar->kamar_lantai }}</td>
                    <td class="py-3 px-4 text-xs text-gray-600">{{ $kamar->kamar_kapasitas }} Orang</td>
                    <td class="py-3 px-4 text-xs text-gray-600">{{ $kamar->kamar_rating }} ⭐</td>
                    @php
                    $status = $kamar->sewaDetail->sewa_detail_status ?? 'Tersedia';
                    $warna  = $status === 'Disewa'
                                ? 'bg-red-600 text-white'
                                : 'bg-green-600 text-white';
                    @endphp
                    <td class="py-3 px-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-md {{ $warna }}">
    {{ $status }}
</span>
                    </td>
                    <td class="py-3 px-4 text-xs text-gray-600 max-w-xs">{{ Str::limit($kamar->kategori->kategori_deskripsi, 50) }}</td>
                    <td class="py-3 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <button 
                            onclick='openModalEdit(@json($kamar))'
                            class="p-1.5 text-blue-600 bg-blue-100 hover:bg-blue-50 rounded transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form id="delete-form-{{ $kamar->kamar_id }}" 
                                action="{{ route('kamar.destroy', $kamar->kamar_id) }}" 
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button" 
                                    onclick="confirmDelete({{ $kamar->kamar_id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg">
                                    🗑
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        <div class="inline-flex items-center gap-1">
            {{ $kamars->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="py-12 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <p class="text-gray-500 text-sm font-medium mb-1">Belum ada data kamar</p>
        <p class="text-gray-400 text-xs">Klik tombol "Tambah Kamar" untuk menambahkan kamar baru</p>
    </div>
    @endif
</div>

<!-- Modal Tambah Kamar -->
@include('components.admin.modal-tambah-kamar')

<!-- Modal Edit Kamar -->
@include('components.admin.modal-edit-kamar')

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
</style>
@endpush

@push('scripts')

@if ($errors->any() && str_starts_with(session('error_modal'), 'edit_'))
<script>
document.addEventListener("DOMContentLoaded", function () {
    let id = "{{ explode('_', session('error_modal'))[1] }}";

    // Ambil data dari element HTML (dataset)
    let kamarData = JSON.parse(document.getElementById("kamar-json-" + id).textContent);

    openModalEdit(kamarData);
});
</script>
@endif

@if ($errors->any() && session('error_modal') === 'tambah')
<script>
document.addEventListener("DOMContentLoaded", function () {
    openModalTambah();
});
</script>
@endif

<script>

    function openModalTambah() {
        document.getElementById('modal-tambah-kamar').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModalTambah() {
        document.getElementById('modal-tambah-kamar').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openModalEdit(kamar) {
    document.getElementById('edit-kamar-id').value = kamar.kamar_id;
    document.getElementById('edit-nama').value = kamar.kamar_nama;
    document.getElementById('edit-preview-img').src = kamar.kamar_img 
    ? "/storage/" + kamar.kamar_img 
    : "/images/no-image.png"; 
    document.getElementById('edit-tipe').value = kamar.kamar_kategori_id;
    document.getElementById('edit-harga').value = kamar.kamar_harga;
    document.getElementById('edit-lantai').value = kamar.kamar_lantai;
    document.getElementById('edit-kamar-no').value = kamar.kamar_no;
    document.getElementById('edit-kapasitas').value = kamar.kamar_kapasitas;

    document.getElementById('form-edit-kamar').action = '/admin/kamar/' + kamar.kamar_id;

    document.getElementById('modal-edit-kamar').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

    function closeModalEdit() {
        document.getElementById('modal-edit-kamar').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kamar ini?')) {
            // Submit delete form
            document.getElementById('delete-form-' + id).submit();
        }
    }

    

</script>
@endpush