<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Sewa;
use App\Models\SewaDetail;
use App\Models\User;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function showUser(Request $request)
{
    $search = $request->search;

    $rooms = Kamar::with('kategori')
        ->whereDoesntHave('sewaDetail', function($q){
            $q->where('sewa_detail_status', 'Disewa');
        })
        ->when($search, function($q) use ($search) {
            $q->where(function($query) use ($search) {
                $query->where('kamar_nama', 'like', "%$search%")
                      ->orWhere('kamar_harga', 'like', "%$search%")
                      ->orWhere('kamar_no', 'like', "%$search%") 
                      ->orWhereHas('kategori', function($kat) use ($search) {
                          $kat->where('kategori_nama', 'like', "%$search%")
                              ->orWhere('kategori_deskripsi', 'like', "%$search%");
                      });
            });
        })
        ->paginate(4);

    return view('pages.customer.kamar', compact('rooms'));
}

public function store(Request $request)
{
    // Validasi
    $request->validate([
        'kamar_id' => 'required|exists:kamar,kamar_id',
        'nik' => 'required|exists:users,user_nik',
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'check_in' => 'required|date',
        'jumlah_orang' => 'required|integer|min:1',
        'lama_menginap' => 'required|integer|min:1',
        'metode_pembayaran' => 'required|in:Tunai,Transfer Bank,E-Wallet'
    ]);

    $kamar = Kamar::findOrFail($request->kamar_id);

    // Cek kapasitas
    if ($request->jumlah_orang > $kamar->kamar_kapasitas) {
        return back()->withErrors([
            'jumlah_orang' => 'Jumlah orang melebihi kapasitas kamar.'
        ])->withInput();
    }

    // Ambil user berdasarkan NIK
    $user = User::where('user_nik', $request->nik)->first();

    $hari = $request->lama_menginap;
    $total = $kamar->kamar_harga * $hari;
    // INSERT SEWA
    $sewa = Sewa::create([
        'sewa_user_id' => $user->user_id,
        'sewa_tglcheckin' => $request->check_in,
        'sewa_tglcheckout' => null, // CUSTOMER TIDAK MENGISI CHECK OUT
        'sewa_metode' => $request->metode_pembayaran,
        'sewa_lamamenginap' => $request->lama_menginap,
    ]);

    // INSERT DETAIL (tanpa total)
    SewaDetail::create([
        'sewa_detail_sewa_id' => $sewa->sewa_id,
        'sewa_detail_kamar_id' => $kamar->kamar_id,
        'sewa_detail_status' => 'Disewa',
        'sewa_detail_total' => $total,   // total dihitung saat ADMIN check out
    ]);

    return back()->with('success', 'Pemesanan berhasil dibuat.');
}


public function settings()
{
    $user = auth()->user();
    return view('pages.customer.settings', compact('user'));
}

public function updateSettings(Request $request)
{
    $request->validate([
        'user_profile' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'user_namalengkap' => 'nullable|string|max:255',
        'user_nik' => 'nullable|string|max:20',
        'user_nohp' => 'nullable|string|max:20',
        'user_tgllahir' => 'nullable|date',
        'user_username' => 'required|string|max:50|unique:users,user_username,' . auth()->id() . ',user_id',
        'user_password' => 'nullable|min:6'
    ]);

    $user = auth()->user();

    if ($request->hasFile('user_profile')) {
        $profile = $request->file('user_profile')->store('user_profile', 'public');
        $user->user_profile = $profile;
    }

    $user->user_namalengkap = $request->user_namalengkap;
    $user->user_nik = $request->user_nik;
    $user->user_nohp = $request->user_nohp;
    $user->user_tgllahir = $request->user_tgllahir;
    $user->user_username = $request->user_username;

    if ($request->user_password) {
        $user->password = bcrypt($request->user_password);
    }

    $user->save();

    return redirect()->route('customer.kamar')->with('success', 'Pengaturan berhasil diperbarui.');
}


}
