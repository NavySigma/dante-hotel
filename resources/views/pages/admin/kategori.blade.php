<!-- resources/views/pages/admin/kategori.blade.php -->
@extends('components.admin.layout')

@section('title', 'Management Kategori')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Management Kategori</h1>
        <button onclick="openModalTambah()" class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-4">
        <div class="relative">
            <input type="text" placeholder="Cari berdasarkan nomor kamar, tipe, harga, atau status..." 
                class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none transition-colors">
            <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Empty State (jika belum ada kategori) -->
    @if($categories->count() == 0)
    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-200 p-16">
        <div class="flex flex-col items-center text-center">
            <div class="w-24 h-24 mb-6 text-gray-300">
                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Kategori</h3>
            <p class="text-gray-600 mb-6">Silakan tambah kategori kamar terlebih dahulu</p>
            <button onclick="openModalTambah()" class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                Tambah Kategori Pertama
            </button>
        </div>
    </div>
    @else
    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Standard Category Card -->
        @foreach ($categories as $kategori)
<div class="bg-white rounded-2xl shadow-sm border-2 border-gray-900 p-6 hover:shadow-lg transition-all duration-300">

    <h3 class="text-xl font-bold text-gray-900 mb-2">
        {{ $kategori->kategori_nama }}
    </h3>

    <p class="text-gray-600 text-sm mb-9">
        {{ $kategori->kategori_deskripsi }}
    </p>

    <div class="flex items-center justify-between mb-4 pb-4 border-b-2  border-gray-1000">
        <span class="text-gray-700 font-semibold">Jumlah Kamar</span>
        <span class="bg-gray-900 text-white px-4 py-1 rounded-lg font-bold">
            {{ $kategori->kamars_count }}
        </span>
    </div>

    <div class="flex gap-2">
        <button 
            onclick="openModalEdit(
                '{{ $kategori->kategori_id }}',
                '{{ $kategori->kategori_nama }}',
                '{{ $kategori->kategori_deskripsi }}'
            )"
            class="flex-1 border-2 border-gray-900 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-gray-900 hover:text-white transition-all duration-300">
            ✏ Edit
        </button>

        <form id="delete-form-{{ $kategori->kategori_id }}" 
              action="{{ route('kategori.destroy', $kategori) }}" 
              method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete({{ $kategori->kategori_id }})"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-300">
                🗑
            </button>
        </form>
    </div>

</div>
@endforeach


    <!-- Pagination -->
    <div class="flex justify-center">
        <div class="inline-flex items-center gap-1">
            {{ $categories->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
    @endif

    <!-- Include Modals -->
    @include('components.admin.modal-tambah-kategori')
    @include('components.admin.modal-edit-kategori')
</div>
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
@if ($errors->any() && session('error_modal') === 'tambah')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        openModalTambah();
    });
</script>
@endif

@if ($errors->any() && session('error_modal') === 'edit')
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // Ambil id yang sedang error validasi
        const id = "{{ session('edit_id') }}";

        // Ambil kembali input lama
        const nama = "{{ old('kategori_nama') }}";
        const deskripsi = "{{ old('kategori_deskripsi') }}";

        // Panggil modal edit
        openModalEdit(id, nama, deskripsi);
    });
</script>
@endif


<script>
    function openModalTambah() {
        document.getElementById('modal-tambah-kategori').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    

    function closeModalTambah() {
        document.getElementById('modal-tambah-kategori').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openModalEdit(id, nama, deskripsi) {
    document.getElementById('edit-kategori-id').value = id;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;

    // SET ACTION URL DINAMIS
    document.getElementById('form-edit-kategori').action =
        "/admin/kategori/" + id;

    document.getElementById('modal-edit-kategori').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

    function closeModalEdit() {
        document.getElementById('modal-edit-kategori').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
            // Submit delete form
            document.getElementById('delete-form-' + id).submit();
        }
    }
     

</script>
@endpush