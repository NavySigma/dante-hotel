<!-- resources/views/pages/customer/pemesanan.blade.php -->
@extends('components.customer.layout')

@section('title', 'Riwayat Pemesanan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 animate-fade-in">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-1">Riwayat Pemesanan</h2>
        <p class="text-gray-500 text-sm">Daftar pemesanan kamar yang telah anda lakukan</p>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Tipe Kamar</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Check-in</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Lama Sewa</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Pembayaran</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-700 text-sm">Rating</th>
                </tr>
            </thead>
            <tbody class="bg-white">

    @forelse($pemesanan as $item)
    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
        
        <td class="py-3 px-4">
            <span class="text-gray-700 text-sm">{{ $item->kamar->kamar_nama ?? '-' }}</span>
        </td>

        <td class="py-3 px-4">
            <span class="text-gray-600 text-sm">{{ $item->sewa->sewa_tglcheckin }}</span>
        </td>

        <td class="py-3 px-4">
            <span class="text-gray-600 text-sm">{{ $item->sewa->sewa_lamamenginap }}  hari</span>
        </td>

        <td class="py-3 px-4">
            <span class="text-gray-600 text-sm">{{ $item->sewa->sewa_metode ?? '-' }}</span>
        </td>

        {{-- ⭐ RATING --}}
        <td class="py-3 px-4">
            <div class="flex gap-1 rating-group" data-id="{{ $item->sewa_detail_id }}">
                @for($i = 1; $i <= 5; $i++)
                    <svg 
                        class="w-5 h-5 cursor-pointer star 
                            {{ $i <= $item->kamar->kamar_rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                        data-value="{{ $i }}"
                        viewBox="0 0 20 20" fill="currentColor"
                    >
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                @endfor
            </div>
        </td>

    </tr>
    @empty

    {{-- Jika kosong tampilkan empty state --}}
    <tr>
        <td colspan="5" class="py-12 text-center text-gray-400">
            Belum ada riwayat pemesanan.
        </td>
    </tr>

    @endforelse

</tbody>

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        <div class="inline-flex items-center gap-1 px-3 py-2 rounded-full">
            {{ $pemesanan->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
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
<script>
document.querySelectorAll('.rating-group').forEach(group => {

    const sewaDetailId = group.dataset.id;

    group.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {

            const rating = parseInt(this.dataset.value);

            fetch("{{ route('riwayat.rating') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    sewa_detail_id: sewaDetailId,
                    rating: rating
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {

                    // UPDATE WARNA BINTANG REALTIME
                    group.querySelectorAll('.star').forEach(s => {
                        const val = parseInt(s.dataset.value);

                        if (val <= rating) {
                            s.classList.add('text-yellow-400');
                            s.classList.remove('text-gray-300');
                        } else {
                            s.classList.add('text-gray-300');
                            s.classList.remove('text-yellow-400');
                        }
                    });

                }
            });

        });
    });

});

</script>
@endpush
