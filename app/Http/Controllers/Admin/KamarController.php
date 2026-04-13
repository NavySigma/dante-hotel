<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\SewaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
   // Admin/RoomController.php

public function store(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'nama'       => 'required|string|max:255|unique:kamar,kamar_nama',
        'kamar_img'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'tipe'       => 'required|exists:kategori,kategori_id',
        'harga'      => 'required|numeric|min:0',
        'lantai'     => 'required|integer|min:1',
        'kamar_no'   => 'required|string|unique:kamar,kamar_no',
        'kapasitas'  => 'required|string|max:50',
    ], [
        'nama.unique' => 'Nama kamar sudah digunakan, silakan pilih nama lain.',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput()
            ->with('error_modal', 'tambah'); // ← PENTING BANGET!
    }

    Kamar::create([
        'kamar_nama'        => $request->nama,
        'kamar_img'         => $request->kamar_img ? $request->file('kamar_img')->store('kamar_img', 'public') : null,
        'kamar_kategori_id' => $request->tipe,
        'kamar_harga'       => $request->harga,
        'kamar_lantai'      => $request->lantai,
        'kamar_no'          => $request->kamar_no,
        'kamar_kapasitas'   => $request->kapasitas,
    ]);

    return back()->with('success', 'Kamar berhasil ditambahkan.');
}


public function update(Request $request, Kamar $kamar)
{
    $validator = \Validator::make($request->all(), [
        'nama'      => 'required|string|max:255|unique:kamar,kamar_nama,' . $kamar->kamar_id . ',kamar_id',
        'kamar_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'tipe'      => 'required|exists:kategori,kategori_id',
        'harga'     => 'required|numeric|min:0',
        'lantai'    => 'required|integer|min:1',
        'kamar_no'  => 'required|string|unique:kamar,kamar_no,' . $kamar->kamar_id . ',kamar_id',
        'kapasitas' => 'required|string|max:50',
    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput()
            ->with('error_modal', 'edit_'.$kamar->kamar_id); // penting!
    }

    // UPDATE data...
    $kamar->kamar_nama        = $request->nama;
    $kamar->kamar_kategori_id = $request->tipe;
    $kamar->kamar_harga       = $request->harga;
    $kamar->kamar_lantai      = $request->lantai;
    $kamar->kamar_no          = $request->kamar_no;
    $kamar->kamar_kapasitas   = $request->kapasitas;

    if ($request->hasFile('kamar_img')) {
        if ($kamar->kamar_img && \Storage::exists('public/' . $kamar->kamar_img)) {
            \Storage::delete('public/' . $kamar->kamar_img);
        }
        $kamar->kamar_img = $request->file('kamar_img')->store('kamar_img', 'public');
    }

    $kamar->save();

    return back()->with('success', 'Kamar berhasil diperbarui.');
}







// Admin/RoomController.php

public function index(Request $request)
{
    $search = $request->search;

    $kamars = Kamar::with(['kategori', 'sewaDetail'])
        ->when($search, function ($query) use ($search) {
            $query->where('kamar_nama', 'like', "%$search%")
                ->orWhere('kamar_no', 'like', "%$search%")
                ->orWhere('kamar_harga', 'like', "%$search%")
                ->orWhere('kamar_lantai', 'like', "%$search%")
                ->orWhere('kamar_kapasitas', 'like', "%$search%")
                ->orWhere('kamar_rating', 'like', "%$search%")
                ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('kategori_nama', 'like', "%$search%")
                    ->orwhere('kategori_deskripsi', 'like', "%$search%");
                });
        })
        ->paginate(3)
        ->appends(['search' => $search]); // penting agar pagination bawa query search
    $categories = Kategori::all();


    return view('pages.admin.datakamar', compact('kamars', 'categories'));
}


public function destroy(Kamar $kamar)
{
    $kamar->delete();
    return back()->with('delete', 'Kamar berhasil dihapus.');
}

}
