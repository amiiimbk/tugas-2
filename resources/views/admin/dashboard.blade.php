<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - StyleGirl</title>
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-light">

    <!-- Navbar Admin -->
    <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
        <div class="container">
            <span class="navbar-brand fw-bold text-brand fs-3">StyleGirl - Admin Panel</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Halo, Mutiara (Admin)</span>
                <!-- Tombol kembali ke Beranda Utama -->
                <a href="{{ url('/') }}" class="btn btn-brand text-white btn-sm rounded-pill px-3 fw-bold">← Kembali ke Website</a>
            </div>
        </div>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 p-5 rounded-4">
                    <h2 class="fw-bold text-dark mb-3">Selamat Datang di Dashboard Admin!</h2>
                    <p class="text-secondary mb-4">Akun <strong>mutiaramarsella6@gmail.com</strong> berhasil dikenali sebagai Administrator resmi toko StyleGirl.</p>
                    <hr class="mb-4">
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 bg-white shadow-sm border">
                                <h5 class="fw-bold text-brand mb-2">Kelola Produk</h5>
                                <p class="text-muted small mb-3">Tambah, edit, atau hapus koleksi dress dan pakaian wanita.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-brand text-white fw-bold w-100 rounded-pill">Buka Manajemen Produk</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 bg-white shadow-sm border">
                                <h5 class="fw-bold text-brand mb-2">Laporan Pesanan</h5>
                                <p class="text-muted small mb-3">Lihat riwayat pesanan yang masuk melalui keranjang WhatsApp.</p>
                                <button class="btn btn-outline-secondary w-100 rounded-pill" disabled>Segera Hadir</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="custom-navbar text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-1 fw-bold text-dark">&copy; 2026 StyleGirl Admin</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>