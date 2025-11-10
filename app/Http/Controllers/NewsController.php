<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news_items = News::latest()->get();
        
        // Cek Role untuk menentukan View mana yang dimuat
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Admin View (Grid dengan tombol Tambah/Edit)
            return view('admin.news.index', compact('news_items'));
        }
        // User View (Tampilan publik)
        return view('user.news.index', compact('news_items'));
    }

    // [BARU] Tambahkan method edit() untuk melengkapi route CRUD admin
    public function edit(News $news)
    {
        return view('admin.news.edit', ['item' => $news]);
    }
    
    public function show(News $news)
    {
        // Cek Role untuk menentukan View mana yang dimuat
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Admin View (Form Edit/Update)
            return view('admin.news.edit', ['item' => $news]);
        }
        // User View (Tampilan detail publik)
        return view('user.news.show', ['item' => $news]);
    }
    // [C]reate - Menampilkan form tambah (Admin Create)
    public function create()
    {
        return view('admin.news.create');
    }

    // [C]reate - Menyimpan berita baru (Admin Store)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('news_posters', 'public');
        }

        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'poster_path' => $posterPath,
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    // [U]pdate - Mengupdate data berita (Admin Update)
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'poster']);

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            if ($news->poster_path) {
                Storage::disk('public')->delete($news->poster_path);
            }
            $data['poster_path'] = $request->file('poster')->store('news_posters', 'public');
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // [D]elete - Menghapus berita (Admin Destroy)
    public function destroy(News $news)
    {
        // Hapus poster dari storage
        if ($news->poster_path) {
            Storage::disk('public')->delete($news->poster_path);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }
}