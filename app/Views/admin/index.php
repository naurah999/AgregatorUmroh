<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar-admin { background-color: #0b5345; color: white; padding: 15px 0; }
        .card-admin { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .table thead { background-color: #f1f4f3; color: #0b5345; }
        .btn-tambah { background-color: #0b5345; color: white; border-radius: 10px; font-weight: 600; }
        .btn-tambah:hover { background-color: #084337; color: white; }
        .badge-harga { background-color: #e8f5e9; color: #2e7d32; font-weight: 600; padding: 5px 10px; border-radius: 5px; }
        
        /* Style Toast Custom */
        .toast-container-custom { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .toast-custom { background-color: #d1e7dd; color: #0f5132; border-left: 5px solid #0a6b4a;
            padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 12px; font-weight: bold; 
            transform: translateY(-20px); opacity: 0; transition: all 0.4s ease; }
        .toast-custom.show { transform: translateY(0); opacity: 1;}
    </style>
</head>
<body>

<nav class="navbar navbar-dark mb-4" style="background-color: #0b5345;">
    <div class="container">
        <span class="navbar-brand fw-bold"><i class="fas fa-user-shield me-2"></i>Panel Admin - Agregator</span>
        <div class="d-flex">
            <a href="<?= base_url('admin'); ?>" class="btn btn-warning btn-sm me-2"><i class="fas fa-box"></i> Kelola Paket</a>
            <a href="<?= base_url('admin/travel'); ?>" class="btn btn-outline-light btn-sm me-3"><i class="fas fa-building"></i> Kelola Travel</a>
            <a href="<?= base_url('/'); ?>" class="btn btn-sm btn-success"><i class="fas fa-globe"></i> Lihat Web</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card card-admin p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Kelola Paket Umroh</h5>
            <a href="<?= base_url('admin/tambah'); ?>" class="btn btn-tambah shadow-sm">
                <i class="fas fa-plus-circle me-2"></i>Tambah Paket Baru
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Paket</th>
                        <th>Nama Biro Travel</th>
                        <th>Harga (Rp)</th>
                        <th>Durasi</th>
                        <th>Bintang</th> 
                        <th>Fasilitas</th> 
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($paket as $p): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td>
                        <strong><?= $p['nama_paket']; ?></strong></td>
                    <td><?= isset($p['nama_travel']) ? $p['nama_travel'] : '-'; ?></td>
                    <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                    <td><?= $p['durasi']; ?> Hari</td>
                    <td>
                        <?php 
                        $hotel_bintang = isset($p['hotel_bintang']) ? $p['hotel_bintang'] : 3;
                        for($s = 1; $s <= $hotel_bintang; $s++): 
                        ?>
                            <i class="fas fa-star text-warning" style="font-size: 0.8rem;"></i>
                        <?php endfor; ?>
                    </td>
                    <td>
                        <small class="text-muted">
                            <?= !empty($p['includes']) ? mb_strimwidth(str_replace("\n", ", ", $p['includes']), 0, 40, "...") : '-'; ?>
                        </small>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/paket_edit/' . $p['id']); ?>" class="btn btn-warning btn-sm fw-bold px-3">Edit</a>
                        <a href="#" class="btn btn-sm text-white fw-bold btn-hapus-custom" 
                           data-url="<?= base_url('admin/hapus/' . $p['id']); ?>" 
                           style="background-color: #dc3545;">
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Toast Success -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="toast-container-custom">
        <div id="successToast" class="toast-custom">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <span><?= session()->getFlashdata('success'); ?></span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toast = document.getElementById('successToast');
            setTimeout(function() {
                toast.classList.add('show');
            }, 100);
            setTimeout(function () {
                toast.classList.remove('show');
            }, 3000);
        });
    </script>
<?php endif; ?>
<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="konfirmasiHapusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <div class="modal-body text-center p-4">
                <div class="text-danger mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Paket?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus paket umroh ini? Data yang dihapus tidak bisa dikembalikan.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light w-50 fw-bold text-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <a id="tombolEksekusiHapus" href="#" class="btn text-white w-50 fw-bold" style="background-color: #dc3545; border-radius: 8px;">Ya, Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('.btn-hapus-custom');
        const modalHapus = new bootstrap.Modal(document.getElementById('konfirmasiHapusModal'));
        const linkEksekusi = document.getElementById('tombolEksekusiHapus');

        tombolHapus.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const urlHapus = this.getAttribute('data-url');
                linkEksekusi.setAttribute('href', urlHapus);
                modalHapus.show();
            });
        });
    });
</script>
</body>
</html>