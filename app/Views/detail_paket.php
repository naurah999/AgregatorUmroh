<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style> //2
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .detail-header { background-color: #0b5345; color: white; padding: 40px 0; }
        .info-card { border: none; border-radius: 15px; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .btn-whatsapp { background-color: #25d366; color: white; font-weight: 600; border-radius: 30px; }
        .btn-whatsapp:hover { background-color: #20ba5a; color: white; }
        .card-jemaah { border-left: 4px solid #198754; background-color: #f8f9fa; }
        .kuitansi-border { border: 2px dashed #198754; background: #fff; border-radius: 10px; }

        /* ========================================================
           CSS KHUSUS CETAK PDF (PRINT MEDIA)
           ======================================================== */
        @media print {
            /* 1. Sembunyikan seluruh isi halaman web utama */
            body * {
                visibility: hidden;
            }
            
            /* 2. Hanya tampilkan area modal kuitansi */
            #modalPemesanan,
            #modalPemesanan .modal-content,
            #modalPemesanan #stepKuitansi,
            #modalPemesanan #stepKuitansi .kuitansi-border,
            #modalPemesanan #stepKuitansi .kuitansi-border * {
                visibility: visible;
            }

            /* 3. Sembunyikan tombol aksi cetak, tombol tutup, dan silang modal */
            #modalPemesanan .btn-close,
            #modalPemesanan .text-center button,
            #modalPemesanan .text-center a {
                display: none !important;
            }

            /* 4. Atur layout agar pas 1 halaman penuh tanpa margin berantakan */
            #modalPemesanan {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                background: none !important;
            }

            .modal-content {
                border: none !important;
                box-shadow: none !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .kuitansi-border {
                border: 2px dashed #198754 !important;
                margin: 0 !important;
                padding: 20px !important;
                width: 100% !important;
            }
            
            /* Supaya warna latar tabel & badge di print browser berbasis chromium tetap muncul */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

    <div class="detail-header shadow-sm">
        <div class="container">
            <span class="badge bg-warning text-dark mb-2 fw-bold"><i class="fas fa-star me-1"></i> Paket Unggulan</span>
            <h1 class="fw-bold"><?= $p['nama_paket']; ?></h1>
            <p class="mb-0 opacity-75"><i class="fas fa-building me-2"></i>Diselenggarakan oleh: <strong><?= $travel['nama_travel']; ?></strong></p>
        </div>
    </div>

    <div class="container mt-4">
        <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill mb-4">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card info-card p-4">
                    <h4 class="fw-bold text-dark mb-4"><i class="fas fa-info-circle text-success me-2"></i>Rincian Fasilitas Paket</h4>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 border-start border-warning border-3">
                                <small class="text-muted d-block mb-1">Tanggal Keberangkatan</small>
                                <h5 class="fw-bold mb-0 text-dark">
                                    <i class="fas fa-calendar-day text-warning me-2"></i>
                                    <?php 
                                    $tgl_display = 'Konfirmasi via Chat';
                                    if (!empty($p['tanggal_keberangkatan']) && $p['tanggal_keberangkatan'] != '0000-00-00') {
                                        $bulan_indo = [
                                            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                            'Juli', 'Agustus', 'September', 'Oktobor', 'November', 'Desember'
                                        ];
                                        $timestamp = strtotime($p['tanggal_keberangkatan']);
                                        $tgl = date('d', $timestamp);
                                        $bln = $bulan_indo[(int)date('m', $timestamp)];
                                        $thn = date('Y', $timestamp);
                                        $tgl_display = $tgl . ' ' . $bln . ' ' . $thn;
                                    }
                                    echo $tgl_display;
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Durasi Perjalanan</small>
                                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-calendar-alt text-success me-2"></i><?= $p['durasi']; ?> Hari</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Akomodasi Hotel</small>
                                <h5 class="fw-bold mb-0 text-warning">
                                    <?php 
                                    $jumlah_bintang = isset($p['hotel_bintang']) ? (int)$p['hotel_bintang'] : 0;
                                    for($i=0; $i<$jumlah_bintang; $i++): 
                                    ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                    <span class="text-dark small fw-normal ms-1">(Bintang <?= $jumlah_bintang; ?>)</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <small class="text-muted d-block">Maskapai Penerbangan</small>
                                <span class="fw-bold fs-6 text-dark">
                                    <i class="fas fa-plane text-success me-2"></i><?= $p['maskapai'] ?? 'Tidak ditentukan'; ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <small class="text-muted d-block">Kota Keberangkatan</small>
                                <span class="fw-bold fs-6 text-dark">
                                    <i class="fas fa-map-marker-alt text-success me-2"></i><?= $p['kota_keberangkatan'] ?? 'Tidak ditentukan'; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold mt-4 mb-3">Sudah Termasuk (Includes):</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col">
                                <ul class="list-unstyled row row-cols-1 row-cols-md-2 g-2">
                                    <?php 
                                    if (!empty($p['includes'])) {
                                        $rincian = explode("\n", str_replace("\r", "", $p['includes']));
                                        foreach ($rincian as $item) {
                                            if (trim($item) != "") {
                                                echo '<li class="col"><i class="fas fa-check text-success me-2"></i>' . htmlspecialchars($item) . '</li>';
                                            }
                                        }
                                    } else {
                                        echo '<li class="col-12 text-muted opacity-75">Rincian fasilitas belum dimasukkan oleh admin.</li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card info-card p-4 text-center sticky-top" style="top: 20px;">
                    <small class="text-muted d-block mb-2">Harga Paket Per Orang</small>
                    <h2 class="fw-bold text-success mb-3">Rp<?= number_format($p['harga'], 0, ',', '.'); ?></h2>
                    <hr class="opacity-25">
                    
                    <div class="text-start bg-light p-3 rounded-3 mb-4" style="font-size: 0.85rem;">
                        <p class="mb-1"><strong>Penyelenggara:</strong> <?= $travel['nama_travel']; ?></p>
                        <p class="mb-0"><strong>No. SK Kemenag:</strong> <?= !empty($travel['sk_kemenag']) ? $travel['sk_kemenag'] : '-'; ?></p>
                    </div>

                    <?php 
                        $tgl_wa = (!empty($p['tanggal_keberangkatan']) && $p['tanggal_keberangkatan'] != '0000-00-00') ? date('d-m-Y', strtotime($p['tanggal_keberangkatan'])) : 'Konfirmasi via Chat';
                        $pesanWA = rawurlencode("Assalamualaikum, saya tertarik dengan Paket *" . $p['nama_paket'] . "* keberangkatan tanggal *" . $tgl_wa . "* melalui website Agregator Umroh Jatim.");
                    ?>
                    
                    <a href="https://api.whatsapp.com/send?phone=6282111357776&text=<?= $pesanWA; ?>" target="_blank" class="btn btn-whatsapp w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center mb-2">
                        <i class="fab fa-whatsapp fa-lg me-2"></i> Hubungi via WhatsApp
                    </a>
                    
                    <button type="button" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mb-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPemesanan">
                        <i class="fas fa-shopping-cart me-2"></i> Pesan Paket Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPemesanan" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalPemesananLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="modalPemesananLabel">Formulir Pemesanan Paket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="checkReset()"></button>
                </div>
                <div class="modal-body">
                    
                    <div id="stepDataDiri">
                        <h6 class="fw-bold mb-3 text-success"><i class="fas fa-users text-success me-2"></i>Langkah 1: Data Lengkap Jemaah</h6>
                        
                        <div id="wrapperJemaah">
                            <div class="card card-jemaah p-3 mb-3 item-jemaah position-relative shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                                    <span class="fw-bold text-success judul-jemaah"><i class="fas fa-user me-1"></i> Data Jemaah 1</span>
                                    <button type="button" class="btn btn-sm btn-outline-danger border-0" disabled><i class="fas fa-trash"></i></button>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="small fw-bold text-muted mb-1">Nama Lengkap (Sesuai KTP)</label>
                                        <input type="text" class="form-control input-nama" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small fw-bold text-muted mb-1">Nomor NIK (KTP)</label>
                                        <input type="number" class="form-control input-nik" required oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold text-muted mb-1">No. HP Jemaah (Opsional)</label>
                                        <input type="tel" class="form-control input-hp">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold text-muted mb-1">Usia (Tahun)</label>
                                        <input type="number" class="form-control input-usia" min="1" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small fw-bold text-muted mb-1">Alamat Domisili</label>
                                        <input type="text" class="form-control input-alamat" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill mb-4" onclick="tambahFormJemaah()">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Jemaah Lagi
                        </button>

                        <div class="mb-3 border-top pt-3">
                            <label class="form-label fw-bold text-dark">Nomor WhatsApp Penanggung Jawab Kontak</label>
                            <input type="tel" id="inputNoHp" class="form-control" placeholder="Contoh: 081234567" required>
                        </div>

                        <input type="hidden" id="inputJumlahJemaah" value="1">
                        <button type="button" class="btn btn-success w-100 mt-3 fw-bold" onclick="pindahKePembayaran()">Berikutnya ke Pembayaran <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>

                    <div id="stepPembayaran" style="display: none;">
                        <h6 class="fw-bold mb-3 text-success"><i class="fas fa-credit-card text-success me-2"></i>Langkah 2: Metode Pembayaran</h6>
                        
                        <div class="bg-light p-3 rounded mb-3 border">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Harga Paket Base:</span>
                                <span class="fw-bold" id="textHargaAsli" data-harga="<?= $p['harga']; ?>">
                                    Rp <?= number_format($p['harga'], 0, ',', '.'); ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-danger">
                                <span>PPN (15%):</span>
                                <span id="textPpn">Rp 0</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between text-success fw-bold fs-5">
                                <span>Total Bayar:</span>
                                <span id="textTotalBayar">Rp 0</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Bank Virtual Account (VA)</label>
                            <select id="pilihBank" class="form-select" onchange="generateKodeVA()">
                                <option value="">-- Pilih Bank --</option>
                                <option value="900">Bank Syariah Indonesia (BSI)</option>
                                <option value="888">Bank BRI Virtual Account (BRIVA)</option>
                                <option value="002">Bank Mandiri Livin' VA</option>
                                <option value="014">Bank BCA Virtual Account</option>
                            </select>
                        </div>

                        <div id="boxVirtualAccount" class="bg-success-subtle border border-success p-3 rounded text-center mb-3" style="display: none;">
                            <small class="text-muted d-block uppercase fw-bold" id="namaBankTerpilih">KODE VIRTUAL ACCOUNT</small>
                            <span class="fs-3 fw-bold text-success" id="kodeVaRandom">00000000000000</span>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-secondary w-50 fw-bold" onclick="kembaliKeDataDiri()"><i class="fas fa-arrow-left me-2"></i> Kembali</button>
                            <button type="button" class="btn btn-success w-50 fw-bold" onclick="konfirmasiSelesai()">Selesai Pesan <i class="fas fa-check-circle ms-2"></i></button>
                        </div>
                    </div>

                    <div id="stepKuitansi" style="display: none;">
                        <div class="text-center mb-3">
                            <i class="fas fa-check-circle text-success fa-3x mb-2"></i>
                            <h4 class="fw-bold text-success mb-0">Pembayaran Berhasil!</h4>
                            <p class="text-muted small">Kuitansi Pembayaran Digital Hasil Manifest Sistem</p>
                        </div>

                        <div class="p-4 kuitansi-border mb-4 shadow-sm">
                            <div class="row small mb-3 border-bottom pb-2">
                                <div class="col-6">
                                    <span class="text-muted d-block">Nomor Invoice:</span>
                                    <strong class="text-dark fs-6" id="kwInvoice">INV/2026/0000</strong>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="text-muted d-block">Metode Pembayaran:</span>
                                    <strong id="kwBank" class="text-success">-</strong>
                                </div>
                            </div>

                            <div class="row small mb-3 border-bottom pb-2 bg-light p-2 rounded">
                                <div class="col-6">
                                    <span class="text-muted d-block">Nama Paket:</span>
                                    <strong class="text-dark"><?= $p['nama_paket']; ?></strong>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="text-muted d-block">Tanggal Keberangkatan:</span>
                                    <strong class="text-dark"><i class="fas fa-calendar-alt me-1"></i><?= $tgl_display; ?></strong>
                                </div>
                            </div>

                            <div class="mb-3">
                                <span class="fw-bold text-secondary small d-block mb-2"><i class="fas fa-id-card me-1"></i> MANIFEST JEMAAH TERDAFTAR:</span>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered bg-light align-middle mb-0" style="font-size: 0.8rem;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center" style="width: 5%">No</th>
                                                <th>Nama Lengkap</th>
                                                <th>NIK KTP</th>
                                                <th>No. HP</th>
                                                <th class="text-center">Usia</th>
                                                <th>Alamat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="kwDaftarJemaah">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="bg-success-subtle p-3 rounded border border-success border-opacity-25 mt-3">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>Total Kontingen Jemaah:</span>
                                    <span class="fw-bold text-dark" id="kwTotalJemaah">1 Orang</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold text-success fs-5 border-top pt-2">
                                    <span>TOTAL HARGA LUNAS:</span>
                                    <span id="kwTotalHarga">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm me-2" onclick="window.print()"><i class="fas fa-print me-1"></i> Cetak Dokumen</button>
                            <button type="button" class="btn btn-outline-success rounded-pill px-4 fw-bold" data-bs-dismiss="modal" onclick="location.reload();">Tutup & Keluar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let isSelesai = false;

    function tambahFormJemaah() {
        const wrapper = document.getElementById('wrapperJemaah');
        const jumlahJemaahSaatIni = wrapper.getElementsByClassName('item-jemaah').length + 1;
        const divBaru = document.createElement('div');
        divBaru.className = 'card card-jemaah p-3 mb-3 item-jemaah position-relative shadow-sm';
        divBaru.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                <span class="fw-bold text-success judul-jemaah"><i class="fas fa-user me-1"></i> Data Jemaah ${jumlahJemaahSaatIni}</span>
                <button type="button" class="btn btn-sm btn-danger text-white" onclick="hapusFormJemaah(this)"><i class="fas fa-trash"></i></button>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="small fw-bold text-muted mb-1">Nama Lengkap (Sesuai KTP)</label>
                    <input type="text" class="form-control input-nama" required>
                </div>
                <div class="col-md-6">
                    <label class="small fw-bold text-muted mb-1">Nomor NIK (KTP)</label>
                    <input type="number" class="form-control input-nik" required oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold text-muted mb-1">No. HP Jemaah (Opsional)</label>
                    <input type="tel" class="form-control input-hp">
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold text-muted mb-1">Usia (Tahun)</label>
                    <input type="number" class="form-control input-usia" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold text-muted mb-1">Alamat Domisili</label>
                    <input type="text" class="form-control input-alamat" required>
                </div>
            </div>
        `;
        wrapper.appendChild(divBaru);
        updateJumlahJemaah();
    }

    function hapusFormJemaah(tombol) {
        tombol.closest('.item-jemaah').remove();
        const semuaItem = document.getElementsByClassName('item-jemaah');
        for (let i = 0; i < semuaItem.length; i++) {
            semuaItem[i].querySelector('.judul-jemaah').innerHTML = `<i class="fas fa-user me-1"></i> Data Jemaah ${i + 1}`;
        }
        updateJumlahJemaah();
    }

    function updateJumlahJemaah() {
        document.getElementById('inputJumlahJemaah').value = document.getElementsByClassName('item-jemaah').length;
    }

    function pindahKePembayaran() {
        const noHp = document.getElementById('inputNoHp').value;
        const jumlahJemaah = parseInt(document.getElementById('inputJumlahJemaah').value) || 1;
        const inputsNama = document.getElementsByClassName('input-nama');
        const inputsNik = document.getElementsByClassName('input-nik');
        const inputsUsia = document.getElementsByClassName('input-usia');
        const inputsAlamat = document.getElementsByClassName('input-alamat');
        
        let semuaFormValid = true;
        for (let i = 0; i < inputsNama.length; i++) {
            if (inputsNama[i].value.trim() === "" || inputsNik[i].value.trim() === "" || inputsNik[i].value.length < 16 || inputsUsia[i].value.trim() === "" || inputsAlamat[i].value.trim() === "") {
                semuaFormValid = false; break;
            }
        }

        if (!semuaFormValid || noHp.trim() === "") {
            alert("Harap lengkapi seluruh data wajib jemaah (NIK wajib 16 digit) dan kontak penanggung jawab!");
            return;
        }

        const hargaAsliPerOrang = parseFloat(document.getElementById('textHargaAsli').getAttribute('data-harga'));
        const totalHargaBase = hargaAsliPerOrang * jumlahJemaah;
        const nominalPpn = totalHargaBase * 0.15;
        const grandTotal = totalHargaBase + nominalPpn;

        document.getElementById('textHargaAsli').innerText = "Rp " + formatRupiah(totalHargaBase);
        document.getElementById('textPpn').innerText = "+ Rp " + formatRupiah(nominalPpn);
        document.getElementById('textTotalBayar').innerText = "Rp " + formatRupiah(grandTotal);

        document.getElementById('stepDataDiri').style.display = 'none';
        document.getElementById('stepPembayaran').style.display = 'block';
    }

    function kembaliKeDataDiri() {
        document.getElementById('stepPembayaran').style.display = 'none';
        document.getElementById('stepDataDiri').style.display = 'block';
    }

    function generateKodeVA() {
        const selectBank = document.getElementById('pilihBank');
        if (selectBank.value === "") { document.getElementById('boxVirtualAccount').style.display = 'none'; return; }
        
        let acak = ""; for (let i = 0; i < 10; i++) acak += Math.floor(Math.random() * 10);
        document.getElementById('namaBankTerpilih').innerText = "KODE VA " + selectBank.options[selectBank.selectedIndex].text;
        document.getElementById('kodeVaRandom').innerText = selectBank.value + acak;
        document.getElementById('boxVirtualAccount').style.display = 'block';
    }

    function formatRupiah(angka) { return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); }

    function konfirmasiSelesai() {
        const selectBank = document.getElementById('pilihBank');
        if (selectBank.value === "") { alert("Pilih Bank Virtual Account terlebih dahulu!"); return; }

        const totalHarga = document.getElementById('textTotalBayar').innerText;
        const nomorInvoice = "UMR/2026/" + Math.floor(1000 + Math.random() * 9000);
        
        document.getElementById('kwInvoice').innerText = nomorInvoice;
        document.getElementById('kwBank').innerText = selectBank.options[selectBank.selectedIndex].text;
        document.getElementById('kwTotalHarga').innerText = totalHarga;

        const inputsNama = document.getElementsByClassName('input-nama');
        const inputsNik = document.getElementsByClassName('input-nik');
        const inputsHp = document.getElementsByClassName('input-hp');
        const inputsUsia = document.getElementsByClassName('input-usia');
        const inputsAlamat = document.getElementsByClassName('input-alamat');
        
        let htmlTabel = "";
        for(let i = 0; i < inputsNama.length; i++) {
            htmlTabel += `<tr>
                <td class="text-center fw-bold">${i + 1}</td>
                <td class="fw-bold text-capitalize">${inputsNama[i].value}</td>
                <td>${inputsNik[i].value}</td>
                <td>${inputsHp[i].value.trim() !== "" ? inputsHp[i].value : "-"}</td>
                <td class="text-center">${inputsUsia[i].value} Thn</td>
                <td class="text-muted">${inputsAlamat[i].value}</td>
            </tr>`;
        }
        
        document.getElementById('kwDaftarJemaah').innerHTML = htmlTabel;
        document.getElementById('kwTotalJemaah').innerText = inputsNama.length + " Orang";
        document.getElementById('modalPemesananLabel').innerText = "Kuitansi Pembayaran Digital Resmi";
        document.getElementById('stepPembayaran').style.display = 'none';
        document.getElementById('stepKuitansi').style.display = 'block';
        isSelesai = true;
    }

    function checkReset() { if(isSelesai) location.reload(); }
    </script>
</body>
</html>