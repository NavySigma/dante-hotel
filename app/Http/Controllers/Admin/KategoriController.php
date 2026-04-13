<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::withCount('kamars')->paginate(4);
        return view('pages.admin.kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error_modal', 'tambah');
        }

        Kategori::create([
            'kategori_nama' => $request->kategori_nama,
            'kategori_deskripsi' => $request->kategori_deskripsi,
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
{
        $validator = Validator::make($request->all(), [
        'kategori_nama' => 'required|string|max:255|unique:kategori,kategori_nama,' . $kategori->kategori_id . ',kategori_id',
        'kategori_deskripsi' => 'required|string',
    ]);

    // Jika error → jangan tutup modal EDIT
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error_modal', 'edit')
            ->with('edit_id', $kategori->kategori_id); // Kirim ID agar JavaScript bisa reopen modal dengan data yang benar
    }

    $kategori->update([
        'kategori_nama' => $request->kategori_nama,
        'kategori_deskripsi' => $request->kategori_deskripsi,
    ]);

    return redirect()->route('kategori.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}


    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('delete', 'Kategori berhasil dihapus.');
    }
}
