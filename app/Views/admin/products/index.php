<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-gamepad-variant"></i>
        </span> Kelola Produk
    </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Data Produk</h4>
                <a href="<?= site_url('admin/products/create') ?>" class="btn btn-gradient-success btn-sm mb-3">
                    <i class="mdi mdi-plus"></i> Tambah Produk
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                                <tr>
                                    <td><?= esc($p['name']) ?></td>
                                    <td>Rp<?= number_format($p['price'], 0, ',', '.') ?></td>
                                    <td><?= esc($p['stock']) ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/products/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                        <a href="<?= site_url('admin/products/delete/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            <i class="mdi mdi-delete"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data produk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>