<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="col-md-6 mx-auto">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-header text-white" style="background-color: #0a6b4a; border-top-left-radius: 12px; border-top-right-radius: 12px; padding: 15px 20px;">
                    <h4 class="mb-0 fw-bold fs-5">Form Tambah Paket</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/simpan'); ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Travel / Penyelenggara</label>
                            <select name="travel_id" class="form-select" required>
                                <option value="">-- Pilih Biro Travel --</option>
                                <?php foreach ($travel as $t): ?>
                                    <option value="<?= $t['id']; ?>" <?= old('travel_id') == $t['id'] ? 'selected' : ''; ?>>
                                        <?= $t['nama_travel']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" value="<?= old('nama_paket'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Harga (Angka saja)</label>
                            <input type="number" name="harga" class="form-control" value="<?= old('harga'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Durasi (Hari)</label>
                            <input type="number" name="durasi" class="form-control" value="<?= old('durasi'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bintang Hotel</label>
                            <select name="hotel_bintang" class="form-select">
                                <option value="3" <?= old('hotel_bintang') == 3 ? 'selected' : ''; ?>>Bintang 3</option>
                                <option value="4" <?= old('hotel_bintang') == 4 ? 'selected' : ''; ?>>Bintang 4</option>
                                <option value="5" <?= old('hotel_bintang') == 5 ? 'selected' : ''; ?>>Bintang 5</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="includes" class="form-label fw-bold">Fasilitas Sudah Termasuk (Includes)</label>
                            <textarea class="form-control" id="includes" name="includes" rows="4" placeholder="Contoh: Tiket Pesawat PP, Visa Umroh, Makan 3x Sehari (Gunakan baris baru/enter untuk memisahkan)"><?= old('includes'); ?></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('admin'); ?>" class="btn btn-secondary me-2 px-4">Batal</a>
                            <button type="submit" class="btn btn-success px-4" style="background-color: #0a6b4a; border: none;">Simpan Paket</button>
                        </div>
                        <button type="submit" class="btn btn-success px-4" style="background-color: #0a6b4a; border: none;">Simpan Paket</button>
                        <a href="<?= base_url('admin'); ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>