<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use App\Models\Kamar;
use App\Models\SewaDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SewaController extends Controller
{
    public function index()
    {
        $bookings = Sewa::with([
            'user',
            'detail.kamar'
        ])->paginate(5);

        foreach ($bookings as $b) {

    $checkIn        = Carbon::parse($b->sewa_tglcheckin);
    $checkOut       = Carbon::parse($b->sewa_tglcheckout);
    $lamaMenginap   = (int) $b->sewa_lamamenginap;

    // ============================
    // HITUNG CHECKOUT SEHARUSNYA
    // ============================
    $expectedCheckout = $checkIn->copy()->addDays($lamaMenginap);

    // ============================
    // HITUNG TELAT
    // ============================
    // telat = checkout aktual - checkout seharusnya
    $telat = $expectedCheckout->diffInDays($checkOut, false);

    // jika minus → tidak telat
    $b->telat = $telat > 0 ? $telat : 0;

    // ============================
    // HITUNG DENDA
    // ============================
    $hargaTotal = $b->detail->first()->sewa_detail_total ?? 0;

    $b->denda = $b->telat * ($hargaTotal * 0.5);

    // ============================
    // TOTAL AKHIR
    // ============================
    $b->total_final = $hargaTotal + $b->denda;

    // ============================
    // Nama kamar
    // ============================
    $b->kamar = $b->detail->first()->kamar->kamar_nama ?? '-';
}


        return view('pages.admin.sewa', compact('bookings'));
    }


    public function show(Sewa $sewa)
    {
        return response()->json(
            $sewa->load('detail.kamar.kategori')
        );
    }


    public function update(Request $request, Sewa $sewa)
{
    $request->validate([
        'check_out' => 'required|date',
    ]);

    // Update tanggal checkout & status sewa
    $sewa->update([
        'sewa_tglcheckout' => $request->check_out,
    ]);

    // Ambil detail
    $detail = $sewa->detail()->first();

    if ($detail) {
        // Update status sewa detail
        $detail->update([
            'sewa_detail_status' => 'Tersedia'
        ]);

        // Update status kamar
        if ($detail->kamar) {
            $detail->kamar->update([
                'kamar_status' => 'Tersedia'
            ]);
        }
    }

    return back()->with('success', 'Berhasil Check Out.');
}



    public function destroy(Sewa $sewa)
{
    $detail = $sewa->detail()->first();

    if ($detail && $detail->kamar) {
        $detail->kamar->update(['kamar_status' => 'Tersedia']);
    }

    $sewa->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Data sewa berhasil dihapus.'
    ], 200);
}

}
