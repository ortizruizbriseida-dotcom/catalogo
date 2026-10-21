<?php

$editar = isset($proveedor);

if ($editar)
{
    $action = site_url(
        'proveedores/actualizar/' . $proveedor->idprov
    );
}
else
{
    $action = site_url(
        'proveedores/guardar'
    );
}

?>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow">

            <div class="card-header">

                <h3>

                    <?= $editar
                        ? 'Modificar proveedor'
                        : 'Agregar proveedor'
                    ?>

                </h3>

            </div>


            <div class="card-body">

                <?= validation_errors(
                    '<div class="alert alert-danger">',
                    '</div>'
                ) ?>


                <form
                    action="<?= $action ?>"
                    method="post">


                    <!-- NOMBRE -->

                    <div class="mb-3">

                        <label class="form-label">
                            Nombre del proveedor
                        </label>

                        <input
                            type="text"
                            name="nombreprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->nombreprov)
                                : set_value('nombreprov')
                            ?>">

                        <?= form_error(
                            'nombreprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- APELLIDO PATERNO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Apellido paterno
                        </label>

                        <input
                            type="text"
                            name="apaternoprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->apaternoprov)
                                : set_value('apaternoprov')
                            ?>">

                        <?= form_error(
                            'apaternoprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- APELLIDO MATERNO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Apellido materno
                        </label>

                        <input
                            type="text"
                            name="amaternoprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->amaternoprov)
                                : set_value('amaternoprov')
                            ?>">

                        <?= form_error(
                            'amaternoprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- TELEFONO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="telprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->telprov)
                                : set_value('telprov')
                            ?>">

                        <?= form_error(
                            'telprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- DOMICILIO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Domicilio
                        </label>

                        <input
                            type="text"
                            name="domprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->domprov)
                                : set_value('domprov')
                            ?>">

                        <?= form_error(
                            'domprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- CORREO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="mailprov"
                            class="form-control"
                            required
                            value="<?= $editar
                                ? html_escape($proveedor->mailprov)
                                : set_value('mailprov')
                            ?>">

                        <?= form_error(
                            'mailprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- ESTADO -->

                    <div class="mb-3">

                        <label class="form-label">
                            Estado
                        </label>

                        <select
                            name="estatusprov"
                            class="form-select"
                            required>

                            <option
                                value="ALTA"
                                <?= $editar && $proveedor->estatusprov == 'ALTA'
                                    ? 'selected'
                                    : ''
                                ?>>

                                ALTA

                            </option>


                            <option
                                value="BAJA"
                                <?= $editar && $proveedor->estatusprov == 'BAJA'
                                    ? 'selected'
                                    : ''
                                ?>>

                                BAJA

                            </option>

                        </select>

                        <?= form_error(
                            'estatusprov',
                            '<div class="text-danger">',
                            '</div>'
                        ) ?>

                    </div>


                    <!-- BOTONES -->

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <?= $editar
                            ? 'Guardar cambios'
                            : 'Registrar proveedor'
                        ?>

                    </button>


                    <a
                        href="<?= site_url('proveedores') ?>"
                        class="btn btn-secondary">

                        Cancelar

                    </a>


                </form>

            </div>

        </div>

    </div>

</div>