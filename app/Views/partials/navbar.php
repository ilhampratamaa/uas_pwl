<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?= site_url('/') ?>">🎮 GameStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (session()->get('isLoggedIn')): ?>
                    <?php if (session()->get('role') === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/products') ?>">Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/users') ?>">Pengguna</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/transactions') ?>">Transaksi</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('admin/report') ?>">Laporan</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('buyer/cart') ?>">Keranjang</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('buyer/transactions') ?>">Riwayat</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (session()->get('isLoggedIn')): ?>
                    <li class="nav-item d-flex align-items-center me-3">
                        👤 <?= session()->get('username') ?>
                    </li>
                    <li class="nav-item"><a class="btn btn-outline-dark" href="<?= site_url('/logout') ?>">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-outline-dark" href="<?= site_url('/login') ?>">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
