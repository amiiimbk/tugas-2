<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama Produk</label>
                            <input type="text" name="nama" id="nama" value="{{ $product->nama }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="harga" class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                            <input type="number" name="harga" id="harga" value="{{ $product->harga }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="stok" class="block font-medium text-sm text-gray-700">Stok</label>
                            <input type="number" name="stok" id="stok" value="{{ $product->stok }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="ukuran" class="block font-medium text-sm text-gray-700">Pilihan Ukuran (Pisahkan dengan koma)</label>
                            <input type="text" name="ukuran" id="ukuran" value="{{ $product->ukuran }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>{{ $product->deskripsi }}</textarea>
                        </div>

                        <!-- TOMBOL UPLOAD DIPERBAIKI AGAR KELIHATAN -->
                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700 mb-2">Gambar Saat Ini</label>
                            <img src="{{ asset($product->gambar) }}" class="w-32 h-32 object-cover rounded mb-2 border">
                            
                            <label for="gambar" class="block font-medium text-sm text-gray-700 mt-4 mb-2">Upload Gambar Baru (Opsional)</label>
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 p-1" accept="image/*">
                            <small class="text-gray-500 mt-1 block">Biarkan kosong jika kamu tidak ingin mengubah gambarnya.</small>
                        </div>

                        <!-- TOMBOL KEMBALI DIPERJELAS -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-bold">Simpan Perubahan</button>
                            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700 font-bold">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>