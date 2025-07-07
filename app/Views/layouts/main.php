<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?? 'GameStore' ?></title>

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS-->
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        main {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* agar konten utama mengisi sisa ruang antara navbar dan footer */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?= view('partials/navbar') ?>

<!-- Header hanya muncul di halaman / -->
<?php if (uri_string() === ''): ?>
<header class="bg-dark py-5 mb-4">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder"><?= $title ?? 'GameStore' ?></h1>
            <p class="lead fw-normal text-white-50 mb-0">Temukan akun game favoritmu di sini!</p>
        </div>
    </div>
</header>
<?php endif; ?>


<?php if (uri_string() === ''): ?>
<!-- Content -->
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-3">
        <?= $this->renderSection('content') ?>
    </div>
</main>
<?php else: ?>
<main class="py-0">
    <div class="container px-4 px-lg-5 mt-0">
        <?= $this->renderSection('content') ?>
    </div>
</main>
<?php endif; ?>


<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; <?= date('Y') ?> GameStore</p></div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
