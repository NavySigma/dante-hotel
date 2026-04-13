<!-- resources/views/pages/admin/sewa.blade.php -->
@extends('components.admin.layout')

@section('title', 'Data Sewa')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 animate-fade-in">

    <div class="mb-6">
        <h2 class="text-base font-semibold text-gray-900">Data Sewa</h2>
    </div>

    @if($bookings->count() > 0)
    <div class="overflow-x-auto border border-gray-300 rounded-lg mb-4">
        <table class="w-full">
            <thead class="bg-white">
                <tr class="border-b border-gray-300">
                    <th class="py-3 px-4 text-xs font-semibold">ID</th>
                    <th class="py-3 px-4 text-xs font-semibold">Nama</th>
                    <th class="py-3 px-4 text-xs font-semibold">Kamar</th>
                    <th class="py-3 px-4 text-xs font-semibold">Check In</th>
                    <th class="py-3 px-4 text-xs font-semibold">Lama Menginap</th>
                    <th class="py-3 px-4 text-xs font-semibold">Check Out</th>
                    <th class="py-3 px-4 text-xs font-semibold">Harga Sewa</th>
                    <th class="py-3 px-4 text-xs font-semibold">Telat</th>
                    <th class="py-3 px-4 text-xs font-semibold">Denda</th>
                    <th class="py-3 px-4 text-xs font-semibold text-green-600">Total</th>
                    <th class="py-3 px-4 text-xs font-semibold">Status</th>
                    <th class="py-3 px-4 text-xs font-semibold text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white">
                @foreach ($bookings as $b)
                <tr class="border-b">
                    <td class="py-3 px-4 text-xs">{{ $b->sewa_id }}</td>
                    <td class="py-3 px-4 text-xs">{{ $b->user->user_namalengkap ?? '-' }}</td>
                    <td class="py-3 px-4 text-xs">{{ $b->kamar }}</td>
                    <td class="py-3 px-4 text-xs">{{ $b->sewa_tglcheckin }}</td>
                    <td class="py-3 px-4 text-xs">{{ $b->sewa_lamamenginap }} hari</td>
                    <td class="py-3 px-4 text-xs">{{ $b->sewa_tglcheckout }}</td>

                    <td class="py-3 px-4 text-xs font-medium">
                        Rp {{ number_format($b->detail->first()->sewa_detail_total ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="py-3 px-4 text-xs {{ $b->telat > 0 ? 'text-red-600 font-bold' : '' }}">
                        {{ $b->telat }} hari
                    </td>


                    <td class="py-3 px-4 text-xs text-red-600 font-semibold">
                        Rp {{ number_format($b->denda, 0, ',', '.') }}
                    </td>

                    
                    <td class="py-3 px-4 text-xs text-green-700 font-bold">
                        Rp {{ number_format($b->total_final, 0, ',', '.') }}
                    </td>
                    @php
$status = $b->detail->first()->sewa_detail_status ?? 'Tersedia';

$warna = match($status) {
    'Disewa'   => 'bg-red-600 text-white',
    'Tersedia'  => 'bg-green-600 text-white',
    default    => 'bg-green-600 text-white'
};
@endphp


                    <td class="py-3 px-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-md {{ $warna }}">
                            {{ $status }}
                        </span>
                    </td>

                    <td class="py-3 px-4">
                        <div class="flex items-center justify-center gap-2">

                            <button 
                                onclick="openModalCheckout('{{ $b->sewa_id }}')"
                                class="px-2 py-1 bg-blue-600 text-white text-xs rounded">
                                Check Out
                            </button>

                            <button class="px-2 py-1 bg-red-600 text-white text-xs rounded"
        onclick="hapusSewa({{ $b->sewa_id }})">
    🗑
</button>

                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>

    @else
    <div class="text-center py-10 text-gray-500">
        Belum ada data sewa
    </div>
    @endif
</div>

@include('components.admin.modal-checkout-sewa')

@endsection

@push('scripts')
<script>
function openModalCheckout(id) {
    document.getElementById('checkout-sewa-id').value = id;

    // Set action route update
    document.getElementById('form-checkout').action = "/admin/sewa/" + id;

    document.getElementById('modal-checkout-sewa').classList.remove('hidden');
}

function closeModalCheckout() {
    document.getElementById('modal-checkout-sewa').classList.add('hidden');
}

function hapusSewa(id) {
    if (!confirm('Yakin mau menghapus data sewa ini?')) return;

    fetch(`/admin/sewa/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => {
        if (res.ok) {
            alert('Data berhasil dihapus!');
            location.reload();
        } else {
            alert('Gagal menghapus data!');
        }
    })
    .catch(() => alert('Terjadi kesalahan!'));
}
</script>
@endpush
