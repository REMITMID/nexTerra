<?php

namespace App\Http\Controllers;

use App\Models\EndangeredAnimal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class EndangeredAnimalController extends Controller
{
    // [R]ead - Menampilkan daftar hewan langka (Hanya Admin)
    public function index()
    {
        $animals = EndangeredAnimal::with('map')->latest()->get(); // Ambil juga relasi map
        
        // Cek Role untuk menentukan View mana yang dimuat
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.endangered_animals.index', compact('animals'));
        }
        // USER VIEW (tampilan publik, daftar semua hewan)
        return view('user.endangered_animals.index', compact('animals')); 
    }
    
    public function show(EndangeredAnimal $endangeredAnimal)
    {
        // Cek Role untuk menentukan View mana yang dimuat
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.endangered_animals.edit', ['animal' => $endangeredAnimal]);
        }
        // USER VIEW (tampilan detail publik)
        return view('user.endangered_animals.show', ['animal' => $endangeredAnimal]);
    }

    // [C]reate - Menampilkan form untuk menambah hewan langka (Hanya Admin)
    public function create()
    {
        return view('admin.endangered_animals.create');
    }

    // [C]reate - Menyimpan hewan langka baru (Hanya Admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'map_id' => 'required|exists:maps,id',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $imagePath = $request->file('image')->store('animals', 'public');

        EndangeredAnimal::create([
            'name' => $request->name,
            'map_id' => $request->map_id,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('endangered_animals.index')->with('success', 'Hewan langka berhasil ditambahkan.');
    }

    // [U]pdate - Mengupdate data hewan langka (Hanya Admin)
    public function update(Request $request, EndangeredAnimal $endangeredAnimal)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'map_id' => 'required|exists:maps,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['map_id'] = $request->map_id;

        if ($request->hasFile('image')) {
            if ($endangeredAnimal->image_path) {
                Storage::disk('public')->delete($endangeredAnimal->image_path);
            }
            $data['image_path'] = $request->file('image')->store('animals', 'public');
        }

        $endangeredAnimal->update($data);

        return redirect()->route('endangered_animals.index')->with('success', 'Data hewan langka berhasil diperbarui.');
    }

    // [D]elete - Menghapus hewan langka (Hanya Admin)
    public function destroy(EndangeredAnimal $endangeredAnimal)
    {
        if ($endangeredAnimal->image_path) {
            Storage::disk('public')->delete($endangeredAnimal->image_path);
        }

        $endangeredAnimal->delete();

        return redirect()->route('endangered_animals.index')->with('success', 'Hewan langka berhasil dihapus.');
    }
}