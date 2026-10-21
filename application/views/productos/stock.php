
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1>
            Control de Stock
        </h1>

        <p class="text-muted">
            Administración de existencias de productos
        </p>

    </div>

</div>


<?php if ($this->session->flashdata('mensaje')): ?>

    <div class="alert alert-success">

        <?= $this->session->flashdata('mensaje') ?>

    </div>

<?php endif; ?>


<?php if ($this->session->flashdata('error')): ?>

    <div class="alert alert-danger">

        <?= $this->session->flashdata('error') ?>

    </div>

<?php endif; ?>


<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                    <tr>

  

                        <th>Clave</th>

                        <th>Producto</th>

                        <th class="text-center">
                            Stock
                        </th>

                        <th class="text-center">
                            Modificar
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if (empty($productos)): ?>

                    <tr>

                        <td
                            colspan="5"
                            class="text-center">

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


                        <td class="text-center">

                            <span
                                class="badge bg-primary fs-6">

                                <?= $p->stock !== null
                                    ? $p->stock
                                    : 0
                                ?>

                            </span>

                        </td>


                        <td class="text-center">

                            <form
                                action="<?= site_url('stock/actualizar') ?>"
                                method="post"
                                class="d-inline-flex align-items-center gap-2">

                                <input
                                    type="hidden"
                                    name="idprod"
                                    value="<?= $p->idprod ?>">

                                <input
                                    type="number"
                                    name="stock"
                                    class="form-control"
                                    value="<?= $p->stock !== null
                                        ? $p->stock
                                        : 0
                                    ?>"
                                    min="0"
                                    style="width: 100px;"
                                    required>

                                <button
                                    type="submit"
                                    class="btn btn-success">

                                    Actualizar

                                </button>

                            </form>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
