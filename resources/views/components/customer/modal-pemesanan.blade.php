<!-- resources/views/components/customer/modal-pemesanan.blade.php -->

<!-- Modal Overlay -->
<div id="modal-pemesanan" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 animate-fade-in">

    <!-- Modal Container -->
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[100vh] p-5 overflow-y-auto animate-slide-up">

        <!-- Modal Header -->
        <div class="top-0 bg-white border-b border-gray-200 px-6 py-4 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pemesanan Kamar</h3>
                    <p class="text-sm text-gray-500">
                        <span id="modal-room-name">Kamar 1</span> - 
                        <span id="modal-room-type">Standard</span>
                    </p>
                </div>
                <button onclick="closeModalPemesanan()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <form id="form-pemesanan" action="{{ route('customer.store') }}" method="POST" class="px-6 py-4">
            @csrf
            <input type="hidden" name="kamar_id" id="room_id">

            <!-- NIK -->
            <div class="mb-4">
                <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                <input type="text" id="nik" name="nik" placeholder="NIK Akun Anda"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Nama Lengkap"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
            </div>

            <!-- HP -->
            <div class="mb-4">
                <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">No. Handphone</label>
                <input type="tel" id="no_hp" name="no_hp" placeholder="08123456789"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
            </div>

            <!-- Check in -->
            <div class="mb-4">
                <label for="check_in" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Check-In</label>
                <input type="date" id="check_in" name="check_in" onchange="hitungTotal()"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
            </div>

            <!-- Lama Menginap -->
            <div class="mb-4">
                <label for="lama_menginap" class="block text-sm font-semibold text-gray-700 mb-2">Lama Menginap (hari)</label>
                <input type="number" id="lama_menginap" name="lama_menginap" value="1" min="1"   onchange="hitungTotal()"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
            </div>

            <!-- Jumlah Orang -->
            <div class="mb-4">
                <label for="jumlah_orang" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Orang</label>
                <input type="number" id="jumlah_orang" name="jumlah_orang" min="1" placeholder="1"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
                <span class="text-xs text-gray-500 mt-1">Maksimal <span id="textjumlah_orang">1</span> Orang</span>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-4">
                <label for="metode_pembayaran" class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran</label>
                <select id="metode_pembayaran" name="metode_pembayaran"
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" required>
                    <option value="" disabled selected>Pilih metode pembayaran</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Tunai">Tunai</option>
                </select>
            </div>

            <!-- Harga -->
            <div class="bg-yellow-400 rounded-lg p-4 mb-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-800">Harga per malam:</span>
                    <span id="harga-per-malam" class="text-sm font-bold text-gray-900">Rp. 500,000</span>
                </div>
                <div class="flex justify-between items-center border-t border-yellow-500 pt-2">
                    <span class="text-sm font-bold text-gray-800">Total:</span>
                    <span id="total-harga" class="text-base font-bold text-gray-900">Rp. 500,000</span>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gray-900 hover:bg-black text-white font-semibold py-3 rounded-lg 
                transition-colors duration-200 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                    </path>
                </svg>
                Konfirmasi Pemesanan
            </button>
        </form>
    </div>
</div>

<!-- Modal Success -->
<div id="modal-success"
    class="hidden fixed inset-0 bg-black/70 z-[60] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-8 flex flex-col items-center animate-pop">

        <div class="checkmark-container mb-4">
            <svg class="checkmark" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark-check" fill="none" d="M16 26l7 7 13-15" />
            </svg>
        </div>

        <h3 class="text-lg font-bold text-gray-800 mb-1">Pemesanan Berhasil!</h3>
        <p class="text-gray-600 text-sm">Terima kasih telah melakukan pemesanan.</p>
    </div>
</div>

<style>
    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }

    @keyframes pop {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-pop {
        animation: pop 0.3s ease-out;
    }

    /* Checkmark */
    .checkmark {
        width: 80px;
        height: 80px;
        stroke-width: 3;
        stroke: #22c55e;
        stroke-miterlimit: 10;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        animation: strokeCircle 0.6s ease forwards;
    }

    .checkmark-check {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: strokeCheck 0.4s ease forwards 0.6s;
    }

    @keyframes strokeCircle {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes strokeCheck {
        to {
            stroke-dashoffset: 0;
        }
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form-pemesanan");
    const modalSuccess = document.getElementById("modal-success");

    form.addEventListener("submit", function(e) {
        e.preventDefault(); 

        modalSuccess.classList.remove("hidden");

        setTimeout(() => {
            form.submit();
        }, 1200);
    });

});
</script>
