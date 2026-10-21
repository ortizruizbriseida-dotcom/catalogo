<div class="row">
    <!-- Formulario para Registrar Entrada Manual -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">Nueva Entrada</div>
            <div class="card-body">
                <?= form_open('inventario/guardar_entrada'); ?>
                    <div class="mb-3">
                        <label class="form-label">ID Producto</label>
                        <input type="number" name="id_producto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cantidad Entrante</label>
                        <input type="number" name="cantidad_ent" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Concepto</label>
                        <input type="text" name="id_concepto" class="form-control" placeholder="Ej. Compra de proveedor" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Guardar Entrada</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Tabla de Entradas -->
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">Listado de Entradas</div>
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
                        <?php foreach($entradas as $row): ?>
                        <tr>
                            <td><?= $row->id_entrada; ?></td>
                            <td><?= $row->id_producto; ?></td>
                            <td><?= $row->cantidad_ent; ?></td>
                            <td><?= $row->id_concepto; ?></td>
                            <td><?= $row->hora_ent; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
