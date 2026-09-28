<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleGirl - Daftar Akun</title>
    <!-- Framework Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            background-color: #fdfbfb;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body>

    <!-- Header & Navigasi Khusus Halaman Auth -->
    <nav class="navbar navbar-expand-lg custom-navbar fixed-top shadow-sm">
        <div class="container">
            <!-- Link kembali ke beranda -->
            <a class="navbar-brand fw-bold text-brand fs-3" href="{{ url('/') }}">StyleGirl</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="{{ url('/') }}">← Kembali ke Beranda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer untuk Fixed Navbar -->
    <div style="padding-top: 100px;"></div>

    <section class="container flex-grow-1 py-4">
        <div class="row w-100 align-items-center justify-content-between">
            <!-- BAGIAN KIRI -->
            <div class="col-md-6 mb-5 mb-md-0">
                <h1 class="display-3 fw-bold text-brand">Bergabunglah!</h1>
                <p class="lead text-secondary mt-3 mb-4">
                    Buat akun StyleGirl kamu sekarang dan nikmati kemudahan berbelanja koleksi dress pastel terbaik kami.
                </p>
                <div class="d-flex gap-3">
                    <img src="{{ asset('assets/images/dress5.jpeg') }}" class="img-fluid rounded-4 shadow-sm" style="width: 160px; height: 220px; object-fit: cover;" alt="Dress StyleGirl">
                    <img src="{{ asset('assets/images/dress6.jpeg') }}" class="img-fluid rounded-4 shadow-sm" style="width: 160px; height: 220px; object-fit: cover;" alt="Dress StyleGirl">
                </div>
            </div>

            <!-- BAGIAN KANAN: Form Register -->
            <div class="col-md-5">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">
                        <h3 class="mb-4 fw-bold text-center">Buat Akun Baru</h3>
                        
                        <!-- Form mengarah ke route register bawaan Laravel -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="name" class="form-label text-muted">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-muted">Email</label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Masukkan email aktif">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label text-muted">Password</label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required placeholder="Buat password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label text-muted">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" class="form-control form-control-lg" name="password_confirmation" required placeholder="Ulangi password">
                            </div>

                            <button type="submit" class="btn btn-brand btn-lg w-100 rounded-pill fw-bold text-white">Daftar Sekarang</button>
                        </form>
                        
                        <!-- Link ke Halaman Login -->
                        <div class="mt-4 text-center">
                            <p class="mb-0 text-muted">Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-brand">Log in di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="custom-navbar text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-1 fw-bold text-dark">&copy; 2026 StyleGirl</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>