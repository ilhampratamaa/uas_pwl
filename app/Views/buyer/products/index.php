<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($products as $p): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="/uploads/products/<?= esc($p['photo']) ?>" class="card-img-top" alt="<?= esc($p['name']) ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title"><?= esc($p['name']) ?></h5>
                    <p class="card-text">Rp<?= number_format($p['price']) ?></p>
                    <a href="<?= site_url('product/' . $p['id']) ?>" class="btn btn-outline-dark w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
