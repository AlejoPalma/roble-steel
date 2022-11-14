<div class="container mb-5">
    <h2 class="mt-3 pt-2 text-center">Gestionar galeria de videos</h2>
    <hr class="my-4">

    <div class="d-flex justify-content-center text-center">
        <!-- Mensaje de crear galeria -->
        <?php if (isset($_SESSION['galeria']) && $_SESSION['galeria'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El video se ha ingresado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria']) && $_SESSION['galeria'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El video no se ha ingresado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('galeria'); ?>

        <!-- Mensaje de editar galeria -->
        <?php if (isset($_SESSION['galeria_editar']) && $_SESSION['galeria_editar'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El video se ha editado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria_editar']) && $_SESSION['galeria_editar'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El video no se ha editado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('galeria_editar'); ?>

        <!-- Mensaje de eliminar galeria -->
        <?php if (isset($_SESSION['galeria_servicio']) && $_SESSION['galeria_servicio'] == 'complete') : ?>
            <div class="alert" role="alert" data-mdb-color="success">
                El video se ha eliminado correctamente
            </div>
        <?php elseif (isset($_SESSION['galeria_servicio']) && $_SESSION['galeria_servicio'] == 'failed') : ?>
            <div class="alert" role="alert" data-mdb-color="danger">
                El video no se ha eliminado correctamente
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('delete_galeria'); ?>

    </div>

    <div class="mb-4">
        <a class="btn btn-primary" style="background-color: #ac2bac;" href="<?= base_url ?>galeria_videos/crear" role="button">
            añadir nuevos videos
        </a>
    </div>

    <section>
        <div class="row">
            <?php while ($video_galeria = $galeria->fetch_object()) : ?>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <div class="bg-image shadow-4 rounded-5 mb-3">
                        <!-- Validar si existe video en la base de datos -->
                        <?php if ($video_galeria->video != null) : ?>
                            <video class="w-100 rounded-5" controls poster="<?= base_url ?>uploads/galeria_videos/<?= $video_galeria->miniatura ?>" style="height: 250px;">
                                <source src="<?= base_url ?>uploads/galeria_videos/<?= $video_galeria->video ?>" />
                            </video>
                        <?php else : ?>
                            <!-- Si no existe mostrar está video -->
                            <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="servicio sin imagen" style="height: 250px;" />
                        <?php endif; ?>
                    </div>
                    <p class="fw-bold mb-2 text-center">
                        <?= $video_galeria->nombre ?>
                    </p>
                    <p class="fw-bold mb-1 text-center">
                        <a class="btn btn-primary btn-floating me-1" href="<?= base_url ?>galeria_videos/editar&id=<?= $video_galeria->id ?>" role="button">
                            <i class="fas fa-edit"></i>
                        </a>

                        <a class="btn btn-primary btn-floating" style="background-color: #dd4b39;" href="<?= base_url ?>galeria_videos/eliminar&id=<?= $video_galeria->id ?>" role="button">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </p>
                </div>
            <?php endwhile ?>
        </div>
    </section>
</div>