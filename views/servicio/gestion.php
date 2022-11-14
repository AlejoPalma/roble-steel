<div class="container">
    <h1 class="mt-3 h1 text-center">Gestión de servicios</h1>
    <hr class="my-4">

    <div class="d-flex justify-content-center text-center">
        <!-- Mensaje de crear servicio -->
        <?php if (isset($_SESSION['servicio']) && $_SESSION['servicio'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El servicio se ha creado correctamente
            </div>
        <?php elseif (isset($_SESSION['servicio']) && $_SESSION['servicio'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El servicio no se ha creado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('servicio'); ?>

        <!-- Mensaje de editar servicio -->
        <?php if (isset($_SESSION['servicio_editar']) && $_SESSION['servicio_editar'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El producto se ha editado correctamente
            </div>
        <?php elseif (isset($_SESSION['servicio_editar']) && $_SESSION['servicio_editar'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El producto no se ha editado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('servicio_editar'); ?>

        <!-- Mensaje de eliminar producto -->
        <?php if (isset($_SESSION['delete_servicio']) && $_SESSION['delete_servicio'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El producto se ha eliminado correctamente
            </div>
        <?php elseif (isset($_SESSION['delete_servicio']) && $_SESSION['delete_servicio'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El servicio no se ha eliminado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('delete_servicio'); ?>

    </div>

    <form action="<?= base_url ?>servicio/buscador" method="POST">
        <div class="d-flex justify-content-center mb-4">
            <div class="form-outline">
                <input data-mdb-search type="text" name="buscar" id="buscar" class="form-control" />
                <label class="form-label" for="buscar">Búsqueda</label>
            </div>
            <button class="btn btn-primary btn-sm ms-3" data-action='submit'>
                Buscar
            </button>
            <a class="btn btn-danger ms-3" href="<?= base_url ?>servicio/gestion" role="button">
                Limpiar
            </a>
        </div>
    </form>

    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-primary ms-3" style="background-color: #ac2bac;" href="<?= base_url ?>servicio/crear" role="button">
            añadir
        </a>
        <a class="btn btn-primary ms-3" href="<?= base_url ?>galeria_servicio/gestion" role="button">
            Gestionar imagenes
        </a>
    </div>

    <div class="datatable mb-4" data-mdb-bordered="true" data-mdb-border-color="info" data-mdb-fixed-header="true" data-mdb-sm="true" data-mdb-striped="true">

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php if (isset($serviciosBuscar)) : ?>
                    <?php while ($servicioBuscar = $serviciosBuscar->fetch_object()) : ?>
                        <tr>
                            <td>
                                <?= $servicioBuscar->nombre; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>servicio/editar&id=<?= $servicioBuscar->id ?>" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>servicio/eliminar&id=<?= $servicioBuscar->id ?>" role="button"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php while ($servicioView = $servicios->fetch_object()) : ?>
                        <tr>
                            <td>
                                <?= $servicioView->nombre; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>servicio/editar&id=<?= $servicioView->id ?>" role="button"><i class="fas fa-edit"></i>
                                </a>

                                <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>servicio/eliminar&id=<?= $servicioView->id ?>" role="button"><i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>