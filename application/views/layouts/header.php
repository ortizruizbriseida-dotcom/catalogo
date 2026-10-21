<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? $titulo : 'Catalogo' ?></title>

    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos.css') ?>" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu"
                aria-controls="menu"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <!-- Menú de la izquierda -->
            <ul class="navbar-nav me-auto">

                <!-- Menú desplegable Catálogo -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold text-white"
                       href="#"
                       id="navbarDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Catálogo
                    </a>

                    <ul class="dropdown-menu dropdown-menu-dark"
                        aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= site_url('productos') ?>">
                                Productos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('lineas') ?>">
                                Líneas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('stock') ?>">
                                Stock
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('proveedores') ?>">
                                Proveedores
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Menú desplegable Inventario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-bold text-white"
                       href="#"
                       id="inventarioDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Inventario
                    </a>

                    <ul class="dropdown-menu dropdown-menu-dark"
                        aria-labelledby="inventarioDropdown">
                        <li>
                            <a class="dropdown-item" href="<?= site_url('inventario/entradas') ?>">
                                Registro de Entradas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('inventario/salidas') ?>">
                                Registro de Salidas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="<?= site_url('inventario/fisico') ?>">
                                Inventario Físico
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Opción Admin -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        Admin
                    </a>
                </li>

            </ul>

            <!-- Botón Cerrar sesión a la derecha -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?= form_open('login/salir', array(
                        'class' => 'd-inline'
                    )) ?>

                        <button type="submit"
                                class="btn btn-outline-light btn-sm"
                                onclick="return confirm('¿Estás seguro de que deseas cerrar sesión?');">
                            Cerrar sesión
                        </button>

                    <?= form_close() ?>
                </li>
            </ul>

        </div>
    </div>
</nav>

<div class="container py-4">
