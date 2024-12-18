<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_transaksi', 'id_anggota', 'kode_buku', 'tanggal_pinjam', 'tanggal_kembali', 'status'];
}