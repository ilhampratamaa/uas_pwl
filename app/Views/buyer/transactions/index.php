<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
<div class="container my-5">
    <h2 class="mb-4">Riwayat Transaksi Anda</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($transactions)): ?>
        <div class="alert alert-info">Belum ada transaksi yang tercatat.</div>
        <a href="<?= site_url('buyer') ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left-circle"></i> Lanjut Belanja
        </a>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $trx): ?>
                        <tr>
                            <td>#<?= $trx['id'] ?></td>
                            <td>Rp<?= number_format($trx['total_price']) ?></td>
                            <td>
                                <?php if ($trx['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php elseif ($trx['status'] === 'confirmed'): ?>
                                    <span class="badge bg-success">Terkonfirmasi</span>
                                <?php elseif ($trx['status'] === 'canceled'): ?>
                                    <span class="badge bg-danger">Dibatalkan</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= ucfirst($trx['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y, H:i', strtotime($trx['created_at'])) ?></td>
                            <td>
                                <a href="<?= site_url('buyer/transactions/' . $trx['id']) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</section>

<?= $this->endSection() ?>
