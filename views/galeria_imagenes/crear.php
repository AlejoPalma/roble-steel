<div class="container mb-4">
    <?php if (isset($edit) && isset($galeriaEditar) && is_object($galeriaEditar)) : ?>
        <h2 class="mt-3 mb-3 pt-2 text-center">Editar imagen</h2>

        <!-- Se crea una variable url para el formulario de editar galeria-->
        <?php $url_action = base_url . "galeria_imagenes/save&id=" . $galeriaEditar->id; ?>
    <?php else : ?>
        <h2 class="mt-3 mb-3 pt-2 text-center">Agregar imagen</h2>

        <!-- Se crea una variable url para el formulario de crear galeria -->
        <?php $url_action = base_url . "galeria_imagenes/save"; ?>
    <?php endif; ?>

    <hr class="my-4">

    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <div class="row mb-3 d-flex justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required value="<?= isset($galeriaEditar) && is_object($galeriaEditar) ? $galeriaEditar->nombre : ''; ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="imagen">Seleccionar imagen:</label>
                    <input type="file" class="form-control" name="imagen" />
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
    </form>

    <?php if (isset($galeriaEditar) && is_object($galeriaEditar) && !empty($galeriaEditar->imagen)) : ?>

        <!-- imagen -->
        <div class="container mb-5">
            <section>
                <div class="lightbox">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mb-4">
                            <img src="<?= base_url ?>uploads/galeria_imagenes/<?= $galeriaEditar->imagen ?>" data-mdb-img="<?= base_url ?>uploads/galeria_imagenes/<?= $galeriaEditar->imagen ?>" alt="<?= $galeriaEditar->nombre ?>" class="w-100 shadow-4 rounded-5" style="max-height:400px; min-height:85px" />
                        </div>
                    </div>
                </div>
            </section>
        </div>

    <?php endif; ?>
</div>