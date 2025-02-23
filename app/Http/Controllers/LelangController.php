<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;

class LelangController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search')); // Hilangkan spasi di awal/akhir

        $lelang = Lelang::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('jenis_pekerjaan', 'like', "%$search%")
                      ->orWhere('pagu', 'like', "%$search%")
                      ->orWhere('rincian', 'like', "%$search%")
                      ->orWhere('tahun', 'like', "%$search%");
                });
            })
            ->orderByDesc('id')
            ->paginate(8)
            ->appends(['search' => $search]); // Agar parameter tetap ada saat paginasi

        return view('home', compact('lelang'));
    }
}
