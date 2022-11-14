<div class="container mb-4">
    <?php if (isset($edit) && isset($galeriaEditar) && is_object($galeriaEditar)) : ?>
        <h2 class="mt-3 mb-3 pt-2 text-center">Editar video</h2>

        <!-- Se crea una variable url para el formulario de editar galeria-->
        <?php $url_action = base_url . "galeria_videos/save&id=" . $galeriaEditar->id; ?>
    <?php else : ?>
        <h2 class="mt-3 mb-3 pt-2 text-center">Agregar videos</h2>

        <!-- Se crea una variable url para el formulario de crear galeria -->
        <?php $url_action = base_url . "galeria_videos/save"; ?>
    <?php endif; ?>

    <hr class="my-4">

    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <div class="row mb-3 d-flex justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required value="<?= isset($galeriaEditar) && is_object($galeriaEditar) ? $galeriaEditar->nombre : ''; ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="video">Seleccionar video:</label>
                    <input type="file" class="form-control" name="video" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="miniatura">Seleccionar imagen previa:</label>
                    <input type="file" class="form-control" name="miniatura" />
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-6 text-center">
                <button name="save" class="btn btn-primary mb-4" data-action='submit'>
                    Guardar
                </button>
            </div>
        </div>

        <?php if (isset($galeriaEditar) && is_object($galeriaEditar) && !empty($galeriaEditar->video)) : ?>

            <!-- video -->
            <div class="container mb-5">
                <section>
                    <div class="lightbox">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4 mb-4">
                                <video class="w-100" controls>
                                    <source src="<?= base_url ?>uploads/galeria_videos/<?= $galeriaEditar->video ?>" />
                                </video>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        <?php endif; ?>
    </form>
</div>