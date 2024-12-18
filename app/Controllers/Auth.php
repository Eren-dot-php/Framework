<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Tampilkan halaman login
        return view('auth/login');
    }

    public function doLogin()
    {
        // Validasi input form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal
            return redirect()->back()->withInput()->with('error', 'Username dan Password harus diisi.');
        }

        // Ambil data inputan dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user di database
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        // Cek keberadaan user dan verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session jika login berhasil
            $sessionData = [
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'isLoggedIn' => true
            ];
            session()->set($sessionData);

            // Redirect ke halaman dashboard
            return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Username atau Password salah.');
        }
    }

    public function logout()
    {
        // Hapus session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}
