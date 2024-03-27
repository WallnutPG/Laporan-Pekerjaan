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
                    <h3 class="card-title">Topik</h3>

                    <div class="mt-3">
                        <button class="btn btn-success rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addTopik"><i class='bx bxs-plus-circle me-2'></i>Tambah Topik</button>
                    </div>

                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Topik</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($topiks as $i => $topik) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td class="text-center"><?= $topik['name'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-3" data-id="<?= $topik['id'] ?>" onclick="handleRemove(this, 'removeTopik')"><i class='bx bxs-trash'></i></button>
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
                    <h3 class="card-title"><?= (in_groups('examp')) ? 'SELAMAT DATANG DI WEB' : '' ?> Soal</h3>

                    <div class="mt-3">
                        <button class="btn btn-success rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#addExam"><i class='bx bxs-plus-circle me-2'></i>Tambah Soal</button>
                    </div>

                    <div class="mt-3">
                        <div id="soalTable" class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Topik</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($soals as $i => $soal) : ?>
                                        <tr>
                                            <td class="text-center"><?= $i + 1 ?></td>
                                            <td class="text-truncate" style="max-width: 8rem;"><?= $soal->question ?></td>
                                            <td class="text-center"><?= $soal->topik_name ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-danger rounded-3" data-id="<?= $soal->id ?>" onclick="handleRemove(this, 'removeSoal')"><i class='bx bxs-trash'></i></button>
                                            </td>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-2">
                        <?= $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTopik" tabindex="-1" aria-labelledby="addTopikLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-3" id="addTopikLabel">Tambah Topik</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addTopik" action="<?= base_url('dashboard/topik') ?>">
                        <div class="form-group">
                            <label for="Topik" class="form-label fw-bold">Nama Topik</label>
                            <input type="text" class="form-control" name="nama" id="Topik" placeholder="Masukan Nama Topik" require>
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

    <div class="modal fade" id="addExam" tabindex="-1" aria-labelledby="addExamLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="addExamLabel">Tambah Pertanyaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addQuestion" action="">
                    <div class="form-group mb-2">
                        <label for="topik" class="form-label fw-bold">Topik</label>
                        <select name="topik" id="topik" class="form-control">
                            <?php foreach($topiks as $topik): ?>
                                <option selected>Pilih Topik</option>
                                <option value="<?= $topik['id'] ?>"><?= $topik['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="question" class="form-label fw-bold">Pertanyaan</label>
                        <textarea class="form-control" name="question" id="question" cols="30" rows="5" placeholder="Masukan Pertanyaan" require></textarea>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="choice_a" placeholder="Pilihan A" require>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" name="value_a" placeholder="Nilai Jawaban A" require>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="choice_b" placeholder="Pilihan B" require>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" name="value_b" placeholder="Nilai Jawaban B" require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="choice_c" placeholder="Pilihan C" require>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" name="value_c" placeholder="Nilai Jawaban C" require>
                            </div>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="choice_d" placeholder="Pilihan D" require>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="number" class="form-control" name="value_d" placeholder="Nilai Jawaban D" require>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/include/soal.js') ?>"></script>
<?= $this->endSection(); ?>