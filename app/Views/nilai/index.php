<?= $this->extend('template/dashboard'); ?>
<?= $this->section('title') ?>
Dashboard <?= (in_groups('admin') ? '- Admin' : (in_groups('panitia') ? '- Panitia' : '')) ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="expand-btn">
    <a id="menu-btn"><i class='bx bxs-left-arrow'></i></a>
</div>
<div class="p-4">
    <div class="card border-0 bg-transparent">
        <div class="card-body">
            <h3 class="card-title d-inline"><?= (in_groups('examp')) ? 'SELAMAT DATANG DI WEB' : '' ?> UJI PETIK</h3>
            <img src="<?= base_url('assets/img/kai.png') ?>" alt="LOGO" class="img-fluid float-end"
                style="height: 50px;">
            <h5 class="card-subtitle">Balai Yasa Mekanik Cirebon Prujakan</h5>
        </div>
    </div>
    <div class="col">
        <div class="card border-0 shadow-sm my-4">
            <div class="card-body">
                <h3 class="card-title">Nilai Ujian</h3>
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kelompok</th>
                            <th>Topik</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($nilais) == 0): ?>
                            <tr>
                                <td colspan="5" class="text-center fst-italic">Tidak ada nilai</td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($nilais as $i => $nilai) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $nilai['name'] ?></td>
                            <td><?= $nilai['kelompok'] ?></td>
                            <td><?= $nilai['topik'] ?></td>
                            <td><?= $nilai['nilai'] ?></td>
                        </tr>
                        <?php
                        endforeach; ?>
                    </tbody>

            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/include/peserta.js') ?>"></script>

<?= $this->endSection(); ?>