<?php

namespace App\Http\Controllers;

use App\Models\EndangeredAnimal;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
public function index()
    {
        $maps = Map::latest()->get();
        
        // KUNCI: Cek Role
        if (auth()->check() && auth()->user()->role === 'admin') {
            // ADMIN VIEW (manajemen CRUD)
            return view('admin.map.index', compact('maps'));
        }
        
        // USER VIEW (tampilan publik, daftar peta)
        return view('user.map.index', compact('maps')); 
    }

    public function show(Map $map)
    {
        // Ambil Hewan Langka yang terkait dengan Peta ini
        $animals = EndangeredAnimal::where('map_id', $map->id)->latest()->get();

        // Cek Role
        if (auth()->check() && auth()->user()->role === 'admin') {
            // ADMIN VIEW (Form Edit)
            return view('admin.map.edit', compact('map'));
        }
        
        // USER VIEW (tampilan detail publik)
        return view('user.map.show', compact('map', 'animals')); 
    }

    public function create()
    {
        return view('admin.map.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('maps', 'public');

        Map::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('map.index')->with('success', 'Peta/Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, Map $map)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'image']);

        // --- Bagian yang diperbaiki ---
        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada)
            if ($map->image_path) {
                Storage::disk('public')->delete($map->image_path);
            }
            // Simpan path gambar baru
            $data['image_path'] = $request->file('image')->store('maps', 'public');
        } else {
            // JIKA TIDAK ADA GAMBAR BARU, PERTAHANKAN PATH GAMBAR LAMA
            $data['image_path'] = $map->image_path; 
        }
        // -----------------------------

        $map->update($data);

        return redirect()->route('map.index')->with('success', 'Peta/Lokasi berhasil diperbarui.');
    }


    public function destroy(Map $map)
    {
        if ($map->image_path) {
            Storage::disk('public')->delete($map->image_path);
        }

        $map->delete();

        return redirect()->route('map.index')->with('success', 'Peta/Lokasi berhasil dihapus.');
    }
}