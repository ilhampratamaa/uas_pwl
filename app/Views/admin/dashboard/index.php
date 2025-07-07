<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info text-white">
            <div class="card-body">
                <h4 class="mb-3">Total Penjualan</h4>
                <h2>Rp<?= number_format($totalSales) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success text-white">
            <div class="card-body">
                <h4 class="mb-3">Total Transaksi Sukses</h4>
                <h2><?= $totalTransactions ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning text-white">
            <div class="card-body">
                <h4 class="mb-3">Total Pembeli</h4>
                <h2><?= $totalUsers ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title">Daftar Transaksi Terbaru</h4>
                    <a href="<?= site_url('admin/export-pdf') ?>" target="_blank" class="btn btn-sm btn-gradient-primary">
                        <i class="mdi mdi-file-pdf me-1"></i> Cetak PDF
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $trx): ?>
                                <tr>
                                    <td><?= $trx['id'] ?></td>
                                    <td>Rp<?= number_format($trx['total_price']) ?></td>
                                    <td><span class="badge <?= $trx['status'] === 'sukses' ? 'badge-gradient-success' : 'badge-gradient-warning' ?>"><?= ucfirst($trx['status']) ?></span></td>
                                    <td><?= $trx['created_at'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>