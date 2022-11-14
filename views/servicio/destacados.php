<!--Section: Design Block-->
<section style="width: 100%;">
    <!-- Intro -->
    <div id="intro" class="text-center bg-image rounded-5" style="height:85vh; background-image: url('https://mdbootstrap.com/img/Others/construction2.jpg');">
        <div class="mask" style="background-color: rgba(63, 81, 181, 0.3);">
            <div class="d-flex justify-content-center align-items-center mt-4" style="height: 75vh;">
                <div class="text-white">
                    <h1 class="display-3 font-weight-bold text-uppercase my-4">Robles Steel SPA</h1>
                    <hr class="mb-4" style="opacity: 1;" />
                    <p class="lead mb-4 pb-2">Ubicados en Antofagasta, Chile.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="pb-4">
    <a name="sobreNosotros"></a>
</div>

<main>
    <!-- Sobre nosotros -->
    <div class="container mt-5">
        <section>
            <div class="row align-items-center">
                <div class="col-sm-9 col-md-6 col-lg-6 mb-4 mb-lg-0">
                    <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/logo.webp" class="w-100 rounded-6" alt="Logo" />
                </div>
                <div class="col-sm-9 col-md-6 col-lg-6">
                    <div class="card cascading-left rounded-6 shadow-2-strong">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Sobre nosotros</h3>
                            <p class="lead mb-5">
                                Prestamos servicio a la pequeña y gran minería en asistencia técnica estructural, reparación y
                                fabricación de componentes de equipos mineros en especial equipos P&H.
                                La asistencia electromecánica se realiza a los equipos Letourneau.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="my-5" />
    </div>

    <!-- Container Servicios -->
    <?php if ($nServicios > 0) : ?>
        <div class="container">
            <section>
                <h2 class="text-center mb-4">Servicios</h2>
                <div class="row">
                    <?php while ($servicio = $servicios->fetch_object()) : ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                            <div class="bg-image hover-zoom shadow-4 rounded-5 mb-3">
                                <!-- Validar si existe imagen en la base de datos -->
                                <?php if ($servicio->imagen != null) : ?>
                                    <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>uploads/images/<?= $servicio->imagen ?>" class="w-100" alt="servicio destacado" style="height: 250px;" />
                                <?php else : ?>
                                    <!-- Si no existe mostrar está imagen -->
                                    <img data-mdb-toggle="animation" data-mdb-animation-start="onScroll" data-mdb-animation-on-scroll="repeat" data-mdb-animation="fade-in" src="<?= base_url ?>img/imagen-no-disponible.webp" class="w-100" alt="servicio sin imagen" style="height: 250px;" />
                                <?php endif; ?>
                                <a href="<?= base_url ?>servicio/ver&id=<?= $servicio->id ?>">
                                    <div class="mask">
                                        <div class="d-flex justify-content-end align-items-start h-100 p-3">
                                            <span class="badge badge-info">Ver descripción</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <p class="mb-1 text-center">
                                <a href="<?= base_url ?>servicio/ver&id=<?= $servicio->id ?>" class="text-reset"><?= $servicio->nombre ?></a>
                            </p>
                        </div>
                    <?php endwhile ?>
                </div>
            </section>
            <hr class="my-5" />
        </div>
    <?php endif ?>

    <?php if ($nImagenes > 0) : ?>
        <!-- Galeria de imágenes -->
        <div class="container">
            <section>
                <h2 class="mb-4">Galeria de imágenes</h2>
                <div class="lightbox">
                    <div class="row">
                        <?php while ($imagen_galeria = $imagenes_galeria->fetch_object()) : ?>
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
                                <p class="mb-1 text-center">
                                    <?= $imagen_galeria->nombre ?>
                                </p>
                            </div>
                        <?php endwhile ?>
                    </div>
                </div>

                <?php if ($nImagenes > 5) : ?>
                    <div class="text-end">
                        <a href="<?= base_url ?>galeria_imagenes/index" class="btn btn-primary btn-rounded">Ver más imágenes</a>
                    </div>
                <?php endif ?>
            </section>
            <hr class="my-5" />
        </div>
    <?php endif ?>

    <?php if ($nVideos > 0) : ?>
        <!-- Galeria de videos -->
        <div class="container">
            <section>
                <h2 class="mb-4">Galeria de videos</h2>
                <div class="row">
                    <?php while ($video_galeria = $videos_galeria->fetch_object()) : ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 mb-4 hover-zoom">
                            <video class="w-100 rounded-5" controls poster="<?= base_url ?>uploads/galeria_videos/<?= $video_galeria->miniatura ?>" style="height: 250px;">
                                <source src="<?= base_url ?>uploads/galeria_videos/<?= $video_galeria->video ?>" />
                            </video>
                            <p class="text-center">
                                <?= $video_galeria->nombre ?>
                            </p>
                        </div>
                    <?php endwhile ?>

                    <?php if ($nVideos > 5) : ?>
                        <div class="text-end">
                            <a href="<?= base_url ?>galeria_videos/index" class="btn btn-primary btn-rounded">Ver más videos</a>
                        </div>
                    <?php endif ?>
            </section>
            <hr class="my-5" />
        </div>
    <?php endif ?>

    <div>
        <a name="contacto"></a>
    </div>

    <!-- Contacto -->
    <div class="container">

        <section class="mb-4">

            <div class="card shadow-5-strong">
                <div class="card-body px-md-5">
                    <div class="row gx-lg-5 align-items-center">
                        <h2 class="text-center mb-4">Contacto</h2>
                        <div class="col-xl-5 mb-4 mb-xl-0">
                            <form id="form-contacto" action="<?= base_url ?>informacion/enviar" method="POST">
                                <!-- Name input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="form4Example1" name="nombre" class="form-control" required />
                                    <label class="form-label" for="form4Example1">Nombre</label>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="form4Example2" class="form-control" required />
                                    <label class="form-label" for="form4Example2">Email</label>
                                </div>

                                <!-- Message input -->
                                <div class="form-outline mb-4">
                                    <textarea class="form-control" name="mensaje" id="form4Example3" rows="4" required></textarea>
                                    <label class="form-label" for="form4Example3">Mensaje</label>
                                </div>

                                <!-- Cargar la APi de JavaScript reCAPTCHA 
                                <script src="https://www.google.com/recaptcha/api.js"></script>-->

                                <!-- Devolución de llamada para manejar el token de reCAPTCHA 
                                <script>
                                    function onSubmit(token) {
                                        document.getElementById("form-contacto").submit();
                                    }
                                </script>-->

                                <!-- Submit button -->
                                <button class="btn btn-primary btn-block mb-4 g-recaptcha" data-sitekey="6Lct9NciAAAAANczmG9k3mhn8eiQw64UweMya3sm" data-callback='onSubmit' data-action='submit'>
                                    Enviar
                                </button>
                            </form>
                        </div>

                        <div class="col-xl-7">
                            <div class="row gx-lg-5">
                                <div class="col-md-6 mb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                                <i class="fas fa-mobile-alt fa-lg text-white fa-fw"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <p class="fw-bold mb-1">Celular</p>
                                            <a class="text-muted mb-0" href="https://wa.me/+56962199284" target="_blank">+569 62 19 92 84</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                                <i class="far fa-envelope fa-lg text-white fa-fw"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <p class="fw-bold mb-1">Email</p>
                                            <p class="text-muted mb-0 text-break">&#76;uisRobles&#64;ro&#98;lesteel&#46;com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                                <i class="far fa-clock fa-lg text-white fa-fw"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <p class="fw-bold mb-1">Horario</p>
                                            <p class="text-muted mb-0">Lunes a viernes: </br> 08:00 a 16:00 hrs.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-5">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <div class="p-3 bg-primary rounded-4 shadow-2-strong">
                                                <i class="fas fa-map-marker-alt fa-lg text-white fa-fw"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-4">
                                            <p class="fw-bold mb-1">Dirección</p>
                                            <p class="text-muted mb-0">Baquedano #239, Antofagasta</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensaje de enviar mensaje -->
            <?php if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] == 'complete') : ?>
                <div class="alert" role="alert" data-mdb-color="success">
                    El mensaje se ha enviado correctamente
                </div>
            <?php elseif (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] == 'failed') : ?>
                <div class="alert" role="alert" data-mdb-color="danger">
                    El mensaje no se ha enviado correctamente
                </div>
            <?php endif; ?>
            <?php Utils::deleteSession('mensaje'); ?>

        </section>
        <!-- Section: Design Block -->

    </div>
</main>