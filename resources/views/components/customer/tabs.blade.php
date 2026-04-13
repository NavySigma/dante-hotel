<!-- resources/views/components/customer/tabs.blade.php -->
<div class="bg-gray-100 py-4">
    <div class="px-6">
        <div class="inline-flex gap-1 bg-gray-200 rounded-full p-1">
            <a href="/user" 
               class="px-6 py-2 rounded-full transition font-medium {{ request()->routeIs('customer.kamar') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Cari Kamar
            </a>
            <a href="/user/riwayat" 
               class="px-6 py-2 rounded-full transition font-medium {{ request()->routeIs('riwayat.index') ? 'bg-white text-black shadow-sm' : 'text-gray-700 hover:text-black' }}">
                Riwayat Pemesanan
            </a>
        </div>
    </div>
</div>