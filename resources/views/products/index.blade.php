<x-app-layout>
    <x-slot name="header">
        <!-- Judul Katalog dengan warna Pink -->
        <h2 class="font-bold text-2xl leading-tight" style="color: #DB2777;">
            {{ __('Katalog Produk StyleGirl') }}
        </h2>
    </x-slot>

    <!-- Background halaman dirubah menjadi pink sangat muda (Rose) -->
    <div class="py-12" style="background-color: #FDF2F8; min-height: 100vh;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Box utama dengan garis atas Pink -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl" style="border-top: 4px solid #F472B6;">
                <div class="p-8 text-gray-900">
                    
                    <!-- TOMBOL TAMBAH PRODUK & KEMBALI YANG SUDAH DIRAPIKAN -->
                    <div class="flex items-center gap-4 mb-8">
                        <a href="{{ route('products.create') }}" style="background-color: #EC4899; color: white;" class="px-6 py-2.5 rounded font-bold shadow-md hover:opacity-80 transition duration-300 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            + Tambah Produk Baru
                        </a>
                        
                        <a href="{{ url('/') }}" style="background-color: #4B5563; color: white;" class="px-6 py-2.5 rounded font-bold shadow-md hover:opacity-80 transition duration-300 flex items-center gap-2">
                            &larr; Kembali ke Beranda
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="p-4 mb-6 rounded-lg font-bold" style="background-color: #FCE7F3; color: #9D174D; border: 1px solid #FBCFE8;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr style="background-color: #FCE7F3; color: #9D174D;">
                                    <th class="py-4 px-4 rounded-tl-lg">Gambar</th>
                                    <th class="py-4 px-4">Nama Produk</th>
                                    <th class="py-4 px-4">Harga</th>
                                    <th class="py-4 px-4">Stok</th>
                                    <th class="py-4 px-4">Ukuran</th>
                                    <th class="py-4 px-4 rounded-tr-lg">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: #FCE7F3;">
                                @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="py-3 px-4">
                                        <img src="{{ asset($product->gambar) }}" alt="{{ $product->nama }}" class="w-16 h-16 object-cover rounded-lg shadow-sm" style="border: 1px solid #FBCFE8;">
                                    </td>
                                    <td class="py-3 px-4 font-bold text-gray-700">{{ $product->nama }}</td>
                                    <td class="py-3 px-4 font-bold" style="color: #DB2777;">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="bg-gray-100 text-gray-800 py-1 px-3 rounded-full text-sm font-bold">{{ $product->stok }}</span>
                                    </td>
                                    <!-- DATA UKURAN -->
                                    <td class="py-3 px-4">
                                        <span class="text-sm text-gray-600 font-semibold">{{ $product->ukuran }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="font-bold px-3 py-1.5 rounded transition" style="background-color: #FCE7F3; color: #DB2777;">Edit</a>
                                            
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-bold px-3 py-1.5 rounded transition text-red-700 bg-red-100 hover:bg-red-200">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>