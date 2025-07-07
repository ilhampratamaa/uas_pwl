<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-warning text-white me-2">
            <i class="mdi mdi-cart"></i>
        </span> Daftar Transaksi
    </h3>
</div>

<div class="row mt-3">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Transaksi</h4>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $t): ?>
                                <tr>
                                    <td><?= $t['id'] ?></td>
                                    <td><?= esc($t['username']) ?></td>
                                    <td>Rp<?= number_format($t['total_price']) ?></td>
                                    <td>
                                        <?php
                                            $badgeClass = '';
                                            switch ($t['status']) {
                                                case 'confirmed':
                                                case 'verified':
                                                    $badgeClass = 'bg-success';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'bg-warning text-dark';
                                                    break;
                                                case 'canceled':
                                                    $badgeClass = 'bg-danger';
                                                    break;
                                                default:
                                                    $badgeClass = 'bg-secondary';
                                                    break;
                                            }
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= ucfirst($t['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($t['status'] == 'pending'): ?>
                                            <a href="<?= site_url('admin/transactions/confirm/' . $t['id']) ?>" class="btn btn-sm btn-gradient-success me-2">Konfirmasi</a>
                                            <a href="<?= site_url('admin/transactions/cancel/' . $t['id']) ?>" class="btn btn-sm btn-gradient-warning me-2" onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini? Ini akan mengembalikan stok produk.');">Batalkan</a>
                                            <!-- Tombol Hapus TIDAK ditampilkan untuk status pending -->
                                        <?php else: ?>
                                            <span class="text-success">Dikonfirmasi</span><br>
                                            <a href="<?= site_url('admin/transactions/detail/' . $t['id']) ?>" class="btn btn-sm btn-info mt-1 me-2">Detail</a>
                                            <!-- Tombol Hapus ditampilkan untuk status selain pending -->
                                            <a href="<?= site_url('admin/transactions/delete/' . $t['id']) ?>" class="btn btn-sm btn-danger mt-1" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini secara permanen? Aksi ini tidak dapat dibatalkan dan stok akan dikembalikan!');">Hapus</a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
