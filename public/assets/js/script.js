// Variabel Global
let keranjang = [];
let hargaAktif = 0;

// Fungsi Menangani Navigasi SPA
function sembunyikanSemuaHalaman() {
    document.getElementById('beranda-page').style.display = 'none';
    document.getElementById('katalog-page').style.display = 'none';
    document.getElementById('detail-page').style.display = 'none';
    document.getElementById('tentang-page').style.display = 'none';
    document.getElementById('keranjang-page').style.display = 'none';
}

function tampilBeranda() {
    sembunyikanSemuaHalaman();
    document.getElementById('beranda-page').style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function tampilKatalog() {
    sembunyikanSemuaHalaman();
    document.getElementById('katalog-page').style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function tampilTentang() {
    sembunyikanSemuaHalaman();
    document.getElementById('tentang-page').style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function tampilKeranjang() {
    sembunyikanSemuaHalaman();
    document.getElementById('keranjang-page').style.display = 'block';
    renderKeranjang();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Fungsi Buka Detail Produk
function bukaDetail(nama, harga, deskripsi, imgUrl) {
    sembunyikanSemuaHalaman();
    document.getElementById('detail-page').style.display = 'block';
    
    hargaAktif = harga;
    document.getElementById('detail-nama').innerText = nama;
    document.getElementById('detail-harga').innerText = "Rp " + harga.toLocaleString('id-ID');
    document.getElementById('detail-deskripsi').innerText = deskripsi;
    
    // Panggil gambar lokal
    let imgEl = document.getElementById('detail-img');
    imgEl.src = imgUrl;
    imgEl.onerror = function() {
        this.src = 'assets/images/default.jpg';
    };

    // Reset Form Input Detail
    document.getElementById('detail-qty').value = 1;
    document.getElementById('detail-ukuran').selectedIndex = 0;
    document.getElementById('detail-warna').selectedIndex = 0;
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Fungsi Tambah Keranjang
function tambahKeKeranjang() {
    let nama = document.getElementById('detail-nama').innerText;
    let ukuran = document.getElementById('detail-ukuran').value;
    let warna = document.getElementById('detail-warna').value;
    let qty = parseInt(document.getElementById('detail-qty').value);
    
    // Validasi Qty Minimal 1
    if (qty < 1 || isNaN(qty)) {
        alert("Jumlah barang minimal 1!");
        return;
    }

    let total = hargaAktif * qty;

    keranjang.push({
        nama: nama,
        ukuran: ukuran,
        warna: warna,
        qty: qty,
        hargaSatuan: hargaAktif,
        totalHarga: total
    });

    document.getElementById('jumlah-keranjang').innerText = keranjang.length;
    alert("Produk berhasil ditambahkan ke keranjang!");
    tampilKatalog(); 
}

// Fungsi Render Tabel Keranjang
function renderKeranjang() {
    let tbody = document.getElementById('isi-keranjang');
    tbody.innerHTML = '';
    let totalBelanja = 0;

    if (keranjang.length === 0) {
        // Colspan diubah menjadi 6 karena ada kolom aksi tambahan
        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">Keranjang Anda masih kosong. Yuk belanja!</td></tr>';
        document.getElementById('total-belanja').innerText = "Rp 0";
        return;
    }

    for (let i = 0; i < keranjang.length; i++) {
        let item = keranjang[i];
        totalBelanja += item.totalHarga;
        
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="fw-bold text-dark">${item.nama}</td>
            <td>${item.warna}, Size ${item.ukuran}</td>
            <td>Rp ${item.hargaSatuan.toLocaleString('id-ID')}</td>
            <td>${item.qty}</td>
            <td class="fw-bold text-brand">Rp ${item.totalHarga.toLocaleString('id-ID')}</td>
            <td><button class="btn btn-danger btn-sm fw-bold" onclick="hapusDariKeranjang(${i})">Hapus</button></td>
        `;
        tbody.appendChild(tr);
    }

    document.getElementById('total-belanja').innerText = "Rp " + totalBelanja.toLocaleString('id-ID');
}

// Fungsi Hapus Barang dari Keranjang
function hapusDariKeranjang(index) {
    // Menghapus 1 item dari array keranjang berdasarkan index
    keranjang.splice(index, 1);
    
    // Perbarui jumlah pada navbar
    document.getElementById('jumlah-keranjang').innerText = keranjang.length;
    
    // Render ulang tabel keranjang
    renderKeranjang();
}

// Fungsi Checkout Akhir via WhatsApp
function checkoutWA() {
    if (keranjang.length === 0) {
        alert("Keranjang Anda kosong! Silakan pilih produk terlebih dahulu.");
        return;
    }

    let noWA = "6285773447091";
    
    let pesan = "Halo StyleGirl, saya ingin memesan produk berikut:%0A%0A";
    let totalBelanja = 0;

    for (let i = 0; i < keranjang.length; i++) {
        let item = keranjang[i];
        pesan += `${i+1}. *${item.nama}*%0A`;
        pesan += `   Varian: ${item.warna}, Size ${item.ukuran}%0A`;
        pesan += `   Jumlah: ${item.qty} pcs%0A`;
        pesan += `   Subtotal: Rp ${item.totalHarga.toLocaleString('id-ID')}%0A%0A`;
        totalBelanja += item.totalHarga;
    }

    pesan += `*Total Keseluruhan: Rp ${totalBelanja.toLocaleString('id-ID')}*%0A%0A`;
    pesan += "Apakah stok barang pesanan saya ini masih tersedia?";
    
    window.open(`https://wa.me/${noWA}?text=${pesan}`, '_blank');
    
    keranjang = [];
    document.getElementById('jumlah-keranjang').innerText = "0";
    tampilBeranda();
}