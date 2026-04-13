<!-- resources/views/components/admin/modal-checkout-sewa.blade.php -->

<div id="modal-checkout-sewa" class="hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex items-center justify-center">

    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">

        <h2 class="text-lg font-bold mb-4">Check Out</h2>

        <form id="form-checkout" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="checkout-sewa-id" name="sewa_id">

            <div class="mb-3">
                <label class="text-sm font-semibold">Tanggal Check Out</label>
                <input type="date" name="check_out" class="w-full border rounded p-2" required>
            </div>

            <button class="w-full bg-black text-white py-2 rounded mt-2">
                Proses Check Out
            </button>

            <button type="button" class="w-full bg-gray-200 py-2 rounded mt-2"
                onclick="closeModalCheckout()">
                Batal
            </button>

        </form>

    </div>

</div>
