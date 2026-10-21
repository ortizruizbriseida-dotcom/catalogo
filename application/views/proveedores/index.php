<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h1>
            Catálogo de proveedores
        </h1>

        <p class="text-muted">
            Administración de proveedores
        </p>

    </div>


    <a
        href="<?= site_url('proveedores/nuevo') ?>"
        class="btn btn-primary">

        + Agregar proveedor

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



                        <th>Nombre</th>

                        <th>Apellido paterno</th>

                        <th>Apellido materno</th>

                        <th>Teléfono</th>

                        <th>Domicilio</th>

                        <th>Correo</th>

                        <th>Estado</th>

                        <th>Acciones</th>

                    </tr>

                </thead>


                <tbody>

                <?php if (empty($proveedores)): ?>

                    <tr>

                        <td
                            colspan="9"
                            class="text-center">

                            No hay proveedores registrados.

                        </td>

                    </tr>

                <?php else: ?>


                    <?php foreach ($proveedores as $p): ?>

                    <tr>

                        <!-- ID -->



                        <!-- NOMBRE -->

                        <td>
                            <?= html_escape(
                                $p->nombreprov
                            ) ?>
                        </td>


                        <!-- APELLIDO PATERNO -->

                        <td>
                            <?= html_escape(
                                $p->apaternoprov
                            ) ?>
                        </td>


                        <!-- APELLIDO MATERNO -->

                        <td>
                            <?= html_escape(
                                $p->amaternoprov
                            ) ?>
                        </td>


                        <!-- TELEFONO -->

                        <td>
                            <?= html_escape(
                                $p->telprov
                            ) ?>
                        </td>


                        <!-- DOMICILIO -->

                        <td>
                            <?= html_escape(
                                $p->domprov
                            ) ?>
                        </td>


                        <!-- CORREO -->

                        <td>
                            <?= html_escape(
                                $p->mailprov
                            ) ?>
                        </td>


                        <!-- ESTADO -->

                        <td>

                            <?php if ($p->estatusprov == 'ALTA'): ?>

                                <span class="badge bg-success">

                                    ALTA

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    BAJA

                                </span>

                            <?php endif; ?>

                        </td>


                        <!-- ACCIONES -->

                        <td>

                            <a
                                href="<?= site_url(
                                    'proveedores/editar/' . $p->idprov
                                ) ?>"
                                class="btn btn-sm btn-warning">

                                Modificar

                            </a>







                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>
