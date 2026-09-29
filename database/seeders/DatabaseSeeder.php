<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun Admin
        User::create([
            'name' => 'Mutiara',
            'email' => 'mutiaramarsella6@gmail.com',
            'password' => Hash::make('mutiaramb19'),
        ]);

        // Isi data produk beserta stok dan ukuran
        Product::insert([
            [
                'nama' => 'Pastel Pink Dress',
                'harga' => 250000,
                'stok' => 15,
                'ukuran' => 'S, M, L, XL', // <-- Tambahan kolom ukuran
                'rating' => '4.8',
                'deskripsi' => 'Dress cantik berwarna pink pastel.',
                'gambar' => 'assets/images/dress2.jpeg',
            ],
            [
                'nama' => 'Soft Blue Elegant Dress',
                'harga' => 275000,
                'stok' => 10,
                'ukuran' => 'S, M, L', // <-- Tambahan kolom ukuran
                'rating' => '4.9',
                'deskripsi' => 'Dress biru muda dengan desain elegan.',
                'gambar' => 'assets/images/dress3.jpeg',
            ],
            [
                'nama' => 'Floral Summer Dress',
                'harga' => 210000,
                'stok' => 25,
                'ukuran' => 'All Size', // <-- Tambahan kolom ukuran
                'rating' => '4.7',
                'deskripsi' => 'Dress dengan motif bunga yang ceria.',
                'gambar' => 'assets/images/dress4.jpeg',
            ],
            [
                'nama' => 'Casual White Midi',
                'harga' => 230000,
                'stok' => 12,
                'ukuran' => 'M, L, XL', // <-- Tambahan kolom ukuran
                'rating' => '4.8',
                'deskripsi' => 'Midi dress berwarna putih bersih yang simpel.',
                'gambar' => 'assets/images/dress5.jpeg',
            ],
            [
                'nama' => 'Classic Black Dress',
                'harga' => 299000,
                'stok' => 8,
                'ukuran' => 'S, M, L, XL', // <-- Tambahan kolom ukuran
                'rating' => '5.0',
                'deskripsi' => 'Dress hitam klasik untuk acara malam.',
                'gambar' => 'assets/images/dress6.jpeg',
            ],
            [
                'nama' => 'Mermaid Hem Maxi Dress',
                'harga' => 320000,
                'stok' => 5,
                'ukuran' => 'M, L', // <-- Tambahan kolom ukuran
                'rating' => '4.9',
                'deskripsi' => 'Maxi dress dengan potongan mermaid.',
                'gambar' => 'assets/images/Mermaid Hem_Maxi_Dress.jpeg',
            ]
        ]);
    }
}