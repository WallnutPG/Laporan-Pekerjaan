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
            <img src="<?= base_url('assets/img/kai.png') ?>" alt="LOGO" class="img-fluid float-end" style="height: 50px;">
            <h5 class="card-subtitle">Balai Yasa Mekanik Cirebon Prujakan</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="card-title">Ujian</h3>
                        </div>
                        <div class="col-6">
                            <?php if (session()->has('message')) : ?>
                                <div class="alert alert-success">
                                    <?= session('message') ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-success rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addUjian"><i class='bx bxs-plus-circle me-2'></i>Tambah Ujian</button>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <th>No</th>
                                    <th>Kelompok</th>
                                    <th>Topik</th>
                                    <th>Mulai</th>
                                    <th>Durasi</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php if (count($ujians) == 0) :
                                    ?> <tr>
                                            <td colspan="4" class="text-center fst-italic">tidak ada ujian</td>
                                        </tr> <?php
                                            endif ?>
                                    <?php foreach ($ujians as $i => $ujian) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td class="text-center"><?= $ujian['kelompok'] ?></td>
                                            <td class="text-center"><?= $ujian['topik'] ?></td>
                                            <td class="text-center">
                                                <?= intval($ujian['mulai']) ? 'Telah Mulai' : 'Belum Mulai' ?>
                                            </td>
                                            <td class="text-center"><?= $ujian['durasi'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-3" data-id="<?= $ujian['id'] ?>" onclick="handleRemove(this, 'removeTopik')"><i class='bx bxs-trash'></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUjian" tabindex="-1" aria-labelledby="addUjianLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-3" id="addUjianLabel">Tambah Ujian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addUjian" method="post" action="<?= base_url('dashboard/ujian') ?>">
                        <div class="form-group">
                            <label for="Ujian" class="form-label fw-bold">Pilih Kelompok</label>
                            <select name="kelompok" class="form-control" id="Ujian">
                                <option selected>Pilih</option>
                                <?php foreach ($kelompoks as $key => $kelompok) {
                                    ?> <option value="<?= $kelompok['name'] ?>"><?= $kelompok['name'] ?></option> <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="topik" class="form-label fw-bold">Pilih Topik</label>
                            <select name="topik" class="form-control" id="topik">
                                <option selected>Pilih</option>
                                <?php foreach ($topiks as $key => $topik) {
                                    ?> <option value="<?= $topik['name'] ?>"><?= $topik['name'] ?></option> <?php 
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="durasi" class="form-label fw-bold">Durasi</label>
                            <input type="number" name="durasi" id="durasi" class="form-control" placeholder="30">
                        </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class='bx bx-x-circle me-2'></i>Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bxs-plus-circle me-2'></i>Tambah
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/include/ujian.js') ?>"></script>
<?= $this->endSection(); ?>