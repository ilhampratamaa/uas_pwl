<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
<div class="container my-5">
    <h2 class="mb-4">Keranjang Anda</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
        <div class="alert alert-info">Keranjang masih kosong.</div>
        <a href="<?= site_url('buyer') ?>" class="btn btn-outline-dark">
            ← Lihat Produk
        </a>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td>Rp<?= number_format($item['price']) ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td>Rp<?= number_format($item['price'] * $item['qty']) ?></td>
                            <td>
                                <a href="<?= site_url('buyer/cart/remove/' . $item['product_id']) ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php $total += $item['price'] * $item['qty']; ?>
                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                        <td colspan="2"><strong>Rp<?= number_format($total) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= site_url('buyer/cart/clear') ?>" class="btn btn-outline-danger">
                <i class="bi bi-x-circle"></i> Kosongkan Keranjang
            </a>
            <a href="<?= site_url('buyer/checkout') ?>" class="btn btn-success">
                <i class="bi bi-cart-check"></i> Checkout
            </a>
        </div>
    <?php endif; ?>
</div>

</section>

<?= $this->endSection() ?>
