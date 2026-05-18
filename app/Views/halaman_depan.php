<!DOCTYPE html>
<html lang="id">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        html {
        scroll-behavior: smooth; /* Membuat efek scroll meluncur dengan halus */
        scroll-padding-top: 80px; /* Biar judul section tidak tertutup oleh navbar yang melayang */
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6; /* Abu-abu sangat muda biar bersih */
        }

        /* CSS untuk Jumbotron/Hero Section */
        .hero-section { 
            background: linear-gradient(135deg, #0b5345 0%, #117a65 100%); /* Gradasi Hijau Umroh */
            color: white; 
            padding: 80px 0;
            border-radius: 0 0 30px 30px; /* Lengkungan di bawah */
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    
        .hero-section h1 {
            font-weight: 700;
            letter-spacing: -1px;
        }

        /* CSS untuk Link Login Admin agar rapi */
        .admin-link-wrapper {
            margin-top: -20px; /* Menaikkan sedikit */
            margin-bottom: 30px;
        }

        .admin-link {
            background: white;
            padding: 8px 20px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            color: #117a65 !important;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
    
        .admin-link:hover {
            background: #f4f7f6;
            transform: translateY(-2px);
        }

        /* CSS untuk Form Filter */
        .filter-card {
            border: none;
            border-radius: 15px;
            transform: translateY(-50px); /* Membuat form "melayang" di atas jumbotron */
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        }
    
        .form-label {
            font-weight: 600;
            color: #0b5345;
            font-size: 0.9rem;
        }

        /* CSS untuk Card Paket */
        .paket-card { 
            border: none; 
            border-radius: 15px; 
            transition: all 0.3s ease-in-out; 
            background: white;
            overflow: hidden;
        }
    
        .paket-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 35px rgba(11,83,69,0.1) !important;
        }
    
        .paket-title {
            font-weight: 600;
            color: #117a65;
        }
    
        .travel-name {
            font-size: 0.85rem;
            color: #7f8c8d;
            margin-bottom: 15px;
        }
    
        /* Badge harga dan icon */
        .price-tag {
            background-color: rgba(11,83,69,0.1);
            color: #0b5345;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 5px 10px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 10px;
        }
    
        .info-list i {
            color: #d4af37; /* Gold untuk icon */
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
    </style>
    <meta charset="UTF-8">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #0b5345;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="fas fa-kaaba text-warning me-2"></i>UmrohJatim.com
        </a>
        <button class="navbar-expand-lg navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#biro-travel">Mitra Biro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#paket-rekomendasi">Rekomendasi Paket</a>
            </li>
        </ul>

            <div class="d-flex align-items-center">
                <?php if (session()->get('logged_in')) : ?>
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle btn-sm fw-bold rounded-pill px-3" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> Halo, <?= session()->get('nama'); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownMenuButton">
                            <?php if (session()->get('role') == 'admin') : ?>
                                <li><a class="dropdown-menu-item dropdown-item fw-bold text-success" href="/admin"><i class="fas fa-user-shield me-2"></i>Panel Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            <li><a class="dropdown-menu-item dropdown-item text-danger" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <a href="/login" class="btn btn-outline-light btn-sm rounded-pill px-4 fw-bold">
                        <i class="fas fa-sign-in-alt me-1"></i> Masuk Akun
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </nav>
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-5 mb-3 fw-bold">Agregator Umroh Jawa Timur</h1>
            <p class="lead opacity-75">Cari paket terbaik atau jelajahi paket langsung dari Biro Travel resmi pilihan Anda.</p>
        </div>
    </div>

    <div class="container">
        <div class="card filter-card mb-4 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3" style="color: #0b5345;"><i class="fas fa-search me-2"></i>Pencarian Pintar</h5>
                <form action="/" method="get" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Maksimal Budget (Rp)</label>
                        <input type="number" name="budget" class="form-control" placeholder="Contoh: 35000000" value="<?= isset($_GET['budget']) ? $_GET['budget'] : '' ?>">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Durasi (Hari)</label>
                        <select name="durasi" class="form-select">
                            <option value="">Semua Durasi</option>
                            <option value="9" <?= (isset($_GET['durasi']) && $_GET['durasi'] == '9') ? 'selected' : '' ?>>9 Hari</option>
                            <option value="12" <?= (isset($_GET['durasi']) && $_GET['durasi'] == '12') ? 'selected' : '' ?>>12 Hari</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100 fw-bold">Cari Paket</button>
                    </div>
                </form>
            </div>
        </div>

        <section id="biro-travel" class="py-5">
            <h4 class="fw-bold mb-2 text-dark"><i class="fas fa-building text-success me-2"></i>Biro Travel Resmi Jawa Timur</h4>
            <p class="text-muted small mb-4">Pilih biro travel untuk melihat profil legalitas dan daftar paket khusus yang mereka sediakan.</p>
            
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <?php foreach ($travel as $t) : ?>
                    <div class="col">
                        <a href="/travel/<?= $t['id']; ?>" class="text-decoration-none">
                            <div class="card h-100 text-center border-0 shadow-sm p-3 bg-white" style="border-radius: 12px; transition: transform 0.2s;">
                                <div class="card-body p-2">
                                    <div class="mb-3 mx-auto d-flex align-items-center justify-content-center bg-light text-success rounded-circle" style="width: 60px; height: 60px;">
                                        <i class="fas fa-mosque fa-lg"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1"><?= $t['nama_travel']; ?></h6>
                                    <span class="badge bg-secondary-subtle text-secondary px-2 py-1" style="font-size: 0.75rem;">
                                        <i class="fas fa-map-marker-alt me-1"></i><?= $t['kota_asal']; ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <hr class="my-5 opacity-25">

        <h4 class="fw-bold mb-4" style="color: #0b5345;"><i class="fas fa-box-open me-2"></i>Rekomendasi Paket Umroh Tersedia</h4>
        
    <section id="paket-rekomendasi" class="py-5 bg-light">
        <div class="container">
        <div class="row g-4">
            
            <?php foreach($paket as $p): ?>
            <div class="col-12 col-md-4">
                
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        
                        <h5 class="fw-bold text-success mb-1"><?= $p['nama_paket']; ?></h5>
                        
                        <p class="text-muted small mb-3">
                            <i class="fas fa-building me-1"></i> <?= $p['nama_travel']; ?> (<?= $p['kota_asal']; ?>)
                        </p>
                        
                        <div class="mb-3">
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6 fw-bold rounded-3">
                                Rp<?= number_format($p['harga'], 0, ',', '.'); ?>
                            </span>
                        </div>
                        
                        <div class="small text-dark mb-4">
                            <div class="mb-2">
                                <i class="fas fa-calendar-alt text-warning me-2"></i> <?= $p['durasi']; ?> Hari
                            </div>
                            <div>
                                <i class="fas fa-hotel text-warning me-2"></i> 
                                <?php for($s = 1; $s <= $p['hotel_bintang']; $s++): ?> 
                                <i class="fas fa-star text-warning"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <a href="/detail_paket/<?= $p['id']; ?>" class="btn btn-outline-success w-100 rounded-pill fw-bold py-2 btn-sm">
                            <i class="fas fa-search me-1"></i> Lihat Detail
                        </a>

                    </div>
                </div>

            </div> <?php endforeach; ?>

        </div> </div>
    </section>
    </div>
    <section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <div class="row text-center g-4">
            
            <div class="col-md-3 col-sm-6">
                <div class="p-3">
                    <div class="text-success mb-3" style="font-size: 2.5rem;">
                        <i class="bg-light p-3 rounded-circle fas fa-ribbon text-success shadow-sm" style="color: #0b5345 !important;"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Licensed Operators</h6>
                    <p class="text-muted small mb-0 px-2">Hanya berpartner dengan biro travel resmi berizin Kemenag & IATA.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="p-3">
                    <div class="text-success mb-3" style="font-size: 2.5rem;">
                        <i class="bg-light p-3 rounded-circle fas fa-shield-alt text-success shadow-sm" style="color: #0b5345 !important;"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Secure Payment</h6>
                    <p class="text-muted small mb-0 px-2">Transaksi aman dan langsung terhubung secara transparan ke pihak agen.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="p-3">
                    <div class="text-success mb-3" style="font-size: 2.5rem;">
                        <i class="bg-light p-3 rounded-circle fas fa-headset text-success shadow-sm" style="color: #0b5345 !important;"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">24/7 Support</h6>
                    <p class="text-muted small mb-0 px-2">Layanan bantuan konsultasi ibadah siap mendampingi perjalanan Anda.</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="p-3">
                    <div class="text-success mb-3" style="font-size: 2.5rem;">
                        <i class="bg-light p-3 rounded-circle fas fa-star text-success shadow-sm" style="color: #0b5345 !important;"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Verified Reviews</h6>
                    <p class="text-muted small mb-0 px-2">Menampilkan ulasan dan data paket yang valid dari jamaah Jawa Timur.</p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <footer class="text-white mt-5 pt-5 pb-4" style="background-color: #073c32;">
    <div class="container text-md-left">
        <div class="row text-md-left">
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning fw-bold">UmrohJatim.com</h5>
                <p class="small opacity-75">Platform agregator umroh nomor satu di Jawa Timur. Kami membantu calon jamaah menemukan paket ibadah terbaik yang aman, berizin resmi Kemenag, dan sesuai dengan budget keluarga.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning fw-bold">Navigasi</h5>
                <p class="mb-2"><a href="/" class="text-white text-decoration-none small opacity-75">Tentang Kami</a></p>
                <p class="mb-2"><a href="/" class="text-white text-decoration-none small opacity-75">Syarat & Ketentuan</a></p>
                <p class="mb-2"><a href="/" class="text-white text-decoration-none small opacity-75">Bantuan Jamaah</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning fw-bold">Kontak Layanan</h5>
                <p class="small mb-2 opacity-75"><i class="fas fa-home me-2"></i> Gedung Pusat, Jl. Ahmad Yani No. 12, Surabaya</p>
                <p class="small mb-2 opacity-75"><i class="fas fa-envelope me-2"></i> bantuan@umrohjatim.com</p>
                <p class="small mb-2 opacity-75"><i class="fas fa-phone me-2"></i> +62 812-3456-7890</p>
            </div>
        </div>

        <hr class="mb-4 opacity-25">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="small opacity-50 mb-0">© 2026 UmrohJatim. All Rights Reserved. Terverifikasi Sistem Informasi Komputerisasi Pengelolaan Terpadu Umrah dan Haji Khusus (SISKOPATUH).</p>
            </div>
            <div class="col-md-5 col-lg-4 text-end">
                <span class="badge bg-light text-dark mx-1 py-2 px-3 small fw-bold text-uppercase" style="font-size: 0.65rem;"><i class="fas fa-star text-warning me-1"></i> RESMI KEMENAG</span>
                <span class="badge bg-light text-dark mx-1 py-2 px-3 small fw-bold text-uppercase" style="font-size: 0.65rem;"><i class="fas fa-heart text-danger me-1"></i> 100% AMAN</span>
            </div>
        </div>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>