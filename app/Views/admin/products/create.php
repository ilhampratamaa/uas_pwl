<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-plus-box"></i>
        </span> Tambah Produk
    </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Tambah Produk</h4>

                <form action="<?= site_url('admin/products/store') ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control" placeholder="Harga" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="number" name="stock" class="form-control" placeholder="Stok" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi Produk"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Produk</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Simpan</button>
                    <a href="<?= site_url('admin/products') ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>