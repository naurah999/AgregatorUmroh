<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\TravelModel;

class Admin extends BaseController
{
    // Fungsi yang otomatis berjalan setiap kali Controller Admin diakses
    public function __construct()
    {
        // Jika belum login ATAU role-nya bukan admin, tendang ke beranda
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            // Menggunakan response redirect bawaan framework, bukan header native PHP
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Anda tidak memiliki akses.");
        }
    }

    public function index()
    {
        $paketModel = new \App\Models\PaketModel();

        // Ubah query-nya menjadi seperti ini agar data nama_travel ikut terbawa dari tabel travel
        $data['paket'] = $paketModel->select('paket_umroh.*, travel.nama_travel')
                                    ->join('travel', 'travel.id = paket_umroh.travel_id')
                                    ->findAll();

        return view('admin/index', $data); // Sesuaikan dengan nama view admin kamu
    }

    // 🛠️ 1. FUNGSI TAMBAH SUDAH DIPERBAIKI (Membawa data travel ke view tambah.php)
    public function tambah()
    {
        $travelModel = new \App\Models\TravelModel();
        
        $data['travel'] = $travelModel->findAll();
        $data['judul']  = "Tambah Paket Umroh Baru";

        return view('admin/tambah', $data);
    }

    // 🛠️ 2. FUNGSI SIMPAN SUDAH DIPERBAIKI (Menyimpan travel_id, bukan nama_travel teks manual)
    public function simpan()
    {
        $model = new \App\Models\PaketModel();

        // Mengambil data dari form post
        $model->save([
            'travel_id'     => $this->request->getPost('travel_id'), // Menggunakan ID travel relasi
            'nama_paket'    => $this->request->getPost('nama_paket'),
            'harga'         => $this->request->getPost('harga'),
            'durasi'        => $this->request->getPost('durasi'),
            'hotel_bintang' => $this->request->getPost('hotel_bintang'),
            'includes'      => $this->request->getPost('includes'), 
            'maskapai'           => $this->request->getPost('maskapai'),
            'kota_keberangkatan' => $this->request->getPost('kota_keberangkatan'),
            'tanggal_keberangkatan' => $this->request->getPost('tanggal_keberangkatan'),
        ]);

        return redirect()->to('/admin')->with('success', 'Data paket umroh berhasil ditambahkan!');
    }

    public function hapus($id)
    {
        // Ganti 'PaketModel' sesuai nama model paket umroh Anda
        $paketModel = new \App\Models\PaketModel(); 
        
        // Eksekusi hapus data
        $paketModel->delete($id);

        // CRITICAL: Set flashdata dengan key 'success' agar dibaca oleh view
        session()->setFlashdata('success', 'Data paket umroh berhasil dihapus!');

        return redirect()->to('/admin'); // Sesuaikan dengan route halaman utama admin Anda
    }

    public function paket_edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('/admin')->with('error', 'ID Paket tidak ditemukan.');
        }

        $paketModel = new \App\Models\PaketModel();
        $travelModel = new \App\Models\TravelModel();

        // Ambil data paket berdasarkan ID
        $detailPaket = $paketModel->find($id);

        if (!$detailPaket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Paket tidak ditemukan");
        }

        // Kirim data paket dan daftar travel untuk pilihan dropdown select
        $data['paket']  = $detailPaket;
        $data['p']      = $detailPaket; // Cadangan variabel jika view memakai $p
        $data['travel'] = $travelModel->findAll();
        $data['judul']  = "Edit Paket Umroh";

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\PaketModel();
        
        // Memproses update data ke database
        $model->update($id, [
            'travel_id'     => $this->request->getPost('travel_id'),
            'nama_paket'    => $this->request->getPost('nama_paket'),
            'harga'         => $this->request->getPost('harga'),
            'durasi'        => $this->request->getPost('durasi'),
            'hotel_bintang' => $this->request->getPost('hotel_bintang'),
            'includes'      => $this->request->getPost('includes'), // Menyimpan fasilitas/includes yang baru diketik
            'maskapai'           => $this->request->getPost('maskapai'),
            'kota_keberangkatan' => $this->request->getPost('kota_keberangkatan'),
            'tanggal_keberangkatan' => $this->request->getPost('tanggal_keberangkatan'),
        ]);

        // Kembali ke halaman admin dengan membawa NOTIFIKASI BERHASIL
        return redirect()->to('/admin')->with('success', 'Data paket umroh berhasil diperbarui!');
    }

    // ================= CRUD TRAVEL =================

    // 1. Tampilkan Daftar Travel
    public function travel_index()
    {
        $travelModel = new \App\Models\TravelModel();
        $data = [
            'judul'  => 'Kelola Mitra Travel',
            'travel' => $travelModel->findAll()
        ];
        return view('admin/travel_view', $data);
    }

    // 2. Proses Simpan Tambah Travel
    public function travel_simpan()
    {
        $travelModel = new \App\Models\TravelModel();
        $travelModel->save([
            'nama_travel' => $this->request->getPost('nama_travel'),
            'kota_asal'   => $this->request->getPost('kota_asal'),
            'sk_kemenag'  => $this->request->getPost('sk_kemenag'),
            'logo_travel' => '', 
            'nama_pt'       => $this->request->getPost('nama_pt'),       
            'alamat_travel' => $this->request->getPost('alamat_travel')  
        ]);
        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil ditambah!');
    }

    // 3. Proses Edit Travel
    public function travel_ubah($id)
    {
        $travelModel = new \App\Models\TravelModel();
        $travelModel->update($id, [
            'nama_travel' => $this->request->getPost('nama_travel'),
            'kota_asal'   => $this->request->getPost('kota_asal'),
            'sk_kemenag'  => $this->request->getPost('sk_kemenag'),
            'nama_pt'       => $this->request->getPost('nama_pt'),       
            'alamat_travel' => $this->request->getPost('alamat_travel')  
        ]);
        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil diubah!');
    }

    // 4. Proses Hapus Travel
    public function travel_hapus($id)
    {
        $travelModel = new \App\Models\TravelModel();
        $travelModel->delete($id);
        return redirect()->to('/admin/travel')->with('success', 'Data travel berhasil dihapus!');
    }

}