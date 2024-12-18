<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'kode_buku';
    protected $allowedFields = ['kode_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit', 'jumlah_eksemplar'];

    // Periksa apakah buku tersedia (jumlah eksemplar > 0)
    public function isBukuTersedia($kode_buku)
    {
        $buku = $this->where('kode_buku', $kode_buku)->first();
        return $buku && $buku['jumlah_eksemplar'] > 0;
    }

    // Kurangi stok buku
    public function kurangiStok($kode_buku)
    {
        $this->set('jumlah_eksemplar', 'jumlah_eksemplar - 1', false)
             ->where('kode_buku', $kode_buku)
             ->update();
    }

    public function tambahStok($kode_buku)
    {
        $this->set('jumlah_eksemplar', 'jumlah_eksemplar + 1', false)
            ->where('kode_buku', $kode_buku)
            ->update();
    }
}
