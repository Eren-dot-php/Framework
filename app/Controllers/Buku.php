<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    // Menampilkan daftar buku
    public function index()
    {
        $data['title'] = 'Manajemen Buku';
        $data['buku'] = $this->bukuModel->findAll();
        return view('buku/index', $data);
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $data['title'] = 'Tambah Buku';
        return view('buku/create', $data);
    }

    // Menyimpan buku baru
    public function store()
    {
        $this->bukuModel->save([
            'kode_buku' => $this->request->getPost('kode_buku'),
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
        ]);
        return redirect()->to('/buku');
    }

    // Menampilkan form edit buku
    public function edit($kode_buku)
    {
        $data['title'] = 'Edit Buku';
        $data['buku'] = $this->bukuModel->find($kode_buku);
        return view('buku/edit', $data);
    }

    // Mengupdate data buku
    public function update($kode_buku)
    {
        $this->bukuModel->update($kode_buku, [
            'kode_buku' => $this->request->getPost('kode_buku'),
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'jumlah_eksemplar' => $this->request->getPost('jumlah_eksemplar'),
        ]);
        return redirect()->to('/buku');
    }

    // Menghapus buku
    public function delete($kode_buku)
    {
        $this->bukuModel->delete($kode_buku);
        return redirect()->to('/buku');
    }

    // Mengecek ketersediaan buku
    public function isBukuTersedia($kode_buku)
    {
        $buku = $this->bukuModel->find($kode_buku);
        return ($buku && $buku['jumlah_eksemplar'] > 0);
    }

    // Mengurangi stok buku
    public function kurangiStok($kode_buku)
    {
        $this->bukuModel->set('jumlah_eksemplar', 'jumlah_eksemplar - 1', false)
                        ->where('kode_buku', $kode_buku)
                        ->update();
    }
}
