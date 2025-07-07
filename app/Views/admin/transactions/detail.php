<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white me-2">
            <i class="mdi mdi-file-document-box"></i>
        </span> Detail Transaksi #<?= $transaction['id'] ?>
    </h3>
</div>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p><strong>Username:</strong> <?= esc($transaction['username']) ?></p>
                <p><strong>Status:</strong>
                    <span class="badge bg-<?= $transaction['status'] === 'confirmed' ? 'success' : 'warning' ?>">
                        <?= ucfirst($transaction['status']) ?>
                    </span>
                </p>
                <p><strong>Total:</strong> Rp<?= number_format($transaction['total_price']) ?></p>

                <?php if ($transaction['status'] === 'confirmed'): ?>
                    <div class="mt-3">
                        <p><strong>Akun Game:</strong></p>
                        <div class="alert alert-success"><?= nl2br(esc($transaction['akun_game'])) ?></div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Produk yang Dipesan</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $item): ?>
                                <tr>
                                    <td><?= esc($item['product_name']) ?></td>
                                    <td><?= esc($item['quantity']) ?></td>
                                    <td>Rp<?= number_format($item['price']) ?></td>
                                    <td>Rp<?= number_format($item['subtotal']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <a href="<?= site_url('admin/transactions') ?>" class="btn btn-light mt-3">Kembali ke Daftar Transaksi</a>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>