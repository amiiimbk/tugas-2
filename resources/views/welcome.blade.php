<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleGirl - Fashion Wanita</title>
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="bg-light">

    <!-- Header & Navigasi -->
    <nav class="navbar navbar-expand-lg custom-navbar fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-brand fs-3" href="#" onclick="tampilBeranda()">StyleGirl</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link fw-bold text-dark nav-pointer" onclick="tampilBeranda()">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-dark nav-pointer" onclick="tampilKatalog()">Katalog Produk</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-dark nav-pointer" onclick="tampilTentang()">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-dark nav-pointer" onclick="tampilKeranjang()">🛒 Keranjang (<span id="jumlah-keranjang" class="text-danger">0</span>)</a></li>
                    
                    <!-- Menu Autentikasi -->
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-brand rounded-pill px-4 fw-bold text-white nav-pointer" onclick="tampilLogin()">Login</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle fw-bold text-brand nav-pointer" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Halo, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger fw-bold">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer untuk Fixed Navbar -->
    <div style="padding-top: 76px;"></div>

    <!-- HALAMAN 1: BERANDA -->
    <div id="beranda-page">
        <section class="hero-section py-5">
            <div class="container text-center py-5">
                <h2 class="display-4 fw-bold text-dark">Pancarkan Pesona Anggunmu</h2>
                <p class="lead text-secondary mb-4">Eksplorasi koleksi pakaian wanita premium dengan warna pastel yang lembut.</p>
                <button class="btn btn-brand btn-lg rounded-pill px-4" onclick="tampilKatalog()">Lihat Katalog Lengkap</button>
            </div>
        </section>

        <section class="container py-5">
            <h2 class="text-center text-brand fw-bold mb-5">Produk Unggulan Kami</h2>
            <div class="row g-4">
                @foreach (collect($products)->take(3) as $item)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <img src="{{ asset($item['gambar']) }}" class="card-img-top product-img" alt="{{ $item['nama'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $item['nama'] }}</h5>
                            <p class="card-text text-muted mb-2">Rp {{ number_format($item['harga'], 0, ',', '.') }} <br>⭐ {{ $item['rating'] }}/5</p>
                            <button class="btn w-100 btn-lihat" onclick="bukaDetail('{{ $item['nama'] }}', {{ $item['harga'] }}, '{{ $item['deskripsi'] }}', '{{ asset($item['gambar']) }}')">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- HALAMAN 2: KATALOG LENGKAP -->
    <div id="katalog-page" style="display: none;">
        <section class="container py-5">
            <h2 class="text-center text-brand fw-bold mb-5">Katalog Lengkap Pakaian</h2>
            <div class="row g-4">
                @foreach ($products as $item)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <img src="{{ asset($item['gambar']) }}" class="card-img-top product-img" alt="{{ $item['nama'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold">{{ $item['nama'] }}</h5>
                            <p class="card-text text-muted mb-2">Rp {{ number_format($item['harga'], 0, ',', '.') }} <br>⭐ {{ $item['rating'] }}/5</p>
                            <button class="btn w-100 btn-lihat" onclick="bukaDetail('{{ $item['nama'] }}', {{ $item['harga'] }}, '{{ $item['deskripsi'] }}', '{{ asset($item['gambar']) }}')">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- HALAMAN 3: DETAIL PRODUK -->
    <div id="detail-page" style="display: none;">
        <section class="container py-5">
            <button class="btn btn-link text-decoration-none text-brand fw-bold mb-4 px-0" onclick="tampilKatalog()">← Kembali ke Katalog</button>
            <div class="card shadow-sm border-0 p-4 rounded-4">
                <div class="row g-5 align-items-center">
                    <div class="col-md-5">
                        <img id="detail-img" src="" class="img-fluid rounded-4 w-100" alt="Detail Produk">
                    </div>
                    <div class="col-md-7">
                        <h2 id="detail-nama" class="fw-bold text-dark">Nama Produk</h2>
                        <h3 id="detail-harga" class="text-brand fw-bold mb-3">Rp 0</h3>
                        <p id="detail-deskripsi" class="text-muted">Deskripsi produk.</p>
                        <hr class="my-4">
                        
                        <!-- Pilihan Varian Warna -->
                        <div class="mb-3">
                            <label for="detail-warna" class="form-label fw-bold">Pilih Varian Warna:</label>
                            <select class="form-select" id="detail-warna">
                                <option value="Sesuai Foto">Sesuai Foto (Default)</option>
                                <option value="Pastel Pink">Pastel Pink</option>
                                <option value="Soft Black">Soft Black</option>
                            </select>
                        </div>

                        <!-- Pilihan Ukuran (Size) -->
                        <div class="mb-3">
                            <label for="detail-ukuran" class="form-label fw-bold">Pilih Ukuran (Size):</label>
                            <select class="form-select" id="detail-ukuran">
                                <option value="S">Small (S)</option>
                                <option value="M">Medium (M)</option>
                                <option value="L">Large (L)</option>
                                <option value="XL">Extra Large (XL)</option>
                            </select>
                        </div>

                        <!-- Jumlah Qty -->
                        <div class="mb-4">
                            <label for="detail-qty" class="form-label fw-bold">Jumlah (Quantity):</label>
                            <input type="number" class="form-control" id="detail-qty" value="1" min="1">
                        </div>

                        <button class="btn btn-brand btn-lg w-100 fw-bold rounded-3 text-white" onclick="tambahKeKeranjang()">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- HALAMAN 4: TENTANG KAMI -->
    <div id="tentang-page" style="display: none;">
        <section class="container py-5">
            <h2 class="text-center text-brand fw-bold mb-5">Tentang StyleGirl</h2>
            <div class="row g-5 align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/images/tentang-stylegirl.png') }}" class="img-fluid rounded-4 shadow-sm w-100" alt="Tentang StyleGirl">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold text-dark mb-3">Gaya Pastel untuk Wanita Modern</h3>
                    <p class="text-muted" style="line-height: 1.8;">StyleGirl adalah brand fashion lokal yang berfokus pada pakaian wanita dengan nuansa warna pastel yang lembut, feminim, dan elegan.</p>
                </div>
            </div>
        </section>
    </div>

    <!-- HALAMAN 5: KERANJANG BELANJA -->
    <div id="keranjang-page" style="display: none;">
        <section class="container py-5">
            <h2 class="text-center text-brand fw-bold mb-5">Keranjang Belanja</h2>
            <div class="card shadow-sm border-0 p-4 rounded-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="isi-keranjang">
                            <!-- Data keranjang via JS -->
                        </tbody>
                    </table>
                </div>
                <!-- Tombol Checkout via WhatsApp -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                    <h4 class="fw-bold text-dark mb-0">Total: <span id="total-belanja" class="text-brand">Rp 0</span></h4>
                    <button class="btn btn-success btn-lg fw-bold px-4 rounded-3 text-white" onclick="checkoutWA()">
                        🛒 Checkout via WhatsApp
                    </button>
                </div>
            </div>
        </section>
    </div>

    <!-- HALAMAN 6: LOGIN -->
    <div id="login-page" style="display: none;">
        <section class="container py-5">
            <div class="row w-100 align-items-center justify-content-between">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h1 class="display-3 fw-bold text-brand">Stylegirl</h1>
                    <p class="lead text-secondary mt-3 mb-4">
                        Temukan berbagai koleksi dress dan gaya terbaik khusus untukmu di sini. Tampil cantik dan percaya diri setiap hari!
                    </p>
                    <div class="d-flex gap-3">
                        <img src="{{ asset('assets/images/dress2.jpeg') }}" class="img-fluid rounded-4 shadow-sm" style="width: 160px; height: 220px; object-fit: cover;">
                        <img src="{{ asset('assets/images/dress3.jpeg') }}" class="img-fluid rounded-4 shadow-sm" style="width: 160px; height: 220px; object-fit: cover;">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-5">
                            <h3 class="mb-4 fw-bold text-center">Masuk ke Akun</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label text-muted">Email</label>
                                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label text-muted">Password</label>
                                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label text-muted" for="remember">Ingat Saya</label>
                                </div>
                                <button type="submit" class="btn btn-brand btn-lg w-100 rounded-pill fw-bold text-white">Log in</button>
                            </form>
                            @if (Route::has('register'))
                            <div class="mt-4 text-center">
                                <p class="mb-0 text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-brand">Daftar di sini</a></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="custom-navbar text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-1 fw-bold text-dark">&copy; 2026 StyleGirl</p>
        </div>
    </footer>

    <!-- Bootstrap JS & Custom Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
        function tampilLogin() {
            document.getElementById('beranda-page').style.display = 'none';
            document.getElementById('katalog-page').style.display = 'none';
            document.getElementById('detail-page').style.display = 'none';
            document.getElementById('tentang-page').style.display = 'none';
            document.getElementById('keranjang-page').style.display = 'none';
            document.getElementById('login-page').style.display = 'block';
        }

        @if($errors->any())
            document.addEventListener("DOMContentLoaded", function() {
                tampilLogin();
            });
        @endif
    </script>
</body>
</html>