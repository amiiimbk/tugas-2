<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Frontend Utama (StyleGirl)
Route::get('/', function () {
    $products = [
        [
            'nama' => 'Mermaid Hem Maxi Dress',
            'harga' => 550000,
            'rating' => '5.0',
            'deskripsi' => 'Gaun elegan dengan potongan mermaid di bagian bawah.',
            'gambar' => 'assets/images/Mermaid Hem_Maxi_Dress.jpeg'
        ],
        [
            'nama' => 'Elegant pink floral bodycon dress',
            'harga' => 350000,
            'rating' => '4.8',
            'deskripsi' => 'Gaun motif floral bernuansa pink yang manis.',
            'gambar' => 'assets/images/dress2.jpeg'
        ],
        [
            'nama' => 'Ruffle Dress',
            'harga' => 400000,
            'rating' => '4.9',
            'deskripsi' => 'Dress kasual dengan aksen lipatan ruffle.',
            'gambar' => 'assets/images/dress3.jpeg'
        ],
        [
            'nama' => 'Black Ribbed Knit Dress',
            'harga' => 500000,
            'rating' => '4.7',
            'deskripsi' => 'Gaun rajut hitam bertekstur ribbed.',
            'gambar' => 'assets/images/dress4.jpeg'
        ],
        [
            'nama' => 'Girlism Vestido Long',
            'harga' => 370000,
            'rating' => '4.8',
            'deskripsi' => 'Long dress santai berbahan jatuh.',
            'gambar' => 'assets/images/dress5.jpeg'
        ],
        [
            'nama' => 'Chic Black Bodycon Maxi Dress',
            'harga' => 599000,
            'rating' => '5.0',
            'deskripsi' => 'Gaun maxi bodycon berwarna hitam pekat.',
            'gambar' => 'assets/images/dress6.jpeg'
        ]
    ];

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