<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="col-md-6 mx-auto">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header text-white d-flex align-items-center gap-3" style="background-color: #0b5345; border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 15px 20px;">
                    <a href="<?= base_url('admin'); ?>" class="text-white fs-5" title="Kembali ke Panel Admin" style="transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h4 class="mb-0 fw-bold fs-5">Form Edit Paket</h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/update/' . $paket['id']); ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Travel / Penyelenggara</label>
                            <select name="travel_id" class="form-select" required>
                                <option value="">-- Pilih Biro Travel --</option>
                                <?php foreach ($travel as $t): ?>
                                    <option value="<?= $t['id']; ?>" <?= $t['id'] == $paket['travel_id'] ? 'selected' : ''; ?>>
                                        <?= $t['nama_travel']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                                                                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" value="<?= old('nama_paket', $paket['nama_paket']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Angka saja)</label>
                            <input type="number" name="harga" class="form-control" value="<?= old('harga', $paket['harga']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Durasi (Hari)</label>
                            <input type="number" name="durasi" class="form-control" value="<?= old('durasi', $paket['durasi']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bintang Hotel</label>
                            <select name="hotel_bintang" class="form-select">
                                <option value="3" <?= old('hotel_bintang', $paket['hotel_bintang'] ) == 3 ? 'selected' : '' ?>>Bintang 3</option>
                                <option value="4" <?= old('hotel_bintang', $paket['hotel_bintang'] ) == 4 ? 'selected' : '' ?>>Bintang 4</option>
                                <option value="5" <?= old('hotel_bintang', $paket['hotel_bintang'] ) == 5 ? 'selected' : '' ?>>Bintang 5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Maskapai Penerbangan</label>
                            <input type="text" name="maskapai" class="form-control" value="<?= esc($paket['maskapai']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kota Keberangkatan</label>
                            <input type="text" name="kota_keberangkatan" class="form-control" value="<?= esc($paket['kota_keberangkatan']); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Fasilitas Sudah Termasuk (Includes)</label>
                            <textarea name="includes" class="form-control" rows="4" placeholder="Gunakan enter untuk memisahkan setiap fasilitas"><?= old('includes', $paket['includes'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('admin'); ?>" class="btn btn-secondary me-2 px-4">Batal</a>
                            <button type="submit" class="btn btn-success px-4" style="background-color: #0b5345; border: none;">Update Paket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>