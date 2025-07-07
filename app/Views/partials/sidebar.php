<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="/template/assets/images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?= session('username') ?></span>
                    <span class="text-secondary text-small">Administrator</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin') ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/products') ?>">
                <span class="menu-title">Kelola Produk</span>
                <i class="mdi mdi-gamepad-variant menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/users') ?>">
                <span class="menu-title">Data Konsumen</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('admin/transactions') ?>">
                <span class="menu-title">Data Transaksi</span>
                <i class="mdi mdi-cart menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('logout') ?>">
                <span class="menu-title text-danger">Logout</span>
                <i class="mdi mdi-logout menu-icon text-danger"></i>
            </a>
        </li>
    </ul>
</nav>