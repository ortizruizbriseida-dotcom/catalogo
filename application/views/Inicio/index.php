<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Sistema de Gestión</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar Superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= site_url('inicio') ?>">
                <i class="bi bi-box-seam me-2"></i>Catálogo
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                            Catálogo
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= site_url('productos') ?>"><i class="bi bi-box me-2"></i>Productos</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('lineas') ?>"><i class="bi bi-tags me-2"></i>Líneas</a></li>
                            <li><a class="dropdown-item" href="<?= site_url('proveedores') ?>"><i class="bi bi-truck me-2"></i>Proveedores</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white-50" href="<?= site_url('admin') ?>">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal / Banner de Bienvenida -->
    <main class="container my-auto py-5">
        <div class="p-5 mb-4 bg-white rounded-4 shadow-sm text-center border">
            <div class="container-fluid py-4">
                <i class="bi bi-boxes display-1 text-primary mb-3 d-block"></i>
                <h1 class="display-3 fw-bold text-dark">CATÁLOGO</h1>
                <p class="col-md-8 fs-4 mx-auto text-secondary mt-3">
                    Sistema de Administración e Inventario
                </p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="<?= site_url('productos') ?>" class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                        <i class="bi bi-box me-2"></i>Ver Productos
                    </a>
                    <a href="<?= site_url('lineas') ?>" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                        <i class="bi bi-tags me-2"></i>Ver Líneas
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Pie de página opcional -->
    <footer class="footer mt-auto py-3 bg-dark text-white-50 text-center">
        <div class="container">
            <small>&copy; <?= date('Y') ?> Sistema de Catálogo. Todos los derechos reservados.</small>
        </div>
    </footer>

    <!-- Bootstrap JS (necesario para el menú desplegable del Navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
