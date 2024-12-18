<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Daftar Peminjaman</h3>
            <a href="/peminjaman/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Transaksi</th>
                    <th>ID Anggota</th>
                    <th>Kode Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($peminjaman as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nomor_transaksi'] ?></td>
                    <td><?= $row['id_anggota'] ?></td>
                    <td><?= $row['kode_buku'] ?></td>
                    <td><?= $row['tanggal_pinjam'] ?></td>
                    <td><?= $row['tanggal_kembali'] ?></td>
                    <td>
                        <span class="badge <?= $row['status'] == 'dipinjam' ? 'badge-warning' : 'badge-success' ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
