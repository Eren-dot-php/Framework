<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $bukuModel = new BukuModel();
        $anggotaModel = new AnggotaModel();
        $peminjamanModel = new PeminjamanModel();

        $data = [
            'title' => 'Dashboard Admin',
            'jumlah_buku' => $bukuModel->countAll(),
            'jumlah_anggota' => $anggotaModel->countAll(),
            'transaksi_aktif' => $peminjamanModel->where('status', 'dipinjam')->countAllResults(),
            'buku_dipinjam' => $peminjamanModel->select('peminjaman.*, buku.judul, anggota.nama')
                ->join('buku', 'buku.kode_buku = peminjaman.kode_buku')
                ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota')
                ->where('peminjaman.status', 'dipinjam')
                ->findAll(),
        ];

        return view('dashboard/index', $data);
    }
}
