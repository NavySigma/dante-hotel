<!-- resources/views/components/admin/modal-edit-kamar.blade.php -->

<!-- Modal Overlay -->
<div id="modal-edit-kamar" class="hidden fixed inset-0 bg-black/50 bg-opacity-50 z-50 flex items-center justify-center p-8">
    <!-- Modal Container -->
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
            <h3 class="text-lg font-bold text-gray-800">Edit Kamar</h3>
            <p class="text-sm text-gray-500">Ubah informasi kamar hotel</p>
        </div>

        <!-- Modal Body -->
        <form 
    id="form-edit-kamar" 
    method="POST" 
    action="{{ route('kamar.update', ':id') }}"
    enctype="multipart/form-data"
    class="px-6 py-4"
>

    @csrf
    @method('PUT')

    <input type="hidden" id="edit-kamar-id" name="kamar_id">

    <!-- Nama -->
    <div class="mb-4">
        <label class="text-sm font-semibold">Nama Kamar</label>
        <input type="text" id="edit-nama" name="nama" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
    </div>
    @error('nama')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror

    <!-- Gambar Kamar -->
            <div class="mb-6">
                <label class="text-sm font-semibold">Gambar Kamar</label>

                <!-- preview -->
                <img id="edit-preview-img" 
                     src="" 
                     class="w-full h-40 object-cover rounded-lg mb-3 border" 
                     alt="Preview Kamar">

                <!-- input file -->
                <input 
                    type="file" 
                    id="edit-kamar-img" 
                    name="kamar_img" 
                    accept="image/*" 
                    class="w-full bg-gray-100 rounded-lg px-4 py-2.5"
                    onchange="previewEditImg(event)">
            </div>

    <!-- Tipe -->
    <div class="mb-4">
        <label class="text-sm font-semibold">Tipe Kamar</label>
        <select id="edit-tipe" name="tipe" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
            @foreach($categories as $c)
                <option value="{{ $c->kategori_id }}">{{ $c->kategori_nama }}</option>
            @endforeach
        </select>
    </div>
    

    <!-- Harga -->
    <div class="mb-4">
        <label class="text-sm font-semibold">Harga</label>
        <input type="number" id="edit-harga" name="harga" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
    </div>
    

    <!-- Lantai -->
    <div class="mb-4">
        <label class="text-sm font-semibold">Lantai</label>
        <input type="number" id="edit-lantai" name="lantai" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
    </div>
    

    <!-- Nomor Kamar -->
    <div class="mb-4">
        <label class="text-sm font-semibold">Nomor Kamar</label>
        <input type="text" id="edit-kamar-no" name="kamar_no" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
    </div>
    @error('kamar_no')
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
@enderror

    <!-- Kapasitas -->
    <div class="mb-6">
        <label class="text-sm font-semibold">Kapasitas</label>
        <input type="number" id="edit-kapasitas" name="kapasitas" class="w-full bg-gray-100 rounded-lg px-4 py-2.5">
    </div>
    

    <div class="flex gap-3">
        <button type="button" onclick="closeModalEdit()" class="flex-1 bg-gray-200 rounded-lg py-3">
            Batal
        </button>
        <button type="submit" class="flex-1 bg-black text-white rounded-lg py-3">
            Simpan
        </button>
    </div>
</form>

    </div>
</div>

<script>
function previewEditImg(event) {
    const img = document.getElementById('edit-preview-img');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>