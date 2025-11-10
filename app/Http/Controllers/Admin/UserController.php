<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua pengguna
    public function index()
    {
        // Ambil semua pengguna kecuali yang memiliki role 'admin'
        // Jika Anda ingin menampilkan admin juga, hapus .where('role', '!=', 'admin')
        $users = User::where('role', '!=', 'admin')->latest()->get(); 

        return view('admin.users.index', compact('users'));
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        // Pencegahan: Jangan biarkan admin menghapus dirinya sendiri atau admin lain
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun Admin.');
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}