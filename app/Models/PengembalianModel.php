<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nomor_transaksi', 'tanggal_dikembalikan', 'denda'];
}
