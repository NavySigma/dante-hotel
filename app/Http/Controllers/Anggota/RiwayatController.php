<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\SewaDetail;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        // ambil data sewa_detail milik user yang login
        $pemesanan = SewaDetail::with(['kamar', 'sewa'])
            ->whereHas('sewa', function ($q) {
                $q->where('sewa_user_id', auth()->id()); // sesuaikan column user_id kamu
            })
            ->orderBy('sewa_detail_id', 'DESC')
            ->paginate(3); // jumlah per halaman

        return view('pages.customer.pemesanan', compact('pemesanan'));
    }

    public function updateRating(Request $request)
{
    $request->validate([
        'sewa_detail_id' => 'required|exists:sewa_detail,sewa_detail_id',
        'rating' => 'required|integer|min:1|max:5'
    ]);

    $detail = \App\Models\SewaDetail::with('kamar')->find($request->sewa_detail_id);

    // Update kamar_rating di tabel kamar
    $detail->kamar->kamar_rating = $request->rating;
    $detail->kamar->save();

    return response()->json(['success' => true]);
}

}
