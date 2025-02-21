<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Lelang;

class UserController extends Controller
{
    // 🔹 Menampilkan halaman dashboard
    public function dashboard(Request $request)
    {
        $query = Lelang::query();
        $user = Auth::user(); // Ambil data user yang sedang login

        // Filter pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('jenis_pekerjaan', 'LIKE', "%$search%")
                  ->orWhere('pagu', 'LIKE', "%$search%")
                  ->orWhere('tahun', 'LIKE', "%$search%");
        }

        // Ambil data lelang dengan pagination
        $lelang = $query->paginate(10);

        // Kirim ke view
        return view('user.dashboard', compact('lelang'));
    }

    // 🔹 Menampilkan profil pengguna & vendor
    public function profil()
    {
        $user = Auth::user();
        $vendor = $user->vendor; // Ambil data vendor

        return view('user.profil', compact('user', 'vendor'));
    }

    public function edit($id)
{
    // Ambil data user berdasarkan ID
    $user = User::findOrFail($id);

    // Kirim data user ke view edit
    return view('user.edit', compact('user'));
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    // Cari user berdasarkan ID
    $user = User::findOrFail($id);

    // Cek apakah email berubah
    $emailChanged = $user->email !== $request->input('email');

    // Update data user
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Jika password diisi, update passwordnya
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    // Jika email berubah, logout user dan redirect ke halaman login
    if ($emailChanged) {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Email berhasil diperbarui. Silakan login kembali.');
    }

    // Redirect ke profil jika tidak ada perubahan email
    return redirect()->route('profil')->with('success', 'Akun berhasil diperbarui');
}

public function editVendor($id_vendor)
{
    $vendor = Vendor::where('id_vendor', $id_vendor)->firstOrFail();
    return view('user.edit_vendor', compact('vendor'));
}

public function updateVendor(Request $request, $id_vendor)
{
    // Validasi input
    $request->validate([
        'pemilik' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
        'pic' => 'required|string|max:255',
        'hp_pic' => 'required|string|max:15',
        'bidang' => 'required|string|max:255',
        'berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        'legalitas' => 'nullable|string|max:255',
        'total_proyek' => 'nullable|integer|min:0',
    ]);

    // Cari vendor berdasarkan ID
    $vendor = Vendor::where('id_vendor', $id_vendor)->firstOrFail();

    // Update data vendor
    $vendor->update([
        'pemilik' => $request->input('pemilik'),
        'alamat' => $request->input('alamat'),
        'telepon' => $request->input('telepon'),
        'pic' => $request->input('pic'),
        'hp_pic' => $request->input('hp_pic'),
        'bidang' => $request->input('bidang'),
        'berdiri' => $request->input('berdiri'),
        'legalitas' => $request->input('legalitas'),
        'total_proyek' => $request->input('total_proyek'),
    ]);

    return redirect()->route('profil')->with('success', 'Profil vendor berhasil diperbarui');
}

public function createPenawaran($id)
{
    $lelang = Lelang::findOrFail($id);
    return view('user.submit_penawaran', compact('lelang'));
}

public function storePenawaran(Request $request, $id)
{
    $request->validate([
        'harga_penawaran' => 'required|numeric|min:1000',
        'file_penawaran' => 'required|mimes:pdf|max:2048',
    ]);

    $filePath = $request->file('file_penawaran')->store('penawaran', 'public');

    Penawaran::create([
        'lelang_id' => $id,
        'user_id' => Auth::id(),
        'harga_penawaran' => $request->harga_penawaran,
        'file_penawaran' => $filePath,
    ]);

    return redirect()->route('dashboard')->with('success', 'Penawaran berhasil dikirim.');
}
}
