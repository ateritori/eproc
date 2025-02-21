<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    // Menampilkan daftar lelang dengan pagination
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lelang = Lelang::when($search, function ($query) use ($search) {
                return $query->where('jenis_pekerjaan', 'like', "%$search%")
                             ->orWhere('pagu', 'like', "%$search%")
                             ->orWhere('rincian', 'like', "%$search%")
                             ->orWhere('tahun', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->paginate(8); // Menampilkan 10 record per halaman

        return view('home', compact('lelang'));
    }

    // Menangani pengiriman RFQ (Request for Quotation)
    public function submitRFQ($id)
    {
        // Jika user belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mengikuti lelang.');
        }

        $lelang = Lelang::findOrFail($id);
        return view('submit_rfq', compact('lelang'));
    }
}