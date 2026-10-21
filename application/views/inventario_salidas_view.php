<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-danger text-white">Nueva Salida</div>
            <div class="card-body">
                <?= form_open('inventario/guardar_salida'); ?>
                    <div class="mb-3">
                        <label class="form-label">ID Producto</label>
                        <input type="number" name="id_producto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad Saliente</label>
                        <input type="number" name="cantidad_sal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Concepto</label>
                        <input type="text" name="id_concepto" class="form-control" placeholder="Ej. Venta en mostrador" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Guardar Salida</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">Listado de Salidas</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Concepto</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($salidas as $row): ?>
                        <tr>
                            <td><?= $row->id_salida; ?></td>
                            <td><?= $row->id_producto; ?></td>
                            <td><?= $row->cantidad_sal; ?></td>
                            <td><?= $row->id_concepto; ?></td>
                            <td><?= $row->hora_sal; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
