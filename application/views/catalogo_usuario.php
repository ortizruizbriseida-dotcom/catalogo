
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?= html_escape($titulo) ?> | SCN Inventario
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand"
           href="<?= site_url('catalogo') ?>">
            Catalogo
        </a>

        <div class="d-flex align-items-center gap-3">

            <span class="text-white">
                Hola, <?= html_escape(
                    $this->session->userdata('nombre')
                ) ?>
            </span>

            <!-- Cerrar sesión -->
            <?= form_open('login/salir', array(
                'class' => 'd-inline'
            )) ?>

                <button type="submit"
                        class="btn btn-outline-light btn-sm"
                        onclick="return confirm('¿Deseas cerrar sesión?');">
                    Cerrar sesión
                </button>

            <?= form_close() ?>

        </div>
    </div>
</nav>

<div class="container py-4">

    <h1 class="mb-2">Catálogo de productos</h1>

    <p class="text-muted mb-4">
        Consulta los productos disponibles.
    </p>

    <div class="row g-4">

        <?php if (empty($productos)): ?>

            <div class="col-12">
                <div class="alert alert-info">
                    No hay productos registrados.
                </div>
            </div>

        <?php else: ?>

            <?php foreach ($productos as $p): ?>

                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <div class="card h-100 shadow-sm">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= html_escape($p->descripcion) ?>
                            </h5>

                            <p class="text-muted mb-2">
                                Clave:
                                <?= html_escape($p->claveprod) ?>
                            </p>

                            <p class="fs-5 fw-bold text-success mb-0">
                                $<?= number_format(
                                    (float) $p->precioventa,
                                    2
                                ) ?>
                            </p>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

</div>

</body>
</html>
