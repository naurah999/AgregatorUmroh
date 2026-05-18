<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Paket Umroh</title>
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
                    <form action="/admin/simpan" method="post">
                        <div class="mb-3">
                            <label>Nama Travel</label>
                            <input type="text" name="nama_travel" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga (Angka saja)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Durasi (Hari)</label>
                            <input type="number" name="durasi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Bintang Hotel</label>
                            <select name="hotel_bintang" class="form-select">
                                <option value="3">Bintang 3</option>
                                <option value="4">Bintang 4</option>
                                <option value="5">Bintang 5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="includes" class="form-label">Fasilitas Sudah Termasuk (Includes)</label>
                            <textarea class="form-control" id="includes" name="includes" rows="4" placeholder="Contoh: Tiket Pesawat PP, Visa Umroh, Makan 3x Sehari (Gunakan tanda koma atau baris baru untuk memisahkan)"></textarea>
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