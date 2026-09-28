let produkAktif = null;
let keranjang = [];

function bukaDetail(nama, harga, deskripsi, gambar) {
    produkAktif = { nama, harga, deskripsi, gambar };

    document.getElementById('detail-nama').innerText = nama;
    document.getElementById('detail-harga').innerText = 'Rp ' + harga.toLocaleString('id-ID');
    document.getElementById('detail-deskripsi').innerText = deskripsi;
    document.getElementById('detail-img').src = gambar;
    document.getElementById('detail-qty').value = 1;

    sembunyikanSemua();
    document.getElementById('detail-page').style.display = 'block';
    window.scrollTo(0, 0);
}

function tambahKeKeranjang() {
    if (!produkAktif) return;

    const ukuran = document.getElementById('detail-ukuran').value;
    const warna = document.getElementById('detail-warna').value;
    const qty = parseInt(document.getElementById('detail-qty').value) || 1;

    let itemAda = keranjang.find(item => 
        item.nama === produkAktif.nama && item.ukuran === ukuran && item.warna === warna
    );

    if (itemAda) {
        itemAda.qty += qty;
    } else {
        keranjang.push({
            nama: produkAktif.nama,
            harga: produkAktif.harga,
            gambar: produkAktif.gambar,
            ukuran: ukuran,
            warna: warna,
            qty: qty
        });
    }

    updateBadgeKeranjang();
    alert('Produk berhasil ditambahkan ke keranjang!');
    tampilKeranjang();
}

function updateBadgeKeranjang() {
    let totalItem = keranjang.reduce((sum, item) => sum + item.qty, 0);
    document.getElementById('jumlah-keranjang').innerText = totalItem;
}

function tampilKeranjang() {
    sembunyikanSemua();
    document.getElementById('keranjang-page').style.display = 'block';
    window.scrollTo(0, 0);

    let tbody = document.getElementById('isi-keranjang');
    tbody.innerHTML = '';

    if (keranjang.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4">Keranjang belanjaan kamu masih kosong.</td></tr>';
        document.getElementById('total-belanja').innerText = 'Rp 0';
        return;
    }

    let totalSemua = 0;

    keranjang.forEach((item, index) => {
        let subtotal = item.harga * item.qty;
        totalSemua += subtotal;

        tbody.innerHTML += `
            <tr>
                <td>
                    <div class="d-flex align-items-center gap-3">
                        <img src="${item.gambar}" style="width: 60px; height: 60px; object-fit: cover;" class="rounded-3">
                        <div>
                            <h6 class="fw-bold mb-0">${item.nama}</h6>
                            <small class="text-muted">Warna: ${item.warna} | Ukuran: <b>${item.ukuran}</b></small>
                        </div>
                    </div>
                </td>
                <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                <td>${item.qty}</td>
                <td class="fw-bold text-brand">Rp ${subtotal.toLocaleString('id-ID')}</td>
                <td>
                    <button class="btn btn-sm btn-outline-danger" onclick="hapusItem(${index})">Hapus</button>
                </td>
            </tr>
        `;
    });

    document.getElementById('total-belanja').innerText = 'Rp ' + totalSemua.toLocaleString('id-ID');
}

function hapusItem(index) {
    keranjang.splice(index, 1);
    updateBadgeKeranjang();
    tampilKeranjang();
}

function checkoutWA() {
    if (keranjang.length === 0) {
        alert('Keranjang belanjaan kamu masih kosong!');
        return;
    }

    let nomorAdmin = "6285773447091"; 
    let pesan = "Halo Kak, saya ingin memesan produk dari *StyleGirl*:%0A%0A";
    let totalSemua = 0;

    keranjang.forEach((item, index) => {
        let subtotal = item.harga * item.qty;
        totalSemua += subtotal;
        pesan += `${index + 1}. *${item.nama}*%0A`;
        pesan += `   - Warna: ${item.warna}%0A`;
        pesan += `   - Ukuran: ${item.ukuran}%0A`;
        pesan += `   - Jumlah: ${item.qty} pcs%0A`;
        pesan += `   - Subtotal: Rp ${subtotal.toLocaleString('id-ID')}%0A%0A`;
    });

    pesan += `*Total Keseluruhan: Rp ${totalSemua.toLocaleString('id-ID')}*%0A%0A`;
    pesan += "Mohon info selanjutnya ya Kak. Terima kasih!";

    let urlWA = `https://wa.me/${nomorAdmin}?text=${pesan}`;
    window.open(urlWA, '_blank');
}

function tampilBeranda() {
    sembunyikanSemua();
    document.getElementById('beranda-page').style.display = 'block';
}

function tampilKatalog() {
    sembunyikanSemua();
    document.getElementById('katalog-page').style.display = 'block';
}

function tampilTentang() {
    sembunyikanSemua();
    document.getElementById('tentang-page').style.display = 'block';
}

function sembunyikanSemua() {
    document.getElementById('beranda-page').style.display = 'none';
    document.getElementById('katalog-page').style.display = 'none';
    document.getElementById('detail-page').style.display = 'none';
    document.getElementById('tentang-page').style.display = 'none';
    document.getElementById('keranjang-page').style.display = 'none';
    document.getElementById('login-page').style.display = 'none';
    window.scrollTo(0, 0);
}