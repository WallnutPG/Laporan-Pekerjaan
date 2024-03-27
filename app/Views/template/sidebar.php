<div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100">
        <div class="fs-5 fw-bold text-white my-2 my-4 text-center">
            <?php if (in_groups('admin')) : ?>
            ADMIN DASHBOARD
            <?php elseif (in_groups('panitia')) : ?>
            PANITIA DASHBOARD
            <?php else : ?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="profile bg-white rounded-circle p-3">
                    <img src="<?= base_url('assets/img/avatar.png') ?>" alt="" srcset="" width="70">
                </div>
            </div>
            <div class="mt-3">
                <h5 class="text-center"><?= $user['nama'] ?></h5>
                <h6 class="text-center"><?= $user['jabatan'] ?></h6>
            </div>

            <div class="mt-5 text-start mx-3">
                <h6>NRP: <?= $user['nrp'] ?></h6>
            </div>

            <?php endif; ?>

            <div class="time"></div>
        </div>

        <div>
            <hr>
        </div>

        <a href="<?= base_url('dashboard') ?>" class="nav-link">
            <i class="bx bxs-dashboard"></i>
            <span class="mx-2">Home</span>
        </a>
        <?php if (in_groups('admin')) : ?>
        <a href="<?= base_url('dashboard/peserta') ?>" class="nav-link">
            <i class='bx bxs-user'></i>
            <span class="mx-2">Peserta</span>
        </a>
        <?php endif; ?>

        <?php if (in_groups('admin') || in_groups('panitia')) : ?>
        <a href="<?= base_url('dashboard/soal') ?>" class="nav-link">
            <i class='bx bxs-book-alt'></i>
            <span class="mx-2">Soal</span>
        </a>
        <a href="<?= base_url('dashboard/ujian') ?>" class="nav-link">
            <i class='bx bxs-pencil'></i>
            <span class="mx-2">Ujian</span>
        </a>
        <a href="<?= base_url('dashboard/nilai') ?>" class="nav-link">
            <i class='bx bxs-bar-chart-square'></i>
            <span class="mx-2">Nilai Ujian</span>
        </a>
        <?php endif; ?>
        <a href="<?= base_url('logout') ?>" class="nav-link bg-danger">
            <i class='bx bx-log-out'></i>
            <span class="mx-2">Logout</span>
        </a>
    </ul>
</div>