<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Anggota</h3>
    </div>
    <div class="card-body">
        <form action="/anggota/update/<?= $anggota['id'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="id_anggota">ID Anggota</label>
                <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?= $anggota['id_anggota'] ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $anggota['nama'] ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $anggota['alamat'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $anggota['nomor_telepon'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $anggota['email'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="/anggota" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
