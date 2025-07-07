<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
<div class="container my-5">
    <h2 class="mb-4">Detail Transaksi #<?= $transaction['id'] ?></h2>

    <div class="mb-3">
        <p>Status: 
            <?php if ($transaction['status'] === 'pending'): ?>
                <span class="badge bg-warning text-dark">Pending</span>
            <?php elseif ($transaction['status'] === 'confirmed'): ?>
                <span class="badge bg-success">Terkonfirmasi</span>
            <?php elseif ($transaction['status'] === 'canceled'): ?>
                <span class="badge bg-danger">Dibatalkan</span>
            <?php else: ?>
                <span class="badge bg-secondary"><?= ucfirst($transaction['status']) ?></span>
            <?php endif; ?>
        </p>
        <p>Total: <strong>Rp<?= number_format($transaction['total_price']) ?></strong></p>
        <p>Akun Game (jika tersedia): <strong><?= $transaction['akun_game'] ?? '-' ?></strong></p>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $item): ?>
                    <tr>
                        <td><?= esc($item['product_id']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>Rp<?= number_format($item['price']) ?></td>
                        <td>Rp<?= number_format($item['subtotal']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="<?= site_url('buyer/transactions') ?>" class="btn btn-outline-primary mt-3">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke Riwayat
    </a>
</div>

</section>

<?= $this->endSection() ?>
