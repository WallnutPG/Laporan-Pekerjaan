<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="<?= base_url('assets/img/kai.png') ?>" type="image/x-icon" sizes="32x32">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/boxicons/css/boxicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
</head>

<body>
    <!-- Sidebar -->
    <?= $this->include('template/sidebar'); ?>
    <!-- End Sidebar -->

    <!-- Main Wrapper -->
    <div class="my-container active-cont">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- bootstrap js -->
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>