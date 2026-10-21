<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="display-3 fw-bold text-dark mb-0">CATÁLOGO</h1>
        <p class="text-muted fs-5">Módulo de Administración de Productos</p>
    </div>

    <a href="<?= site_url('productos/nuevo') ?>" class="btn btn-primary btn-lg shadow-sm">
        + Agregar producto
    </a>
</div>

<?php if ($this->session->flashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('mensaje') ?>
    </div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Clave</th>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Compra</th>
                        <th>Venta</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (empty($productos)): ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            No hay productos registrados.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($productos as $p): ?>
                    <tr>
                        <td>
                            <?= html_escape($p->claveprod) ?>
                        </td>

                        <td>
                            <?= html_escape($p->descripcion) ?>
                        </td>

                        <td>
                            <?= html_escape($p->descripcion_linea) ?>
                        </td>

                        <td>
                            $ <?= number_format($p->preciocompra, 2) ?>
                        </td>

                        <td>
                            $ <?= number_format($p->precioventa, 2) ?>
                        </td>

                        <td>
                            <?= $p->stock ?>
                        </td>

                        <td>
                            <?php if ($p->estatus_prod == 'ALTA'): ?>
                                <span class="badge bg-success">
                                    ALTA
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger">
                                    BAJA
                                </span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($p->estatus_prod == 'ALTA'): ?>
                                <!-- Botón para Dar de Baja (Rojo en línea) -->
                                <a href="<?= site_url('productos/dar_baja/' . $p->idprod) ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1 fw-semibold" style="border-radius: 20px;">
                                    ↓ Dar de Baja
                                </a>
                            <?php else: ?>
                                <!-- Botón para Dar de Alta (Verde en línea) -->
                                <a href="<?= site_url('productos/dar_alta/' . $p->idprod) ?>" class="btn btn-outline-success btn-sm rounded-pill px-3 py-1 fw-semibold" style="border-radius: 20px;">
                                    ↑ Dar de Alta
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
