<!-- resources/views/components/admin/modal-tambah-kamar.blade.php -->

<!-- Modal Overlay -->
<div id="modal-tambah-kamar" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <!-- Modal Container -->
    <div class="bg-white rounded-2xl shadow2xl max-w-md w-full max-h-[90vh] overflow-y-auto p-4">
        <!-- Modal Header -->
        <div class="top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
            <h3 class="text-lg font-bold text-gray-800">Tambah Kamar Baru</h3>
            <p class="text-sm text-gray-500">Masukkan informasi kamar hotel yang akan ditambahkan</p>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-4"> 
            @csrf

            <!-- Nama Kamar -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kamar</label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    placeholder="Contoh: Kamar 1"
                    class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
                    required
                >
            </div>
            @error('nama')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror

            <!-- Gambar Kamar -->
<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Kamar</label>

    <!-- Preview -->
    <img 
        id="tambah-preview-img" 
        src="https://via.placeholder.com/300x200?text=Preview+Kamar" 
        class="w-full h-40 object-cover rounded-lg mb-3 border"
        alt="Preview Kamar"
    >

    <!-- Input File -->
    <input 
        type="file" 
        id="tambah-kamar-img" 
        name="kamar_img"
        accept="image/*"
        class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
        onchange="previewTambahImg(event)"
        required
    >
</div>
@error('kamar_img')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror


            <!-- Tipe Kamar -->
<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kamar</label>
    <select 
        name="tipe" 
        class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-gray-400 text-sm"
        required
    >
        <option value="">Pilih Tipe Kamar</option>
        @foreach ($categories as $kategori)
            <option value="{{ $kategori->kategori_id }}">
                {{ $kategori->kategori_nama }}
            </option>
        @endforeach
    </select>
</div>
@error('tipe')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror


            <!-- Harga -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp) / Malam</label>
                <input 
                    type="number" 
                    id="harga" 
                    name="harga" 
                    placeholder="Contoh: 500000"
                    class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
                    required
                >
            </div>
            @error('harga')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror

            <!-- Lantai -->
            <div class="mb-4">
                <label for="lantai" class="block text-sm font-semibold text-gray-700 mb-2">Lantai</label>
                <input 
                    type="number" 
                    id="lantai" 
                    name="lantai" 
                    placeholder="Contoh: 1"
                    class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
                    required
                >
            </div>
            @error('lantai')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror

            <!-- Nomor Kamar -->
            <div class="mb-4">
                <label for="kamar_no" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Kamar</label>
                <input 
                    type="text" 
                    id="kamar_no" 
                    name="kamar_no" 
                    placeholder="Contoh: A2.1"
                    class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
                    required
                >
            </div>
            @error('kamar_no')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror


            <!-- Kapasitas -->
            <div class="mb-4">
                <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                <input 
                    type="number" 
                    id="kapasitas" 
                    name="kapasitas" 
                    placeholder="Contoh: 2"
                    class="w-full px-4 py-2.5 bg-gray-100 border-0 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm"
                    required
                >
            </div>
@error('kapasitas')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror
        

            

            <!-- Buttons -->
            <div class="flex gap-3">
                <button 
                    type="button"
                    onclick="closeModalTambah()"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 rounded-lg transition-colors"
                >
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="flex-1 bg-black hover:bg-gray-800 text-white font-semibold py-3 rounded-lg transition-colors"
                >
                    Tambah Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewTambahImg(event) {
    const img = document.getElementById('tambah-preview-img');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>