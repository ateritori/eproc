<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lelang; // Pastikan model Lelang di-import
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan halaman dashboard dengan data lelang
    public function dashboard(Request $request)
    {
        $query = Lelang::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where('jenis_pekerjaan', 'LIKE', "%$search%")
                  ->orWhere('pagu', 'LIKE', "%$search%")
                  ->orWhere('tahun', 'LIKE', "%$search%");
        }

        // Ambil data lelang dengan pagination
        $lelang = $query->paginate(10);

        // Kembalikan tampilan dashboard vendor dengan data lelang
        return view('vendor.dashboard', compact('lelang'));
    }

    // Menampilkan halaman profil pengguna
    public function profil()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('vendor.profil', compact('user'));
    }

    // Halaman untuk mengedit akun pengguna
    public function editAccount()
    {
        // Ambil data akun pengguna yang sedang login
        $user = Auth::user();
        return view('vendor.edit_account', compact('user')); // Perbaikan tampilan menjadi 'vendor.edit_account'
    }

    // Untuk mengupdate akun setelah form disubmit
    public function updateAccount(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(), // Email tidak boleh duplikat selain milik pengguna saat ini
        ]);

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Update data pengguna
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika ada password yang diubah, update passwordnya
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Akun berhasil diperbarui');
    }
}