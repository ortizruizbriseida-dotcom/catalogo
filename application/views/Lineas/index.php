<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Marcas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <!-- Tarjeta Principal -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-tags-fill me-2"></i>Catálogo de Marcass</h4>
                        <a href="<?= site_url('productos') ?>" class="btn btn-outline-light btn-sm rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i> Regresar a Productos
                        </a>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
 
                                        <th scope="col" style="width: 45%;">Descripción</th>
                                        <th scope="col" class="text-center" style="width: 20%;">Estatus</th>
                                        <th scope="col" class="text-center" style="width: 20%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($lineas)): ?>
                                        <?php foreach ($lineas as $linea): ?>
                                            <?php 
                                                $esAlta = (strtoupper($linea->estatus_linea) == 'ALTA' || $linea->estatus_linea == 'A' || $linea->estatus_linea == 1);
                                            ?>
                                            <tr>
                                               
                                                <td class="fw-semibold text-dark"><?= $linea->descripcion_linea ?></td>
                                                <td class="text-center">
                                                    <?php if ($esAlta): ?>
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Alta
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                                            <i class="bi bi-x-circle-fill me-1"></i> Baja
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($esAlta): ?>
                                                        <a href="<?= site_url('lineas/cambiar_estatus/' . $linea->idlinea . '/BAJA') ?>" 
                                                           class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm" 
                                                           onclick="return confirm('¿Seguro que deseas dar de baja esta línea?');">
                                                            <i class="bi bi-arrow-down-circle me-1"></i> Dar de Baja
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?= site_url('lineas/cambiar_estatus/' . $linea->idlinea . '/ALTA') ?>" 
                                                           class="btn btn-outline-success btn-sm rounded-pill px-3 shadow-sm">
                                                            <i class="bi bi-arrow-up-circle me-1"></i> Dar de Alta
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                                No hay líneas registradas en la base de datos.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional si usas componentes interactivos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
