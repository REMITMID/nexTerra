<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Diperlukan untuk Auth::check()

class EducationController extends Controller
{
    // Index (Untuk Publik) - Menentukan View berdasarkan Role
    public function index()
    {
        $education_items = Education::latest()->get();
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.education.index', compact('education_items'));
        }
        return view('user.education.index', compact('education_items'));
    }

    // Create - Menampilkan form tambah (Hanya Admin)
    public function create()
    {
        return view('admin.education.create');
    }

    // Store - Menyimpan data baru (Hanya Admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('education', 'public');
        }

        Education::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('education.index')->with('success', 'Konten edukasi berhasil ditambahkan.');
    }
    
    // Show - Menampilkan form edit (Hanya Admin, karena route publik sudah ada)
    public function show(Education $education)
    {
        // Karena route admin menggunakan show untuk edit, kita arahkan ke form edit
        if (Auth::check() && Auth::user()->role === 'admin') {
            // dd($education['id']);
            return view('admin.education.edit', ['item' => $education]);
        }
        // Jika bukan admin, tampilkan view detail publik
        return view('user.education.show', ['item' => $education]);
    }

    // Update - Memproses form edit (Hanya Admin)
    public function update(Request $request, Education $education)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'image']);

        if ($request->hasFile('image')) {
            if ($education->image_path) {
                Storage::disk('public')->delete($education->image_path);
            }
            $data['image_path'] = $request->file('image')->store('education', 'public');
        } else {
            // Penting: jika tidak ada file baru, kita pastikan kolom image_path tidak dihapus
            $data['image_path'] = $education->image_path; 
        }

        $education->update($data);

        return redirect()->route('education.index')->with('success', 'Konten edukasi berhasil diperbarui.');
    }

    // Destroy - Menghapus data (Hanya Admin)
    public function destroy(Education $education)
    {
        if ($education->image_path) {
            Storage::disk('public')->delete($education->image_path);
        }

        $education->delete();

        return redirect()->route('education.index')->with('success', 'Konten edukasi berhasil dihapus.');
    }
}