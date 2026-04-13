<div id="modal-tambah-kategori" class="hidden fixed inset-0 z-50 overflow-y-auto">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeModalTambah()"></div>
    
    <!-- Modal Content -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-8 transform transition-all">
            
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">Tambah Kategori Baru</h2>
                <p class="text-sm text-gray-500 mt-1">Masukkan kategori baru</p>
            </div>

            <!-- Form -->
            <form action="{{ route('kategori.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Nama Kategori
                    </label>
                    <input type="text"
                        name="kategori_nama"
                        value="{{ old('nama_kategori') }}"
                        placeholder="Contoh: Standard"
                        class="w-full px-4 py-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-gray-300 focus:outline-none text-gray-700">
                    
                    @error('kategori_nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        Deskripsi
                    </label>
                    <textarea
                        name="kategori_deskripsi"
                        rows="3"
                        placeholder="Masukkan deskripsi kategori"
                        class="w-full px-4 py-3 bg-gray-100 border rounded-lg focus:ring-2 focus:ring-gray-300 text-gray-700 resize-none">{{ old('deskripsi') }}</textarea>

                    @error('kategori_deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Kamar -->
                

                <!-- Submit -->
                <button type="submit"
                    class="w-full px-6 py-3 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition">
                    Tambah Kategori
                </button>
            </form>

        </div>
    </div>
</div>
