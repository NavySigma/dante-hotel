<!-- resources/views/components/admin/tabs.blade.php -->
<div class="bg-gray-100 py-4">
    <div class="px-6">
        <div class="inline-flex gap-1 bg-gray-200 rounded-full p-1">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-6 py-2 rounded-full transition font-medium text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Dashboard
            </a>
            
            <a href="/admin/kamar" 
               class="px-6 py-2 rounded-full transition font-medium text-sm {{ request()->routeIs('kamar.index') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Data Kamar
            </a>
            <a href="{{ route('kategori.index') }}" 
               class="px-6 py-2 rounded-full transition font-medium text-sm {{ request()->routeIs('kategori.index') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Kategori
            </a>
            <a href="/admin/sewa" 
               class="px-6 py-2 rounded-full transition font-medium text-sm {{ request()->routeIs('sewa') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Data Sewa
            </a>
        </div>
    </div>
</div>