<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    // Menampilkan daftar anggota
    public function index()
    {
        $data['title'] = 'Manajemen Anggota';
        $data['anggota'] = $this->anggotaModel->findAll();
        return view('anggota/index', $data);
    }

    // Menampilkan form tambah anggota
    public function create()
    {
        $data['title'] = 'Tambah Anggota';
        return view('anggota/create', $data);
    }

    // Menyimpan anggota baru
    public function store()
    {
        $this->anggotaModel->save([
            'id_anggota' => $this->request->getPost('id_anggota'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email'),
        ]);
        return redirect()->to('/anggota');
    }

    // Menampilkan form edit anggota
    public function edit($id)
    {
        $data['title'] = 'Edit Anggota';
        $data['anggota'] = $this->anggotaModel->find($id);
        return view('anggota/edit', $data);
    }

    // Mengupdate data anggota
    public function update($id)
    {
        $this->anggotaModel->update($id, [
            'id_anggota' => $this->request->getPost('id_anggota'),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'email' => $this->request->getPost('email'),
        ]);
        return redirect()->to('/anggota');
    }

    // Menghapus anggota
    public function delete($id)
    {
        $this->anggotaModel->delete($id);
        return redirect()->to('/anggota');
    }
}
