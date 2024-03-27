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
        <div class="col-lg-6 col-md-12">
            <div class="card border border-light-subtle shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="card-title">Petunjuk Penggunaan</h3>
                </div>
                <div class="card-body">
                    <ol>
                        <li>Pilihlah topik ujian pada menu Daftar Ujian.</li>
                        <li>Apabila tidak terdapat topik, bisa jadi disebabkan oleh:</li>
                        <ul>
                            <li>Sedang tidak ada ujian berlangsung.</li>
                            <li>Admin belum memulai ujian.</li>
                        </ul>
                        <li>Terdapat navigasi soal di bagian kiri layar untuk berpindah antar soal.</li>
                        <li>Terdapat tombol "SELESAI" untuk mengirim lembar jawaban, pastikan Anda sudah mengisi semua soal.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card border border-light-subtle shadow-sm">
                <div class="card-header bg-white border-0">
                    <h3 class="card-title">Daftar Ujian</h3>
                </div>
                <?php if (count($ujians) == 0) : ?>
                    <div class="card-body">
                        <h6>Tidak ada ujian yang tersedia.</h6>
                    </div>
                <?php else : ?>
                    <?php foreach ($ujians as $ujian) : ?>
                        <?php if ($ujian['mulai'] != 0) : ?>
                            <div class="card-body">
                                <div class="card border <?= $cekNilai == 0 ? 'border-primary' : 'border-success' ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="<?= $cekNilai == 0 ? 'col-12' : 'col-8' ?>">
                                                <h6>Topik Ujian: <?= $ujian['topik'] ?></h6>
                                                <?php
                                                $seconds = intval($ujian['durasi']);
                                                $hours = floor($seconds / 3600);
                                                $minutes = floor(($seconds % 3600) / 60);
                                                $formatted_time = sprintf('%02d:%02d', $hours, $minutes);
                                                ?>
                                                <p>Durasi Ujian: <?= $formatted_time ?> menit</p>
                                            </div>
                                            <?php if ($cekNilai != 0) : ?>
                                                <div class="col-4 text-end">
                                                    <h5><span class="badge text-bg-success"><i class='bx bxs-check-circle me-2'></i>SELESAI</span></h5>
                                                    <p><b>Nilai:</b> <?= $hasilUjian['nilai'] ?>/100</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($cekNilai == 0) : ?>
                                            <button class="btn <?= $cekNilai == 0 ? 'btn-primary' : 'btn-success' ?> w-100 fw-bold" onclick="window.location.href = '<?= base_url("examp/ujian/" . bin2hex($ujian['topik']) . "") ?>'">
                                                Mulai Ujian
                                            </button>
                                        <?php else : ?>
                                            <?php $ujianTopik = str_replace(' ', '', $ujian['topik']) ?>
                                            <button class="btn btn-success w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#HasilUjian<?= $ujianTopik ?>">Lihat Hasil</button>

                                            <div class="modal" id="HasilUjian<?= $ujianTopik ?>" tabindex="-1" aria-labelledby="HasilUjian<?= $ujianTopik ?>Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h1 class="modal-title fs-4 d-inline" id="HasilUjian<?= $ujianTopik ?>Label">Topik: <?= $ujian['topik'] ?></h1>
                                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <b>Peserta</b>
                                                                    <span class="float-end">:</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?= $user['nama'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <b>Nilai</b>
                                                                    <span class="float-end">:</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                    $nilai = $hasilUjian['nilai'];
                                                                    $badge = '';

                                                                    if ($nilai >= 10 && $nilai <= 30) {
                                                                        $badge = 'danger';
                                                                    } elseif ($nilai >= 40 && $nilai <= 50) {
                                                                        $badge = 'warning';
                                                                    } elseif ($nilai >= 60 && $nilai <= 80) {
                                                                        $badge = 'success';
                                                                    } elseif ($nilai >= 90 && $nilai <= 100) {
                                                                        $badge = 'primary';
                                                                    }
                                                                    ?>
                                                                    <span class="badge text-bg-<?= $badge ?>">
                                                                        <?= $hasilUjian['nilai'] ?> / 100
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <b>Tanggal Ujian</b>
                                                                    <span class="float-end">:</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <?php
                                                                    $created_at = $hasilUjian['created_at'];
                                                                    $date = date('d/m/Y', strtotime($created_at));
                                                                    $time = date('H:i:s', strtotime($created_at));
                                                                    echo "{$date} - {$time}";
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="card-body">
                                <h6>Tidak ada ujian yang tersedia.</h6>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<?= $this->endSection(); ?>