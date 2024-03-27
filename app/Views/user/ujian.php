<?= $this->extend('template/dashboard'); ?>
<?= $this->section('title') ?>
Ujian - <?= $topik ?>
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
        <div class="col-md-4 col-12 col-sticky">
            <div class="card border border-light-subtle shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Topik Ujian</h3>
                    <h3><strong><?= $topik ?></strong></h3>
                </div>
            </div>
            <div class="card border border-light-subtle shadow-sm mt-3">
                <div class="card-body">
                    <h3 class="card-title">Sisa Waktu</h3>
                    <h1 id="countdown" class="fs-4"></h1>
                </div>
            </div>
            <div class="card border border-light-subtle shadow-sm my-3">
                <div class="card-body">
                    <h3>Navigasi Soal</h3>
                    <?php for ($no = 1; $no <= $jumlahSoal; $no++) : ?>
                        <button class="btn btn-sm m-1 btn-outline-secondary selectSoal rounded-3" id="SoalBtn<?= $no - 1 ?>" onclick="SelectSoal(<?= $no ?>, this)"><?= $no ?></button>
                    <?php endfor;  ?>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <form id="formUjian">
                <?php foreach ($soals as $nourut => $soal) : ?>
                    <div class="card border border-light-subtle shadow-sm mb-3 rounded-4 soal" data-soal="<?= $nourut ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <ol>
                                    <li value="<?= $nourut + 1 ?>"><?= $soal['question'] ?></li>
                                </ol>
                            </h5>

                            <div class="selectedSoal">
                                <div class="form-check mx-4">
                                    <input class="form-check-input border-primary" type="radio" name="jawaban[<?= $soal['id'] ?>]" id="choice_a<?= $soal['id'] ?>" value="<?= bin2hex($soal['value_a']) ?>">
                                    <label class="form-check-label" for="choice_a<?= $soal['id'] ?>">
                                        <?= $soal['choice_a'] ?>
                                    </label>
                                </div>
                                <div class="form-check mx-4">
                                    <input class="form-check-input border-primary" type="radio" name="jawaban[<?= $soal['id'] ?>]" id="choice_b<?= $soal['id'] ?>" value="<?= bin2hex($soal['value_b']) ?>">
                                    <label class="form-check-label" for="choice_b<?= $soal['id'] ?>">
                                        <?= $soal['choice_b'] ?>
                                    </label>
                                </div>
                                <div class="form-check mx-4">
                                    <input class="form-check-input border-primary" type="radio" name="jawaban[<?= $soal['id'] ?>]" id="choice_c<?= $soal['id'] ?>" value="<?= bin2hex($soal['value_c']) ?>">
                                    <label class="form-check-label" for="choice_c<?= $soal['id'] ?>">
                                        <?= $soal['choice_c'] ?>
                                    </label>
                                </div>
                                <div class="form-check mx-4">
                                    <input class="form-check-input border-primary" type="radio" name="jawaban[<?= $soal['id'] ?>]" id="choice_d<?= $soal['id'] ?>" value="<?= bin2hex($soal['value_d']) ?>">
                                    <label class="form-check-label" for="choice_d<?= $soal['id'] ?>">
                                        <?= $soal['choice_d'] ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="btn-group me-2" role="group">
                    <button type="button" class="btn btn-outline-primary rounded-start-pill" id="PrevBtn" onclick="PrevSoal()">
                        <i class='bx bxs-left-arrow-circle me-2'></i>Prev
                    </button>
                    <button type="button" class="btn btn-outline-primary border-start-0 rounded-end-pill" id="NextBtn" onclick="NextSoal()">
                        Next<i class='bx bxs-right-arrow-circle ms-2'></i>
                    </button>
                </div>
                <button type="button" class="btn btn-danger rounded-pill fw-bold float-end reset" onclick="selesai()" href="/examp/selesai"><i class='bx bxs-check-circle me-2'></i>SELESAI</button>
                <button class="btn btn-secondary fw-bold rounded-pill float-end me-2" type="button" onclick="reset()">RESET</button>
            </form>
        </div>
    </div>
</div>

<script>
    let countdown = '<?= $CountDown ?>';
</script>

<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/include/ujian.js') ?>"></script>
<?= $this->endSection(); ?>