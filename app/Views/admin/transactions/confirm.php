<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
            <i class="mdi mdi-send"></i>
        </span> Konfirmasi Transaksi #<?= $transaction['id'] ?>
    </h3>
</div>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Kirim Informasi Akun Game</h4>
                <form action="<?= site_url('admin/transactions/update/' . $transaction['id']) ?>" method="post">
                    <div class="form-group">
                        <label>Informasi Akun Game (misal: username & password akun game)</label>
                        <textarea name="akun_game" rows="5" class="form-control" required><?= esc($transaction['akun_game']) ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary">Konfirmasi & Kirim Akun</button>
                    <a href="<?= site_url('admin/transactions') ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>