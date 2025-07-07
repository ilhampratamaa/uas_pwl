<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
<div class="container my-5">
    <h2 class="mb-4">Konfirmasi Checkout</h2>

    <form action="<?= site_url('buyer/checkout/process') ?>" method="post">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?= esc($item['name']) ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td>Rp<?= number_format($item['price']) ?></td>
                            <td>Rp<?= number_format($item['price'] * $item['qty']) ?></td>
                        </tr>
                        <?php $total += $item['price'] * $item['qty']; ?>
                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <td colspan="3" class="text-end"><strong>Total</strong></td>
                        <td><strong>Rp<?= number_format($total) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="<?= site_url('buyer/cart') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Keranjang
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Proses Checkout
            </button>
        </div>
    </form>
</div>


</section>

<?= $this->endSection() ?>
