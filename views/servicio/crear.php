<div class="container mb-4">
    <?php if (isset($edit) && isset($servicioEditar) && is_object($servicioEditar)) : ?>
        <h3 class="mt-3 mb-3 pt-2 h3 text-center">Editar servicio</h3>

        <!-- Se crea una variable url para el formulario de editar servicio-->
        <?php $url_action = base_url . "servicio/save&id=" . $servicioEditar->id; ?>
    <?php else : ?>
        <h3 class="mt-3 mb-3 pt-2 h3 text-center">Crear un nuevo servicio</h3>

        <!-- Se crea una variable url para el formulario de crear servicio -->
        <?php $url_action = base_url . "servicio/save"; ?>
    <?php endif; ?>

    <hr class="my-4">

    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <div class="row mb-3 d-flex justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="form-outline mb-3">
                    <input type="text" name="nombre" class="form-control" required value="<?= isset($servicioEditar) && is_object($servicioEditar) ? $servicioEditar->nombre : ''; ?>" />
                    <label class="form-label" for="nombre">Nombre</label>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= isset($servicioEditar) && is_object($servicioEditar) ? $servicioEditar->descripcion : ''; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="imagen">Seleccionar imagen principal:</label>
                    <input type="file" class="form-control" name="imagen" />
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 col-md-6 text-center">
                <button class="btn btn-primary mb-4" data-action='submit'>
                    Guardar
                </button>
            </div>
        </div>
    </form>

    <?php if (isset($servicioEditar) && is_object($servicioEditar) && !empty($servicioEditar->imagen)) : ?>

        <!-- imagen -->
        <div class="container mb-5">
            <section>
                <div class="lightbox">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mb-4">
                            <img src="<?= base_url ?>uploads/images/<?= $servicioEditar->imagen ?>" data-mdb-img="<?= base_url ?>uploads/images/<?= $servicioEditar->imagen ?>" alt="<?= $servicioEditar->nombre ?>" class="w-100 shadow-4 rounded-5" style="max-height:400px; min-height:85px" />
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <?php endif; ?>
</div>