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

    try {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika password diisi, update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        // Notifikasi sukses
        return redirect()->route('profil')->with('success', 'Akun berhasil diperbarui.');
    } catch (\Exception $e) {
        // Notifikasi error
        return redirect()->route('profil')->with('error', 'Terjadi kesalahan saat memperbarui akun.');
    }
}
}
