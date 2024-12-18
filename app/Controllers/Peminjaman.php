<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Peminjaman',
            'peminjaman' => $this->peminjamanModel->findAll()
        ];

        return view('peminjaman/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $kodeBuku = $this->request->getPost('kode_buku');
            if (!$this->peminjamanModel->cekKetersediaanBuku($kodeBuku)) {
                return redirect()->back()->with('error', 'Buku sedang dipinjam.');
            }

            $this->peminjamanModel->save([
                'nomor_transaksi' => 'TRX' . time(), // Generate nomor transaksi unik
                'id_anggota' => $this->request->getPost('id_anggota'),
                'kode_buku' => $kodeBuku,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
                'status' => 'dipinjam'
            ]);

            return redirect()->to('/peminjaman')->with('success', 'Data peminjaman berhasil disimpan.');
        }

        return view('peminjaman/create', ['title' => 'Tambah Peminjaman']);
    }

    public function store()
    {
        // Validasi input
        $validation = $this->validate([
            'id_anggota' => 'required',
            'kode_buku' => 'required',
            'tanggal_pinjam' => 'required|valid_date',
            'tanggal_kembali' => 'required|valid_date',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data input
        $data = [
            'nomor_transaksi' => 'TRX-' . time(),
            'id_anggota' => $this->request->getPost('id_anggota'),
            'kode_buku' => $this->request->getPost('kode_buku'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => 'dipinjam',
        ];

        // Simpan data ke database
        $this->peminjamanModel->insert($data);

        return redirect()->to('/peminjaman')->with('success', 'Data peminjaman berhasil ditambahkan.');
    }
}
