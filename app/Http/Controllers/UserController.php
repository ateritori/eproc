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

    // 🔹 Menampilkan halaman edit akun user
    public function editAccount()
    {
        $user = Auth::user();
        return view('user.edit_account', compact('user'));
    }

    // 🔹 Mengupdate akun user setelah form disubmit
    public function updateAccount(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(), // Email unik
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Ambil data user yang login
        $user = Auth::user();

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('profil')->with('success', 'Akun berhasil diperbarui.');
    }
}
