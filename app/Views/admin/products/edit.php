<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white me-2">
            <i class="mdi mdi-pencil-box"></i>
        </span> Edit Produk
    </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Produk</h4>

                <form action="<?= site_url('admin/products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" value="<?= esc($product['name']) ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" value="<?= esc($product['price']) ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" value="<?= esc($product['stock']) ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4"><?= esc($product['description']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Produk (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                    <a href="<?= site_url('admin/products') ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>