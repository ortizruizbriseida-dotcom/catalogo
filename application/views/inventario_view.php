<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Proceso - Inventarios</title>
    <!-- CSS de Bootstrap para que luzca bien -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2 class="mb-3">Inventarios: Registro de Proceso</h2>
    <hr>

    <div class="row">
        <!-- Sección de Entradas -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Registro de Entradas</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Entrada</th>
                                <th>ID Producto</th>
                                <th>Cantidad</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($entradas as $row): ?>
                            <tr>
                                <td><?= $row->id_entrada; ?></td>
                                <td><?= $row->id_producto; ?></td>
                                <td><?= $row->cantidad_ent; ?></td>
                                <td><?= $row->hora_ent; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Salidas (Espacio para implementar) -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger text-white">Registro de Salidas</div>
                <div class="card-body">
                    <p class="text-muted">Aquí se listarán las salidas del sistema físico basándose en el pizarrón.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
