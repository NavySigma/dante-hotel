<!-- resources/views/components/admin/modal-edit-kategori.blade.php -->
<div id="modal-edit-kategori" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeModalEdit()"></div>
    
    <!-- Modal Content -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-8 transform transition-all">
            
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">Edit Kategori</h2>
                <p class="text-sm text-gray-500 mt-1">Edit Kategori</p>
            </div>

            <!-- Form -->
            <form id="form-edit-kategori" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <input type="hidden" id="edit-kategori-id" name="kategori_id">

                <!-- Nama Kategori -->
                <div>
                    <label for="edit-nama" class="block text-sm font-semibold text-gray-900 mb-2">
                        Nama Kategori
                    </label>
                    <input type="text" 
                           id="edit-nama" 
                           name="kategori_nama" 
                           class="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-gray-300 focus:outline-none transition-all text-black"
                           required>
                </div>
                @error('kategori_nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <!-- Deskripsi -->
                <div>
                    <label for="edit-deskripsi" class="block text-sm font-semibold text-gray-900 mb-2">
                        Deskripsi
                    </label>
                    <textarea id="edit-deskripsi" 
                              name="kategori_deskripsi" 
                              rows="3"
                              class="w-full px-4 py-3 bg-gray-100 border-0 rounded-lg focus:ring-2 focus:ring-gray-300 focus:outline-none transition-all text-black resize-none"
                              required></textarea>
                </div>
                @error('kategori_deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <!-- Jumlah Kamar -->
               

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full px-6 py-3 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition-all duration-300">
                        Edit Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>