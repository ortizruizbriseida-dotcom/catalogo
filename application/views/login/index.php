
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión | Catalogo</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5 col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">catalogo</h3>
                </div>

                <div class="card-body p-4">

                    <h4 class="text-center mb-4">Iniciar sesión</h4>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <?= html_escape($error) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('login/ingresar') ?>"
                          method="post">

                        <div class="mb-3">
                            <label for="correo" class="form-label">
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                id="correo"
                                name="correo"
                                class="form-control"
                                maxlength="100"
                                autocomplete="email"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Contraseña
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                autocomplete="current-password"
                                required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Iniciar sesión
                        </button>

                    </form>

                    <hr>

                    <p class="text-center mb-2">
                        ¿No tienes una cuenta?
                    </p>

                    <a href="<?= site_url('registro') ?>"
                       class="btn btn-outline-success w-100">
                        Crear una cuenta
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
