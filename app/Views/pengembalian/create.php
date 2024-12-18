<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Proses Pengembalian Buku</h3>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="/pengembalian/create" method="post">
            <div class="form-group">
                <label for="nomor_transaksi">Nomor Transaksi</label>
                <input type="text" name="nomor_transaksi" id="nomor_transaksi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Proses Pengembalian</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
