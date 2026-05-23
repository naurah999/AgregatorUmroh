<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark mb-4" style="background-color: #0b5345;">
        <div class="container">
            <span class="navbar-brand fw-bold"><i class="fas fa-user-shield me-2"></i>Panel Admin - Agregator</span>
            <div class="d-flex">
                <a href="<?= base_url('admin'); ?>" class="btn btn-outline-light btn-sm me-2"><i class="fas fa-box"></i> Kelola Paket</a>
                <a href="<?= base_url('admin/travel'); ?>" class="btn btn-warning btn-sm me-3"><i class="fas fa-building"></i> Kelola Travel</a>
                <a href="<?= base_url('/'); ?>" class="btn btn-sm btn-success"><i class="fas fa-globe"></i> Lihat Web</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark"><i class="fas fa-building text-success me-2"></i>Daftar Mitra Biro Travel</h4>
            <button class="btn btn-success rounded-pill px-4 btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus me-1"></i> Tambah Biro Travel
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Biro & Nama PT</th> 
                    <th>Kota Asal</th>
                    <th>No. SK Kemenag</th>
                    <th>Alamat Lengkap</th> 
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($travel as $t): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td>
                            <div class="fw-bold text-dark"><?= $t['nama_travel']; ?></div>
                            <small class="text-muted text-uppercase" style="font-size: 0.75rem;">
                                <i class="fas fa-building me-1"></i><?= !empty($t['nama_pt']) ? $t['nama_pt'] : '-'; ?>
                            </small>
                        </td>
                        <td><span class="badge bg-secondary"><?= $t['kota_asal']; ?></span></td>
                        <td><?= !empty($t['sk_kemenag']) ? $t['sk_kemenag'] : '-'; ?></td>                  
                        <td>
                            <small class="text-muted text-wrap d-block" style="max-width: 250px; font-size: 0.8rem;">
                                <?= !empty($t['alamat_travel']) ? $t['alamat_travel'] : '-'; ?>
                            </small>
                        </td>

                        <td class="text-center">
                            <button class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $t['id']; ?>">Edit</button>
                            <a href="<?= base_url('admin/travel/hapus/' . $t['id']); ?>" class="btn btn-sm btn-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <!-- Modal Edit per Baris -->
                    <div class="modal fade" id="modalEdit<?= $t['id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Ubah Data Travel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="<?= base_url('admin/travel/ubah/' . $t['id']); ?>" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Biro Travel</label>
                                            <input type="text" name="nama_travel" class="form-control" value="<?= $t['nama_travel']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Kota Asal (Jawa Timur)</label>
                                            <input type="text" name="kota_asal" class="form-control" value="<?= $t['kota_asal']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nomor SK Kemenag</label>
                                            <input type="text" name="sk_kemenag" class="form-control" value="<?= $t['sk_kemenag']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Resmi PT</label>
                                            <input type="text" name="nama_pt" class="form-control" value="<?= $t['nama_pt']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Alamat Lengkap Kantor</label>
                                            <textarea name="alamat_travel" class="form-control" rows="3" required><?= $t['alamat_travel']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning btn-sm">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Mitra Travel Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/travel/simpan'); ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Biro Travel</label>
                            <input type="text" name="nama_travel" class="form-control" placeholder="Contoh: An-Namiroh Travel" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Kota Asal (Jawa Timur)</label>
                            <input type="text" name="kota_asal" class="form-control" placeholder="Contoh: Surabaya / Sidoarjo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor SK Kemenag</label>
                            <input type="text" name="sk_kemenag" class="form-control" placeholder="Contoh: No. 123 Tahun 2026" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Resmi PT</label>
                            <input type="text" name="nama_pt" class="form-control" placeholder="Contoh: PT. Al Amanah Wisata Mulia" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Lengkap Kantor</label>
                            <textarea name="alamat_travel" class="form-control" rows="3" placeholder="Jl. Ahmad Yani No. 45, Kota Surabaya..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan Travel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>