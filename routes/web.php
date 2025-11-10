<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EndangeredAnimalController;


Route::get('/', [HomeController::class, 'index'])->name('beranda');

Route::get('/dashboard', function () {
    // Pengecekan jika user adalah Admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Admin ke Dashboard Admin
    }
    
    // User Biasa diarahkan ke route Beranda Publik (yaitu '/')
    return redirect()->route('beranda'); 
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil (View dan Edit)
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view'); 
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); 
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
});


Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/admin/forum', [ForumController::class, 'index'])->name('admin.forum.index');
    Route::delete('/admin/forum/{discussion}', [ForumController::class, 'destroy'])->name('admin.forum.destroy');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::resource('endangered_animals', EndangeredAnimalController::class)->except(['index', 'show']);
    Route::resource('education', EducationController::class)->except(['index', 'show']);
    Route::resource('news', NewsController::class)->except(['index', 'show']);
    Route::resource('media_partner', MediaPartnerController::class)->except(['index', 'show']);
    Route::resource('map', MapController::class)->except(['index', 'show']);
});


Route::get('endangered_animals', [EndangeredAnimalController::class, 'index'])->name('endangered_animals.index');
Route::get('endangered_animals/{endangeredAnimal}', [EndangeredAnimalController::class, 'show'])->name('endangered_animals.show');

Route::get('education', [EducationController::class, 'index'])->name('education.index');
Route::get('education/{education}', [EducationController::class, 'show'])->name('education.show');

Route::get('news', [NewsController::class, 'index'])->name('news.index');
Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');

Route::get('map', [MapController::class, 'index'])->name('map.index');
Route::get('map/{map}', [MapController::class, 'show'])->name('map.show');

Route::get('media_partner', [MediaPartnerController::class, 'index'])->name('media_partner.index');
Route::get('media_partner/{mediaPartner}', [MediaPartnerController::class, 'show'])->name('media_partner.show');

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

// Route Otentikasi Bawaan (Login, Register, Logout)
require __DIR__.'/auth.php';