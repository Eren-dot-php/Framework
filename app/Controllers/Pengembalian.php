<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class Pengembalian extends BaseController
{
    protected $peminjamanModel;
    protected $pengembalianModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->pengembalianModel = new PengembalianModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengembalian',
            'pengembalian' => $this->pengembalianModel->findAll(),
        ];

        return view('pengembalian/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $nomorTransaksi = $this->request->getPost('nomor_transaksi');

            // Cari data peminjaman berdasarkan nomor transaksi
            $peminjaman = $this->peminjamanModel->where('nomor_transaksi', $nomorTransaksi)
                                                ->where('status', 'dipinjam')
                                                ->first();

            if (!$peminjaman) {
                return redirect()->back()->with('error', 'Nomor transaksi tidak valid atau buku sudah dikembalikan.');
            }

            // Hitung denda keterlambatan
            $tanggalDikembalikan = date('Y-m-d');
            $tanggalKembali = $peminjaman['tanggal_kembali'];
            $denda = $this->hitungDenda($tanggalKembali, $tanggalDikembalikan);

            // Simpan data pengembalian
            $this->pengembalianModel->insert([
                'nomor_transaksi' => $nomorTransaksi,
                'tanggal_dikembalikan' => $tanggalDikembalikan,
                'denda' => $denda,
            ]);

            // Update status di tabel peminjaman
            $this->peminjamanModel->update($peminjaman['id'], ['status' => 'dikembalikan']);

            return redirect()->to('/pengembalian')->with('success', 'Buku berhasil dikembalikan. Denda: Rp' . $denda);
        }

        return view('pengembalian/create', ['title' => 'Proses Pengembalian']);
    }

    private function hitungDenda($tanggalKembali, $tanggalDikembalikan)
    {
        $selisih = strtotime($tanggalDikembalikan) - strtotime($tanggalKembali);
        $hariTerlambat = max(0, floor($selisih / (60 * 60 * 24)));
        return $hariTerlambat * 500; // Denda Rp500 per hari
    }
}
