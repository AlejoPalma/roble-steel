<h1 class="my-4 h1 text-center">Recuperar contraseña</h1>

<!-- Mensaje de registro complete - failed -->
<?php if (isset($_SESSION['recuperar_password']) && $_SESSION['recuperar_password'] == 'complete') : ?>
    <div class="alert" role="alert" data-mdb-color="primary">
        Se envió un email para recuperar su clave.
    </div>
<?php elseif (isset($_SESSION['recuperar_password']) && $_SESSION['recuperar_password'] == 'failed') : ?>
    <div class="alert" role="alert" data-mdb-color="danger">
        Error en recuperar la clave.
    </div>
<?php endif; ?>

<!-- Eliminar Session register -->
<?php Utils::deleteSession('recuperar_password'); ?>

<!-- Mensaje de confirmar_password complete - failed -->
<?php if (isset($_SESSION['confirmar_password']) && $_SESSION['confirmar_password'] == 'failed') : ?>
    <div class="alert" role="alert" data-mdb-color="danger">
        Error en recuperar la clave.
    </div>
<?php endif; ?>

<!-- Eliminar Session confirmar_password -->
<?php Utils::deleteSession('confirmar_password'); ?>

<?php echo isset($_SESSION['error_restablecer_password']) ? Utils::mostrarError($_SESSION['error_restablecer_password'], 'existe_solicitud') : ''; ?>

<form action="<?= base_url ?>usuario/recuperarPassword" method="POST">

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <!-- Email input -->
            <div class="form-outline">
                <input type="email" id="email" name="email" class="form-control" required />
                <label class="form-label" for="email">Email</label>
            </div>

            <!-- Mostrar Error -->
            <?php echo isset($_SESSION['error_restablecer_password']) ? Utils::mostrarError($_SESSION['error_restablecer_password'], 'email') : ''; ?>
        </div>
    </div>

    <div class="row mb-4 d-flex justify-content-center">

        <div class="col-sm-12 col-md-6 text-center">
            <!-- Cargar la APi de JavaScript reCAPTCHA -->
            <script src="https://www.google.com/recaptcha/api.js"></script>

            <!-- Devolución de llamada para manejar el token de reCAPTCHA -->
            <script>
                function onSubmit(token) {
                    document.getElementById("form-registro").submit();
                }
            </script>

            <!-- Submit button con reCAPTCHA-->
            <button class="btn btn-primary mb-4 g-recaptcha" data-sitekey="6LdTiBQdAAAAAK1eYWxRywUNqBUH2FheS38biAUv" data-callback='onSubmit' data-action='submit'>
                Recuperar contraseña
            </button>
        </div>
    </div>
</form>

<!-- Eliminar Session error_register_user -->
<?php Utils::deleteSession('error_restablecer_password'); ?>