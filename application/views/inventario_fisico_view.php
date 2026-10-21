<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    Listado de Inventario Físico
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-start ps-4">ID Producto</th>
                                    <th class="text-start">Descripción / Producto</th>
                                    <th>Total Entradas</th>
                                    <th>Total Salidas</th>
                                    <th class="pe-4">Stock Disponible</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($fisico)): ?>
                                    <?php foreach ($fisico as $item): ?>
                                        <?php 
                                            // Calculamos el stock disponible a partir de lo que devuelve tu SQL
                                            $stock = $item->total_entradas - $item->total_salidas; 
                                        ?>
                                        <tr>
                                            <td class="text-start ps-4 fw-semibold"><?= $item->id_producto; ?></td>
                                            <!-- Usamos exactamente nombre_producto como viene definido en tu modelo -->
                                            <td class="text-start fw-medium"><?= $item->nombre_producto; ?></td>
                                            <td class="fw-bold text-success"><?= $item->total_entradas; ?></td>
                                            <td class="fw-bold text-danger"><?= $item->total_salidas; ?></td>
                                            <td class="pe-4 fw-bold text-primary">
                                                <?= $stock; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No hay datos de inventario disponibles.
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
