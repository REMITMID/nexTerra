<?php

namespace App\Http\Controllers;

use App\Models\MediaPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaPartnerController extends Controller
{
    // [R]ead - Menampilkan daftar mitra (Admin Index)
    public function index()
    {
        $partners = MediaPartner::latest()->get();
        return view('admin.media_partner.index', compact('partners'));
    }

    // [C]reate - Menampilkan form tambah (Admin Create)
    public function create()
    {
        return view('admin.media_partner.create');
    }

    // [C]reate - Menyimpan mitra baru (Admin Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Logo wajib saat tambah
        ]);

        $logoPath = $request->file('logo')->store('partner_logos', 'public');

        MediaPartner::create([
            'name' => $request->name,
            'link' => $request->link,
            'logo_path' => $logoPath,
        ]);

        return redirect()->route('media_partner.index')->with('success', 'Media Partner berhasil ditambahkan.');
    }

    // [U]pdate - Menampilkan detail/form edit (Admin Show/Edit)
    public function show(MediaPartner $mediaPartner)
    {
        return view('admin.media_partner.edit', ['partner' => $mediaPartner]);
    }

    // [U]pdate - Mengupdate data mitra (Admin Update)
    public function update(Request $request, MediaPartner $mediaPartner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Logo tidak wajib saat update
        ]);

        $data = $request->except(['_token', '_method', 'logo']);

        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($mediaPartner->logo_path) {
                Storage::disk('public')->delete($mediaPartner->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('partner_logos', 'public');
        }

        $mediaPartner->update($data);

        return redirect()->route('media_partner.index')->with('success', 'Data Media Partner berhasil diperbarui.');
    }

    // [D]elete - Menghapus mitra (Admin Destroy)
    public function destroy(MediaPartner $mediaPartner)
    {
        // Hapus logo dari storage
        if ($mediaPartner->logo_path) {
            Storage::disk('public')->delete($mediaPartner->logo_path);
        }

        $mediaPartner->delete();

        return redirect()->route('media_partner.index')->with('success', 'Media Partner berhasil dihapus.');
    }
}