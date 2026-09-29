<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'ukuran' => 'required|string', // <-- Validasi ukuran
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = '';
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $gambarPath = 'assets/images/' . $filename;
        }

        Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'ukuran' => $request->ukuran, // <-- Simpan ukuran
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product) {}
    
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'ukuran' => 'required|string', // <-- Validasi ukuran
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $product->gambar;
        
        if ($request->hasFile('gambar')) {
            if ($product->gambar && file_exists(public_path($product->gambar))) {
                @unlink(public_path($product->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $gambarPath = 'assets/images/' . $filename;
        }

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'ukuran' => $request->ukuran, // <-- Update ukuran
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }
    
    public function destroy(Product $product)
    {
        if ($product->gambar && file_exists(public_path($product->gambar))) {
            @unlink(public_path($product->gambar));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}