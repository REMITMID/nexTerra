<?php

namespace App\Http\Controllers;

use App\Models\EndangeredAnimal;
use App\Models\Map;
use App\Models\MediaPartner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 6 Hewan Langka terbaru
        $animals = EndangeredAnimal::latest()->limit(6)->get(); 
        
        // Ambil 6 Peta/Lokasi terbaru
        $maps = Map::latest()->limit(6)->get();

        // Ambil 4 Media Partner terbaru (BARU)
        $partners = MediaPartner::latest()->limit(4)->get();
        
        // Ambil satu item Edukasi
        $latest_education = \App\Models\Education::latest()->first(); 
        
        return view('user.beranda.index', compact('animals', 'maps', 'latest_education', 'partners')); // Tambahkan 'partners'
    }
}