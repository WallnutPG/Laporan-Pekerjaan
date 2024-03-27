<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">
    <title>LOGIN</title>
</head>
<style>
    body {
        background-color: #041C40;
    }
</style>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 rounded-4 p-2">
                    <div class="card-header border-0 m-0 mb-3 mt-4 text-center">
                        <!-- <h3 class="text-center">Login</h3> -->
                        <img src="<?= base_url('assets/img/kai.png') ?>" alt="LOGO" class="img-fluid" style="height: 50px;">
                    </div>
                    <div class="card-body">
                        <form action="<?= url_to('login') ?>">
                            <div class="mb-3">
                                <input type="text" class="form-control rounded-pill bg-secondary border-secondary border-opacity-25 bg-opacity-25" id="username" name="login" placeholder="Username" required>
                            </div>

                            <div class="mb-3">
                                <input type="password" class="form-control rounded-pill bg-secondary border-secondary border-opacity-25 bg-opacity-25" id="password" name="password" placeholder="Password" required>
                            </div>

                            <?php if ($config->allowRemembering): ?>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="remember" class="form-check-input border-primary" id="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary w-100 mt- rounded-pill text-uppercase fw-bold p-2">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.querySelector('form');
        const loginInput = document.querySelector('[name="login"]');
        const passwordInput = document.querySelector('[name="password"]');

        console.log(form);

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const login = this.querySelector('[name="login"]').value;
            const password = this.querySelector('[name="password"]').value;

            if (login.trim() === '' && password.trim() !== '') {
                loginInput.classList.add('is-invalid');
                passwordInput.classList.remove('is-invalid');
                loginInput.setAttribute('required', true);

                return;
            }

            if (password.trim() === '' && login.trim() !== '') {
                loginInput.classList.remove('is-invalid');
                passwordInput.classList.add('is-invalid');
                loginInput.setAttribute('required', true);

                return;
            }

            if (login.trim() === '' && password.trim() == '') {
                loginInput.classList.add('is-invalid');
                passwordInput.classList.add('is-invalid');
                loginInput.setAttribute('required', true);
                passwordInput.setAttribute('required', true);

                return;
            }

            Swal.fire({
                title: 'Loading...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const url = form.getAttribute('action');

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ login, password }),
                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {
                        if (data.forcePasswordReset) {
                            window.location.href = 'URL_RESET_PASSWORD';
                        } else {
                            window.location.href = data.redirect;
                        }
                    } else {
                        if (data.errors) {
                            const errorsContainer = document.querySelector('.errors-container');
                            errorsContainer.innerHTML = '';

                            for (const error in data.errors) {
                                const errorMessage = document.createElement('div');
                                errorMessage.textContent = data.errors[error];
                                errorsContainer.appendChild(errorMessage);
                            }
                        } else if (data.error) {
                            Swal.fire({
                                icon: 'error',
                                width: 355,
                                title: 'Oops...',
                                text: data.error
                            })
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        });
        loginInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                this.removeAttribute('required');
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                this.removeAttribute('required');
            }
        });
    </script>
    <script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
</body>

</html>