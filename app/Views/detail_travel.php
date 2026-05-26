<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style> //3
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .travel-header {
            background: linear-gradient(135deg, #0b5345 0%, #117a65 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 25px 25px;
        }
        .legalitas-card {
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .paket-card { 
            border: none; 
            border-radius: 15px; 
            transition: all 0.3s; 
            background: white;
        }
        .paket-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 25px rgba(11,83,69,0.1) !important;
        }
        .price-tag {
            background-color: rgba(11,83,69,0.1);
            color: #0b5345;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 8px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="p-5 text-center text-white position-relative" style="background-color: #0b5345; border-radius: 0 0 30px 30px;">
    <div class="py-3">
        <div class="bg-white text-success d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem;">
            <i class="fas fa-mosque"></i>
        </div>
        
        <h1 class="fw-bold mb-1"><?= $travel['nama_travel']; ?></h1>
        
        <p class="text-warning fw-semibold mb-3" style="font-size: 1.1rem; letter-spacing: 0.5px;">
            <i class="fas fa-balance-scale me-1"></i> <?= !empty($travel['nama_pt']) ? $travel['nama_pt'] : 'Nama PT Belum Diatur'; ?>
        </p>
        
        <p class="mb-0 opacity-75 small">
            <i class="fas fa-map-marker-alt me-1"></i> Kantor Cabang / Pusat: <?= $travel['kota_asal']; ?>, Jawa Timur
        </p>
    </div>
    </div>

    <div class="container mt-4">
    <a href="/" class="btn btn-sm btn-outline-secondary rounded-pill mb-4 px-3"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold text-success mb-3"><i class="fas fa-id-card me-2"></i>Legalitas Agen</h5>
                
                <div class="mb-3">
                    <label class="text-muted small d-block">Status Kemenag</label>
                    <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold px-2 py-1 small">
                        <i class="fas fa-check-circle me-1"></i> Terverifikasi PPIU Resmi
                    </span>
                </div>

                <div class="mb-4">
                    <label class="text-muted small d-block">Nomor SK Kemenag</label>
                    <span class="fw-bold text-dark"><?= $travel['sk_kemenag']; ?></span>
                </div>

                <div class="pt-3 border-top border-light">
                    <h5 class="fw-bold text-success mb-2"><i class="fas fa-map-marked-alt me-2"></i>Alamat Lengkap</h5>
                    <p class="text-muted small lh-base mb-0">
                        <?= !empty($travel['alamat_travel']) ? nl2br($travel['alamat_travel']) : 'Alamat kantor resmi belum diisi oleh pihak travel.'; ?>
                    </p>
                </div>
            </div>
        </div>
            <div class="col-md-8">
                <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-box-open text-success me-2"></i>Paket Umroh dari <?= $travel['nama_travel']; ?></h4>

                <div class="row">
                    <?php if (empty($paket)): ?>
                        <div class="col-12 text-center py-5 bg-white rounded-3 shadow-sm">
                            <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                            <p class="text-muted mb-0">Saat ini belum ada paket aktif yang dirilis oleh travel ini.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($paket as $p) : ?>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 paket-card shadow-sm p-2">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-3" style="color: #117a65;"><?= $p['nama_paket']; ?></h5>
                                        
                                        <div class="price-tag mb-3">
                                            Rp<?= number_format($p['harga'], 0, ',', '.'); ?>
                                        </div>

                                        <div class="text-muted small">
                                            <p class="mb-2"><i class="fas fa-calendar-alt text-warning me-2"></i>Durasi Perjalanan: <strong><?= $p['durasi']; ?> Hari</strong></p>
                                            <p class="mb-3"><i class="fas fa-hotel text-warning me-2"></i>Fasilitas Akomodasi: 
                                                <?php for($i=0; $i<$p['hotel_bintang']; $i++): ?>
                                                    <i class="fas fa-star" style="color: #d4af37; font-size: 0.75rem;"></i>
                                                <?php endfor; ?>
                                            </p>
                                        </div>
                                        
                                        <a href="/paket/<?= $p['id']; ?>" class="btn btn-outline-success w-100 rounded-pill btn-sm fw-bold">
                                            Lihat Detail Paket
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>