<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\TravelModel;

class Home extends BaseController
{
    public function index()
    {
        $paketModel = new PaketModel();
        $travelModel = new TravelModel();

        // 1. Ambil data input dari form filter pintar
        $budget = $this->request->getGet('budget');
        $durasi = $this->request->getGet('durasi');

        // 2. Query Builder untuk Paket Umroh + JOIN dengan tabel Travel
        // Kita ambil kolom dari paket_umroh dan nama_travel dari tabel travel
        $builder = $paketModel->select('paket_umroh.*, travel.nama_travel, travel.kota_asal')
                              ->join('travel', 'travel.id = paket_umroh.travel_id');

        // Terapkan filter jika user mengisi form
        if (!empty($budget)) {
            $builder->where('harga <=', $budget);
        }
        if (!empty($durasi)) {
            $builder->where('durasi', $durasi);
        }

        // 3. Siapkan semua data untuk dikirim ke View
        $data = [
            'judul'  => 'Agregator Umroh Jawa Timur',
            'paket'  => $builder->findAll(),          // Hasil pencarian paket yang di-join
            'travel' => $travelModel->findAll()       // Semua daftar mitra travel Jatim
        ];

        return view('halaman_depan', $data);
    }

    public function travel($id)
    {
        $travelModel = new \App\Models\TravelModel();
        $paketModel = new \App\Models\PaketModel();

        // 1. Ambil data profil travel berdasarkan ID yang diklik
        $travelData = $travelModel->find($id);

        // Jika data travel tidak ditemukan di database, lemparkan error 404
        if (!$travelData) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Biro Travel Tidak Ditemukan");
        }

        // 2. Ambil semua paket yang HANYA dimiliki oleh travel ini
        $paketData = $paketModel->where('travel_id', $id)->findAll();

        // 3. Kirim ke halaman khusus profil travel
        $data = [
            'judul'  => 'Profil ' . $travelData['nama_travel'],
            'travel' => $travelData,
            'paket'  => $paketData
        ];

        return view('detail_travel', $data);
    } 

    public function detail($id)
    {
        $paketModel = new \App\Models\PaketModel();
        $travelModel = new \App\Models\TravelModel();

        // Ambil detail paket beserta data travelnya menggunakan JOIN
        $paket = $paketModel->select('paket_umroh.*, travel.nama_travel, travel.kota_asal, travel.sk_kemenag, travel.nama_pt, travel.alamat_travel')
                            ->join('travel', 'travel.id = paket_umroh.travel_id', 'left')
                            ->find($id);

        // Jika paket tidak ada di database, tampilkan error 404
        if (!$paket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Paket Umroh Tidak Ditemukan");
        }

        $data = [
            'judul'  => "Detail Paket - " . $paket['nama_paket'],
            'p'      => $paket,
            'travel' => $paket // Karena sudah di-join, variabel $travel bisa diarahkan ke array yang sama
        ];

        return view('detail_paket', $data);
    }

    public function detail_paket($id)
    {
        // Panggil model paket dan travel kamu
        $paketModel = new \App\Models\PaketModel(); // Sesuaikan nama model paketmu
        $travelModel = new \App\Models\TravelModel();

        // Cari data paket berdasarkan ID yang diklik
        $data['p'] = $paketModel->find($id);

        // Jika data paket tidak ditemukan di database, tampilkan error
        if (!$data['p']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Paket tidak ditemukan");
        }

        // Ambil data travel yang memiliki paket tersebut untuk menampilkan legalitasnya
        $data['travel'] = $travelModel->find($data['p']['travel_id']); // Sesuaikan nama kolom foreign key travel_id kamu

        // 🛠️ TAMBAHKAN BARIS INI UNTUK MENYEMBUHKAN ERROR JUDUL:
        $data['judul'] = "Detail Paket - " . $data['p']['nama_paket'];

        // Buka halaman view detail paket (Pastikan kamu sudah punya file view-nya, misal detail_paket.php)
        return view('detail_paket', $data);
    }
}