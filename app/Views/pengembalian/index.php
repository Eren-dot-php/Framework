<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Daftar Pengembalian</h2>
<a href="/pengembalian/create" class="btn btn-primary mb-3">Proses Pengembalian</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Dikembalikan</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pengembalian as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['tanggal_dikembalikan'] ?></td>
                <td>Rp<?= number_format($row['denda'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
