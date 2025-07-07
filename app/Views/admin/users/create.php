<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
            <i class="mdi mdi-account-plus"></i>
        </span> Tambah Pengguna
    </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Tambah Pengguna</h4>

                <form action="<?= site_url('admin/users/store') ?>" method="post" class="forms-sample">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="buyer" selected>Buyer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Simpan</button>
                    <a href="<?= site_url('admin/users') ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>