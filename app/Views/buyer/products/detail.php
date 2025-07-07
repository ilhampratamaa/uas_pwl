<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0 rounded shadow-sm"
                     src="/uploads/products/<?= esc($product['photo']) ?>"
                     alt="<?= esc($product['name']) ?>" />
            </div>
            <div class="col-md-6">
                <div class="small mb-1">ID: #<?= esc($product['id']) ?></div>
                <h1 class="display-5 fw-bolder"><?= esc($product['name']) ?></h1>

                <div class="fs-4 mb-3 text-primary">
                    Rp<?= number_format($product['price']) ?>
                </div>

                <p class="lead mb-4"><?= nl2br(esc($product['description'])) ?></p>
                <p><strong>Stok:</strong>
                    <?= $product['stock'] > 0 ? $product['stock'] : '<span class="text-danger">Stok Habis</span>' ?>
                </p>

                <?php if ($product['stock'] > 0): ?>
                    <form action="<?= site_url('buyer/cart/add/' . $product['id']) ?>" method="post" class="mt-3">
                        <div class="d-flex mb-3">
                            <input class="form-control text-center me-3"
                                   name="qty"
                                   type="number"
                                   value="1"
                                   min="1"
                                   max="<?= $product['stock'] ?>"
                                   style="max-width: 5rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-danger mt-3">Stok habis, tidak dapat dipesan.</div>
                <?php endif; ?>

                <a href="<?= site_url('/') ?>" class="btn btn-secondary mt-3">
                    ← Kembali ke Katalog
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
