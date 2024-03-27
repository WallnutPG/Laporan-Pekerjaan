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
        <div class="col-md-6">
            <div class="card border-0 shadow-sm my-3">
                <div class="card-body">
                    <h3 class="card-title">Kelompok</h3>

                    <div class="mt-3">
                        <button class="btn btn-success rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addGroup"><i class='bx bxs-plus-circle fw-bold me-2'></i>Tambah Kelompok</button>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Kelompok</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($kelompoks as $i => $kelompok) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td><?= $kelompok['name'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-3" data-id="<?= $kelompok['id'] ?>" onclick="removeKelompok(this)"><i class='bx bxs-trash'></i></button>
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

        <div class="col-md-6">
            <div class="card border-0 shadow-sm my-3">
                <div class="card-body">
                    <h3 class="card-title"><?= (in_groups('examp')) ? 'SELAMAT DATANG DI WEB' : '' ?> Peserta</h3>

                    <div class="mt-3">
                        <button class="btn btn-success rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addUser"><i class='bx bxs-user-plus fw-bold me-2'></i>Tambah Peserta</button>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelompok</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody id="tablePeserta">
                                    <?php foreach ($profiles as $i => $profile) : ?>
                                        <tr>
                                            <td class="text-center"><?= ((($current_page ?? 1) - 1) * 10) + $i + 1 ?></td>
                                            <td><?= $profile['nama'] ?></td>
                                            <td><?= $profile['kelompok'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger btnRemovePeserta" data-id="<?= $profile['user_id'] ?>" onclick="removePeserta(this)"><i class='bx bxs-trash'></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-3">
                        <?= $pagination ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addGroup" tabindex="-1" aria-labelledby="addGroupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-3" id="addGroupLabel">Tambah Kelompok</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addKelompok" action="<?= base_url('dashboard/peserta/addKelompok') ?>">
                        <div class="form-group">
                            <label for="kelompok" class="form-label fw-bold">Nama Kelompok</label>
                            <input type="text" class="form-control" name="nama" id="kelompok" placeholder="Masukan Nama Kelompok" require>
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

    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-3" id="addUserLabel">Tambah Peserta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPeserta" action="<?= base_url('/register') ?>">
                        <div class="form-group">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="username" class="form-label fw-bold">NRP</label>
                            <input type="number" name="username" id="username" class="form-control" placeholder="Masukan NRP" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="fullname" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Masukan Nama Lengkap" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukan Jabatan" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="password" class="form-label fw-bold">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan Kata Sandi" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="pass_confirm" class="form-label fw-bold">Ulangi Kata Sandi</label>
                            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="Masukan Kata Sandi" require>
                        </div>

                        <div class="form-group mt-2">
                            <label for="kelompok" class="form-label fw-bold">Kelompok</label>
                            <select class="form-control" name="kelompok" id="kelompok">
                                <option selected>Pilih Kelompok</option>
                                <?php foreach ($kelompoks as $kelompok) : ?>
                                    <option value="<?= $kelompok['id'] ?>"><?= $kelompok['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
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
<script src="<?= base_url('assets/js/include/peserta.js') ?>"></script>

<?= $this->endSection(); ?>