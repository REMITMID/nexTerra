<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ForumController extends Controller
{
    // [R]ead - Menampilkan daftar diskusi (Fungsi ganda Admin/User)
    public function index()
    {
        // Ambil semua diskusi (dengan relasi user)
        $discussions = Discussion::with('user')->latest()->get(); 
        
        if (Auth::check() && Auth::user()->role === 'admin') {
            // ADMIN VIEW (Tabel Manajemen)
            return view('admin.forum.index', compact('discussions'));
        }

        // USER VIEW (Feed Diskusi)
        return view('user.forum.index', compact('discussions')); 
    }

    // [C]reate - Menyimpan diskusi baru (Hanya user yang login)
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required_without:image|string|nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Maks 5MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('discussion_images', 'public');
        }

        Discussion::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('forum.index')->with('success', 'Diskusi berhasil diposting!');
    }

    // Menghapus diskusi
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return redirect()->route('admin.forum.index')->with('success', 'Diskusi berhasil dihapus.');
    }
}