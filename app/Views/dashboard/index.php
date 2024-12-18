<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h1>Dashboard</h1>
<div class="row">
    <div class="col-lg-4">
        <div class="info-box">
            <h3>Jumlah Buku: <?= $jumlah_buku ?></h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box">
            <h3>Jumlah Anggota: <?= $jumlah_anggota ?></h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box">
            <h3>Transaksi Aktif: <?= $transaksi_aktif ?></h3>
        </div>
    </div>
</div>

<h2>Daftar Buku yang Sedang Dipinjam</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID Peminjaman</th>
            <th>Judul Buku</th>
            <th>Nama Anggota</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($buku_dipinjam as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['tanggal_pinjam'] ?></td>
                <td><?= $row['tanggal_kembali'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
