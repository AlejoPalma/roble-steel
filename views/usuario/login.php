<h1 class="my-4 pt-2 h1 text-center">Iniciar sesión</h1>

<?php if (isset($_SESSION['validar_sesion']) && $_SESSION['validar_sesion'] == 'failed') : ?>
    <script language="JavaScript">
        alert("Debe ingresar sesión para realizar el pedido.");
    </script>
<?php endif; ?>
<?php Utils::deleteSession('validar_sesion'); ?>

<div class="d-flex justify-content-center text-center">
    <!-- Mensaje de error en login -->
    <?php if (isset($_SESSION['error_login'])) : ?>
        <div class="alert" role="alert" data-mdb-color="danger">
            El usuario no existe.
        </div>
    <?php endif; ?>

    <!-- Eliminar Session register -->
    <?php Utils::deleteSession('error_login'); ?>

    <!-- Mensaje de confirmar_password complete - failed -->
    <?php if (isset($_SESSION['confirmar_password']) && $_SESSION['confirmar_password'] == 'complete') : ?>
        <div class="alert" role="alert" data-mdb-color="primary">
            Ingrese con su clave nueva temporal.
        </div>
    <?php endif; ?>

    <!-- Eliminar Session confirmar_password -->
    <?php Utils::deleteSession('confirmar_password'); ?>

</div>

<!-- Mostrar formulario de login, si no está iniciada la sesión -->
<form id="form-login" action="<?= base_url ?>usuario/iniciar_sesion" method="POST">
    <!-- 2 column grid layout with text inputs for the first and last names -->

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <!-- Email input -->
            <div class="form-outline">
                <input type="email" id="email" name="email" class="form-control" value="<?= isset($usuarioEditar) && is_object($usuarioEditar) ? $usuarioEditar->email : ''; ?>" required />
                <label class="form-label" for="email">Email</label>
            </div>
        </div>
    </div>

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-5">
            <!-- Password input -->
            <div class="form-outline">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Contraseña</label></br>
            </div>
        </div>
        <div class="col-sm-12 col-md-1">
            <!-- Mostrar contraseña -->
            <script>
                function verContrasena() {
                    var tipo = document.getElementById("password");
                    if (tipo.type == "password") {
                        tipo.type = "text";
                    } else {
                        tipo.type = "password";
                    }
                }
            </script>
            <button class="btn btn-floating btn-primary" type="button" onclick="verContrasena()">
                <i class="fas fa-eye fa-lg"></i>
            </button>
        </div>
    </div>

    <div class="row mb-4 d-flex justify-content-center">

        <div class="col-sm-12 col-md-6 text-center">
            <!-- Cargar la APi de JavaScript reCAPTCHA 
            <script src="https://www.google.com/recaptcha/api.js"></script>-->

            <!-- Devolución de llamada para manejar el token de reCAPTCHA 
            <script>
                function onSubmit(token) {
                    document.getElementById("form-login").submit();
                }
            </script>-->

            <!-- Submit button con reCAPTCHA-->
            <button class="btn btn-primary mb-4 g-recaptcha" data-sitekey="6LdTiBQdAAAAAK1eYWxRywUNqBUH2FheS38biAUv" data-callback='onSubmit' data-action='submit'>
                Entrar
            </button>
            </br>
            <a href="<?= base_url ?>usuario/solicitarPassword">
                ¿Has olvidado la contraseña?
            </a>
        </div>
    </div>
</form>

<div class="d-flex justify-content-center text-center">
    <div class="alert" role="alert" data-mdb-color="success">
        <a href="<?= base_url ?>usuario/registro" class="alert-link">Registrate aquí</a>
    </div>
</div>