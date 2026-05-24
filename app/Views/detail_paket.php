<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .detail-header { background-color: #0b5345; color: white; padding: 40px 0; }
        .info-card { border: none; border-radius: 15px; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .btn-whatsapp { background-color: #25d366; color: white; font-weight: 600; border-radius: 30px; }
        .btn-whatsapp:hover { background-color: #20ba5a; color: white; }
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
                    
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Durasi Perjalanan</small>
                                <h5 class="fw-bold mb-0 text-dark"><i class="fas fa-calendar-alt text-success me-2"></i><?= $p['durasi']; ?> Hari</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block mb-1">Akomodasi Hotel</small>
                                <h5 class="fw-bold mb-0 text-warning">
                                    <?php for($i=0; $i<$p['hotel_bintang']; $i++): ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                    <span class="text-dark small fw-normal ms-1">(Bintang <?= $p['hotel_bintang']; ?>)</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <small class="text-muted d-block">Maskapai Penerbangan</small>
                                <span class="fw-bold fs-5 text-dark">
                                    <i class="fas fa-plane text-success me-2"></i><?= $p['maskapai'] ?? 'Tidak ditentukan'; ?>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <small class="text-muted d-block">Kota Keberangkatan</small>
                                <span class="fw-bold fs-5 text-dark">
                                    <i class="fas fa-map-marker-alt text-success me-2"></i><?= $p['kota_keberangkatan'] ?? 'Tidak ditentukan'; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold mt-4 mb-3">Sudah Termasuk (Includes):</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-unstyled row row-cols-1 row-cols-md-2 g-2">
                                <?php 
                                if (!empty($p['includes'])) {
                                // Memecah teks database berdasarkan baris baru (Enter)
                                $rincian = explode("\n", str_replace("\r", "", $p['includes']));
                                foreach ($rincian as $item) {
                                    if (trim($item) != "") {
                                        echo '<li class="col"><i class="fas fa-check text-success me-2"></i>' . esc($item) . '</li>';
                                    }
                                }
                                } else {
                                    // Tampilan cadangan jika admin lupa mengisi rincian di database
                                    echo '<li class="col-12 text-muted opacity-75">Rincian fasilitas belum dimasukkan oleh admin.</li>';
                                }
                                ?>
                            </ul>
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
                        // Mengatur teks pesan otomatis saat WA dibuka
                        $pesanWA = rawurlencode("Assalamualaikum, saya tertarik dengan Paket *" . $p['nama_paket'] . "* dari travel *" . $travel['nama_travel'] . "* melalui website Agregator Umroh Jatim. Mohon info detail keberangkatannya.");
                    ?>
                    <a href="https://api.whatsapp.com/send?phone=6282111357776&text=<?= $pesanWA; ?>" target="_blank" class="btn btn-whatsapp w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                        <i class="fab fa-whatsapp fa-lg me-2"></i> Hubungi via WhatsApp
                    </a>
                    <small class="text-muted" style="font-size: 0.75rem;">Anda akan langsung terhubung dengan representatif resmi travel.</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>