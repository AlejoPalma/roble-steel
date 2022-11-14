<div class="container mb-5">
    <h2 class="mt-3 pt-2 text-center">Gestionar galeria de imagenes</h2>
    <hr class="my-4">

    <div class="d-flex justify-content-center text-center">
        <!-- Mensaje de crear galeria -->
        <?php if (isset($_SESSION['galeria']) && $_SESSION['galeria'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                La imagen se ha ingresado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria']) && $_SESSION['galeria'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                La imagen no se ha ingresado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('galeria'); ?>

        <!-- Mensaje de editar galeria -->
        <?php if (isset($_SESSION['galeria_editar']) && $_SESSION['galeria_editar'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                La imagen se ha editado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria_editar']) && $_SESSION['galeria_editar'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                La imagen no se ha editado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('galeria_editar'); ?>

        <!-- Mensaje de eliminar galeria -->
        <?php if (isset($_SESSION['galeria_servicio']) && $_SESSION['galeria_servicio'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                La imagen se ha eliminado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria_servicio']) && $_SESSION['galeria_servicio'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                La imagen no se ha eliminado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('delete_galeria'); ?>

    </div>

    <div class="mb-4">
        <a class="btn btn-primary" style="background-color: #ac2bac;" href="<?= base_url ?>galeria_imagenes/crear" role="button">
            añadir nuevas imagenes
        </a>
    </div>

    <section>
        <div class="row">
            <?php while ($imagen_galeria = $galeria->fetch_object()) : ?>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <div class="bg-image hover-zoom shadow-4 rounded-5 mb-3">
                        <!-- Validar si existe imagen en la base de datos -->
                        <?php if ($imagen_galeria->imagen != null) : ?>
                            <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>uploads/galeria_imagenes/<?= $imagen_galeria->imagen ?>" data-mdb-img="<?= base_url ?>uploads/galeria_imagenes/<?= $imagen_galeria->imagen ?>" class="w-100" style="height: 250px;" />
                        <?php else : ?>
                            <!-- Si no existe mostrar está imagen -->
                            <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="servicio sin imagen" style="height: 250px;" />
                        <?php endif; ?>
                    </div>
                    <p class="fw-bold mb-2 text-center">
                        <?= $imagen_galeria->nombre ?>
                    </p>
                    <p class="fw-bold mb-1 text-center">
                        <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>galeria_imagenes/editar&id=<?= $imagen_galeria->id ?>" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>galeria_imagenes/eliminar&id=<?= $imagen_galeria->id ?>" role="button">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </p>
                </div>
            <?php endwhile ?>
        </div>
    </section>
</div>