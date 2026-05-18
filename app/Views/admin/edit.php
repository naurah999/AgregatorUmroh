<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Paket Umroh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Tambah Paket</h4>
                </div>
                <div class="card-body">
                    <form action="/admin/update/<?= $paket['id']; ?>" method="post">
                        <div class="mb-3">
                            <label>Nama Travel</label>
                            <input type="text" name="nama_travel" class="form-control" value="<?= $paket['nama_travel']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" value="<?= $paket['nama_paket']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga (Angka saja)</label>
                            <input type="number" name="harga" class="form-control" value="<?= $paket['harga']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Durasi (Hari)</label>
                            <input type="number" name="durasi" class="form-control" value="<?= $paket['durasi']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Bintang Hotel</label>
                            <select name="hotel_bintang" class="form-select">
                                <option value="3" <?= $paket['hotel_bintang'] == 3 ? 'selected' : '' ?>>Bintang 3</option>
                                <option value="4" <?= $paket['hotel_bintang'] == 4 ? 'selected' : '' ?>>Bintang 4</option>
                                <option value="5" <?= $paket['hotel_bintang'] == 5 ? 'selected' : '' ?>>Bintang 5</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Paket</button>
                        <a href="/admin" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>