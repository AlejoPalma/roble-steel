<!-- Galeria de imágenes -->
<div class="container mb-5">
    <section>
        <h2 class="text-center mb-4 pt-3">Galeria de imágenes</h2>
        <div class="lightbox">
            <div class="row">
                <?php while ($imagen_galeria = $galeria->fetch_object()) : ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                        <div class="bg-image hover-zoom shadow-4 rounded-5 mb-3">
                            <!-- Validar si existe imagen en la base de datos -->
                            <?php if ($imagen_galeria->imagen != null) : ?>
                                <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>uploads/galeria_imagenes/<?= $imagen_galeria->imagen ?>" data-mdb-img="<?= base_url ?>uploads/galeria_imagenes/<?= $imagen_galeria->imagen ?>" class="w-100 shadow-1-strong rounded" alt="<?= $imagen_galeria->nombre ?>" style="height: 250px;" />
                            <?php else : ?>
                                <!-- Si no existe mostrar está imagen -->
                                <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="<?= $imagen_galeria->nombre ?>" style="height: 250px;" />
                            <?php endif; ?>
                        </div>
                        <p class="fw-bold mb-1 text-center">
                            <?= $imagen_galeria->nombre ?>
                        </p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </section>
</div>