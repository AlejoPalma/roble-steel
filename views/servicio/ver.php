<!-- Validar si existe el servicio -->
<?php if (isset($servicio)) : ?>

  <div class="container mb-5 py-3 px-5 shadow-5">
    <section>
      <h3 class="text-center mb-5"><?= $servicio->nombre ?></h3>

      <div class="row">
        <div class="col-lg-6" data-mdb-perfect-scrollbar="true" style="height:300px; position: relative">
          <p id="preline"><?= $servicio->descripcion ?></p>
        </div>
        <div class="col-lg-6 mb-4 mb-lg-0 pb-2 pb-lg-0 pb-xl-2">
          <!-- Validar si existe imagen en la base de datos -->
          <?php if ($servicio->imagen != null) : ?>
            <img src="<?= base_url ?>uploads/images/<?= $servicio->imagen ?>" alt="servicio" class="img-fluid shadow-2-strong rounded" />
          <?php else : ?>
            <!-- Si no existe mostrar está imagen -->
            <img src="<?= base_url ?>img/imagen-no-disponible.webp" alt="Imagen no disponible" class="img-fluid shadow-2-strong rounded" />
          <?php endif; ?>
        </div>
      </div>
    </section>
  </div>

  <?php if ($nImagenes > 0) : ?>
    <!-- Galeria de imágenes -->
    <div class="container">
      <section>
        <div class="lightbox">
          <div class="row">
            <?php while ($imagen_galeria = $imagenes_galeria->fetch_object()) : ?>
              <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                <div class="bg-image hover-zoom shadow-4 rounded-5 mb-3">
                  <!-- Validar si existe imagen en la base de datos -->
                  <?php if ($imagen_galeria->imagen != null) : ?>
                    <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>uploads/galeria_servicio/<?= $imagen_galeria->imagen ?>" data-mdb-img="<?= base_url ?>uploads/galeria_servicio/<?= $imagen_galeria->imagen ?>" class="w-100 shadow-1-strong rounded" alt="<?= $imagen_galeria->nombre ?>" style="height: 250px;" />
                  <?php else : ?>
                    <!-- Si no existe mostrar está imagen -->
                    <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="<?= $imagen_galeria->nombre ?>" style="height: 250px;" />
                  <?php endif; ?>
                </div>
                <p class="mb-1 text-center">
                  <?= $imagen_galeria->nombre ?>
                </p>
              </div>
            <?php endwhile ?>
          </div>
        </div>
      </section>
    </div>
  <?php endif ?>

<?php else : ?>

  <div class="container">
    <div class="alert" style="height: 31vh;" role="alert" data-mdb-color="primary">
      EL producto no existe
    </div>
  </div>
<?php endif; ?>