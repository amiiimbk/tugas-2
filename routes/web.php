<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Product; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Frontend Utama (StyleGirl)
Route::get('/', function () {
    // Mengambil semua data produk langsung dari database
    $products = Product::all();

    return view('welcome', compact('products'));
})->name('home');

// Alihkan Dashboard bawaan Laravel kembali ke Frontend
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Khusus Admin (Hanya untuk mutiaramarsella6@gmail.com)
Route::get('/admin/dashboard', function () {
    if (auth()->check() && auth()->user()->email === 'mutiaramarsella6@gmail.com') {
        return view('admin.dashboard');
    }
    return redirect('/')->with('error', 'Anda bukan admin!');
})->middleware(['auth'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';