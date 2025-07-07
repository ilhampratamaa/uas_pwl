<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'GameStore' ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/template/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/template/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/template/assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">

        <!-- Navbar -->
        <?= view('partials/navbar_admin') ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?= view('partials/sidebar') ?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright &copy; <?= date('Y') ?> GameStore</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/template/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/template/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="/template/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/template/assets/js/off-canvas.js"></script>
    <script src="/template/assets/js/hoverable-collapse.js"></script>
    <script src="/template/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/template/assets/js/dashboard.js"></script>
    <script src="/template/assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
</body>

</html>