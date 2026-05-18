<?php

namespace App\Controllers;

use App\Models\PaketModel;

class Admin extends BaseController
{
    // Fungsi yang otomatis berjalan setiap kali Controller Admin diakses
    public function __construct()
    {
        // Jika belum login ATAU role-nya bukan admin, tendang ke beranda
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            header('Location: ' . base_url('/'));
            exit();
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

    public function tambah()
    {
        return view('admin/tambah');
    }

    public function simpan()
    {
        $model = new \App\Models\PaketModel();

        // Mengambil data dari form post
        $model->save([
            'nama_travel'   => $this->request->getPost('nama_travel'),
            'nama_paket'    => $this->request->getPost('nama_paket'),
            'harga'         => $this->request->getPost('harga'),
            'durasi'        => $this->request->getPost('durasi'),
            'hotel_bintang' => $this->request->getPost('hotel_bintang'),
            'includes'     => $this->request->getPost('includes'), // 🛠️ PASTIKAN BARIS INI ADA
        ]);

        return redirect()->to('/admin');
    }

    public function hapus($id)
    {
        $model = new \App\Models\PaketModel();
        $model->delete($id);
        return redirect()->to('/admin');
    }

    public function paket_edit($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('admin/paket'))->with('error', 'ID Paket tidak ditemukan.');
        }

        $paketModel = new \App\Models\PaketModel();
        $travelModel = new \App\Models\TravelModel();

        //Ambil data paket berdasarkan ID
        $detailPaket = $paketModel->find($id);

        if (!$detailPaket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Paket tidak ditemukan");
        }

        // 🛠️ KITA KIRIM DUA-DUANYA BIAR AMAN DAN GA EROR LAGI:
        $data['p']     = $detailPaket; // Untuk jaga-jaga kode baru
        $data['paket'] = $detailPaket; // MASUKKAN INI (Untuk menyembuhkan eror baris 18 di view)

        $data['travel'] = $travelModel->findAll();
        $data['judul']  = "Edit Paket Umroh";

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\PaketModel();
        $model->update($id, [
            'nama_travel'   => $this->request->getPost('nama_travel'),
            'nama_paket'    => $this->request->getPost('nama_paket'),
            'harga'         => $this->request->getPost('harga'),
            'durasi'        => $this->request->getPost('durasi'),
            'hotel_bintang' => $this->request->getPost('hotel_bintang'),
            'includes'     => $this->request->getPost('includes'), // 🛠️ PASTIKAN BARIS INI ADA
        ]);
        return redirect()->to('/admin');
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
            'logo_travel' => '', // Bisa dikembangkan untuk upload foto nanti
            'nama_pt'       => $this->request->getPost('nama_pt'),       // <-- TAMBAHKAN INI
            'alamat_travel' => $this->request->getPost('alamat_travel')  // <-- TAMBAHKAN INI
        ]);
        return redirect()->to('/admin/travel');
    }

    // 3. Proses Edit Travel
    public function travel_ubah($id)
    {
        $travelModel = new \App\Models\TravelModel();
        $travelModel->update($id, [
            'nama_travel' => $this->request->getPost('nama_travel'),
            'kota_asal'   => $this->request->getPost('kota_asal'),
            'sk_kemenag'  => $this->request->getPost('sk_kemenag'),
            'nama_pt'       => $this->request->getPost('nama_pt'),       // <-- TAMBAHKAN INI
            'alamat_travel' => $this->request->getPost('alamat_travel')  // <-- TAMBAHKAN INI
        ]);
        return redirect()->to('/admin/travel');
    }

    // 4. Proses Hapus Travel
    public function travel_hapus($id)
    {
        $travelModel = new \App\Models\TravelModel();
        $travelModel->delete($id);
        return redirect()->to('/admin/travel');
    }
}