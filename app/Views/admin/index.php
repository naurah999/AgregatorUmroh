<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    .navbar-admin { background-color: #0b5345; color: white; padding: 15px 0; }
    .card-admin { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table thead { background-color: #f1f4f3; color: #0b5345; }
    .btn-tambah { background-color: #0b5345; color: white; border-radius: 10px; font-weight: 600; }
    .btn-tambah:hover { background-color: #084337; color: white; }
    .badge-harga { background-color: #e8f5e9; color: #2e7d32; font-weight: 600; padding: 5px 10px; border-radius: 5px; }
</style>

<nav class="navbar navbar-dark mb-4" style="background-color: #0b5345;">
    <div class="container">
        <span class="navbar-brand fw-bold"><i class="fas fa-user-shield me-2"></i>Panel Admin - Agregator</span>
        <div class="d-flex">
            <a href="/admin" class="btn btn-warning btn-sm me-2"><i class="fas fa-box"></i> Kelola Paket</a>
            <a href="/admin/travel" class="btn btn-outline-light btn-sm me-3"><i class="fas fa-building"></i> Kelola Travel</a>
            <a href="/" class="btn btn-sm btn-success"><i class="fas fa-globe"></i> Lihat Web</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card card-admin p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Kelola Paket Umroh</h5>
            <a href="/admin/tambah" class="btn btn-tambah shadow-sm">
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
            <strong><?= $p['nama_paket']; ?></strong>
        </td>
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
            <a href="<?= base_url('admin/hapus/' . $p['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?')" class="btn btn-danger btn-sm fw-bold px-3">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
            </table>
        </div>
    </div>
</div>
</head>
</html>