<?= $this->extend('template/dashboard'); ?>
<?= $this->section('title') ?>
Dashboard <?= (in_groups('admin') ? '- Admin' : (in_groups('panitia') ? '- Panitia' : '')) ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="expand-btn">
    <a id="menu-btn"><i class='bx bxs-left-arrow'></i></a>
</div>
<div class="p-4">
    <div class="card bg-transparent border-0">
        <div class="card-body">
            <h3 class="card-title d-inline"><?= (in_groups('examp')) ? 'SELAMAT DATANG DI WEB' : '' ?> UJI PETIK</h3>
            <img src="<?= base_url('assets/img/kai.png') ?>" alt="LOGO" class="img-fluid float-end" style="height: 50px;">
            <h5 class="card-subtitle">Balai Yasa Mekanik Cirebon Prujakan</h5>
        </div>
    </div>
    <div class="mt-5 ms-3">
        <?php if ($mulai > 0) : ?>
            <h5>UJIAN SEDANG BERLANGSUNG</h5>
        <?php else : ?>
            <h5>MULAI UJIAN</h5>
            <div class="btn-group mt-2" role="group" style="width: 30rem;">
                <input id="duration" type="number" class="btn text-start btn-primary bg-transparent text-dark rounded-start-pill" placeholder="30">
                <select id="format" class="btn text-start btn-primary bg-transparent text-dark" style="width: 1rem;">
                    <option value="minute">Menit</option>
                    <option value="hour">Jam</option>
                </select>
                <button type="button" class="btn btn-primary rounded-end-pill fw-bold" style="width: 1rem;">MULAI</button>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    const button = document.querySelector('button[type=button]');
    if (button) {
        button.addEventListener('click', function(e) {
            const duration = document.querySelector('#duration');
            const format = document.querySelector('#format');
            const data = {
                duration: duration.value,
                format: format.value
            };
    
            fetch('/dashboard/start', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: data.message,
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Tidak dapat memulai ujian !.",
                            icon: "error",
                        });
                    }
                });
        });
    }
</script>
<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<?= $this->endSection(); ?>