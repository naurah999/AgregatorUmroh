<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Masuk / Daftar - UmrohJatim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style> //4
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; min-height: 100vh; display: flex; align-items: center; }
        .login-container { max-width: 1000px; background: white; border-radius: 24px; box-shadow: 0 10px 40px rgba(0,0,0,0.04); overflow: hidden; padding: 40px; }
        .text-brand { color: #0b5345; font-weight: 700; }
        .feature-icon { width: 55px; height: 55px; background-color: #e8f5e9; color: #0b5345; display: flex; align-items: center; justify-content: center; border-radius: 15px; font-size: 1.3rem; }
        .form-card { background: #ffffff; border: 1px solid #eef2f0; border-radius: 20px; box-shadow: 0 4px 20px rgba(11,83,69,0.03); padding: 30px; }
        .btn-primary-custom { background: #0b5345; color: white; border: none; border-radius: 12px; font-weight: 600; padding: 12px; }
        .btn-primary-custom:hover { background: #084337; color: white; }
        .toggle-link { color: #2e7d32; font-weight: 600; cursor: pointer; text-decoration: none; }
        .toggle-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container login-container my-5">
    <div class="row align-items-center g-5">
        
        <div class="col-lg-6 d-none d-lg-block">
            <h3 class="fw-bold mb-4" style="color: #0b5345;">Mengapa di qalb.id - Agregator Umroh Jawa Timur?</h3>
            
            <div class="d-flex align-items-start mb-4">
                <div class="feature-icon me-3 shadow-sm">
                    <i class="fas fa-search-dollar"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Perbandingan Harga Transparan</h5>
                    <p class="text-muted small mb-0">Temukan ratusan paket umroh dari berbagai biro resmi di Jawa Timur. Bandingkan harga, fasilitas hotel, dan durasi dalam satu kali klik tanpa biaya tambahan.</p>
                </div>
            </div>

            <div class="d-flex align-items-start mb-4">
                <div class="feature-icon me-3 shadow-sm">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Jaminan Biro Berizin Resmi</h5>
                    <p class="text-muted small mb-0">Semua mitra travel yang tergabung di platform kami wajib memiliki SK resmi Kemenag dan terintegrasi dengan SISKOPATUH. Ibadah Anda dijamin lebih tenang dan aman.</p>
                </div>
            </div>

            <div class="d-flex align-items-start">
                <div class="feature-icon me-3 shadow-sm">
                    <i class="fas fa-headset"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-1">Koneksi Langsung ke Travel</h5>
                    <p class="text-muted small mb-0">Tertarik dengan salah satu paket? Sistem kami langsung menghubungkan Anda ke layanan pelanggan WhatsApp resmi travel terkait tanpa perantara pihak ketiga.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="form-card">
                
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger small py-2 mb-3"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>

                <div id="loginForm">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-brand mb-1">Assalamualaikum,</h4>
                        <p class="text-muted small">Selamat datang kembali! Silakan masukkan data diri Anda</p>
                    </div>

                    <form action="/proses_login" method="post">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Email</label>
                            <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="Contoh: budi@mail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Password</label>
                            <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Masukkan password Anda" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom w-100 shadow-sm mb-3">Masuk</button>
                    </form>

                    <div class="text-center small text-muted">
                        Belum punya akun Umroh? <span class="toggle-link" onclick="switchForm('daftar')">Daftar Disini</span>
                    </div>
                </div>

                <div id="registerForm" class="d-none">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-brand mb-1">Mulai Bersama Kami,</h4>
                        <p class="text-muted small">Daftarkan akun Anda untuk kemudahan mencari paket ibadah</p>
                    </div>

                    <form action="/proses_daftar" method="post">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control rounded-3 py-2" placeholder="Contoh: Budi Santoso" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Email</label>
                            <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="Contoh: budi@mail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Baru</label>
                            <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="Buat password aman" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Mendaftar Sebagai</label>
                            <select name="role" class="form-select rounded-3 py-2" required>
                                <option value="user">Jamaah / User Biasa</option>
                                <option value="admin">Pengelola / Admin Biro Travel</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary-custom w-100 shadow-sm mb-3">Daftar Akun</button>
                    </form>

                    <div class="text-center small text-muted">
                        Sudah punya akun Umroh? <span class="toggle-link" onclick="switchForm('login')">Masuk Disini</span>
                    </div>
                </div>

                <div class="text-center mt-4 pt-2 border-top border-light">
                    <a href="/" class="text-muted small text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function switchForm(type) {
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        
        if (type === 'daftar') {
            loginForm.classList.add('d-none');
            registerForm.classList.remove('d-none');
        } else {
            registerForm.classList.add('d-none');
            loginForm.classList.remove('d-none');
        }
    }
</script>

</body>
</html>