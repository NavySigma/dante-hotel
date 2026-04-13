<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kategori;
use App\Models\Sewa;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'totalKamar' => Kamar::count(),
            'totalKategori' => Kategori::count(),
            'totalSewa' => Sewa::count(),
        ]);
    }
}
