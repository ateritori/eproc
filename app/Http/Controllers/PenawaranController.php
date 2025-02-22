<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Penawaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenawaranController extends Controller
{
    public function create($id)
    {
        $lelang = Lelang::findOrFail($id);
        return view('user.submit_penawaran', compact('lelang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lelang_id' => 'required|exists:lelangs,id',
            'harga_penawaran' => 'required|numeric|min:1000',
            'file_dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file
        $path = $request->file('file_dokumen')->store('penawaran_files', 'public');

        Penawaran::create([
            'lelang_id' => $request->lelang_id,
            'user_id' => Auth::id(),
            'harga_penawaran' => $request->harga_penawaran,
            'file_dokumen' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Penawaran berhasil dikirim!');
    }
}
