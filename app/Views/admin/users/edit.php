<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-info text-white me-2">
            <i class="mdi mdi-account-edit"></i>
        </span> Edit Pengguna
    </h3>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Edit Pengguna</h4>

                <form action="<?= site_url('admin/users/update/' . $user['id']) ?>" method="post" class="forms-sample">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?= esc($user['username']) ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="buyer" <?= $user['role'] === 'buyer' ? 'selected' : '' ?>>Buyer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                    <a href="<?= site_url('admin/users') ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>