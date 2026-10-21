
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro | SCN Inventario</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">Crear cuenta</h3>
                </div>

                <div class="card-body p-4">

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= html_escape(
                                $this->session->flashdata('error')
                            ) ?>
                        </div>
                    <?php endif; ?>

                    <?= validation_errors(
                        '<div class="alert alert-danger">',
                        '</div>'
                    ) ?>

                    <form action="<?= site_url('registro/guardar') ?>"
                          method="post">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                id="nombre"
                                name="nombre"
                                class="form-control"
                                maxlength="100"
                                value="<?= set_value('nombre') ?>"
                                required>
                        </div>

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
                                value="<?= set_value('correo') ?>"
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
                                minlength="8"
                                maxlength="72"
                                autocomplete="new-password"
                                required>

                            <small class="text-muted">
                                Usa al menos 8 caracteres.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="confirmar" class="form-label">
                                Confirmar contraseña
                            </label>

                            <input
                                type="password"
                                id="confirmar"
                                name="confirmar"
                                class="form-control"
                                minlength="8"
                                maxlength="72"
                                autocomplete="new-password"
                                required>
                        </div>

                        <button type="submit"
                                class="btn btn-success w-100">
                            Registrarme
                        </button>

                    </form>

                    <hr>

                    <p class="text-center mb-0">
                        ¿Ya tienes cuenta?
                        <a href="<?= site_url('login') ?>">
                            Inicia sesión
                        </a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
