<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, tendang balik sesuai role
        if (session()->get('logged_in')) {
            return session()->get('role') == 'admin' ? redirect()->to('/admin') : redirect()->to('/');
        }
        return view('auth/login');
    }

    public function proses_login()
    {
        $session = session();
        $model = new UserModel();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan email
        $user = $model->where('email', $email)->first();

        if ($user) {
            // Cek password (bisa pakai password_verify jika di-hash, 
            // tapi untuk testing simpel kita samakan langsung teksnya)
            if ($password === $user['password']) {
                
                // Set data session jika sukses login
                $sessionData = [
                    'id'        => $user['id'],
                    'nama'      => $user['nama'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => TRUE
                ];
                $session->set($sessionData);

                // Arahkan halaman sesuai role masing-masing
                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/');
                }

            } else {
                $session->setFlashdata('msg', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email tidak terdaftar!');
            return redirect()->to('/login');
        }
    }

    public function proses_daftar()
    {
        $session = session();
        $model = new \App\Models\UserModel();

        // 1. Tangkap data dari form pendaftaran
        $nama     = $this->request->getPost('nama');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role'); // Menangkap 'admin' atau 'user'

        // 2. Validasi: Cek apakah email sudah pernah didaftarkan orang lain
        $cekEmail = $model->where('email', $email)->first();
        if ($cekEmail) {
            $session->setFlashdata('msg', 'Email sudah terdaftar! Silakan gunakan email lain.');
            return redirect()->to('/login');
        }

        // 3. Siapkan data untuk dimasukkan ke database
        $dataBaru = [
            'nama'     => $nama,
            'email'    => $email,
            'password' => $password, // Menyimpan password teks biasa (simpel untuk testing)
            'role'     => $role
        ];

        // 4. Eksekusi simpan data ke tabel users
        $model->save($dataBaru);

        // 5. Set pesan sukses dan lempar user kembali ke form login
        $session->setFlashdata('msg', 'Pendaftaran Berhasil! Silakan masuk dengan akun baru Anda.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}