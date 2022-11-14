<?php if (isset($edit) && isset($usuarioEditar) && is_object($usuarioEditar)) : ?>
    <h1 class="my-4 h1 text-center">Editar usuario <?= $usuarioEditar->nombre ?></h1>
    <?php
    // Se crea una variable url para el formulario de editar producto
    $url_action = base_url . "usuario/save&id=" . $usuarioEditar->id;
    ?>
<?php else : ?>
    <h1 class="my-4 h1 text-center">Registrar usuario</h1>

    <!-- Se crea una variable url para el formulario de crear producto -->
    <?php $url_action = base_url . "usuario/save"; ?>
<?php endif; ?>

<div class="d-flex justify-content-center text-center">
    <!-- Mensaje de registro complete - failed -->
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
        <div class="alert" role="alert" data-mdb-color="primary">
            <i class="fas fa-check-circle me-3"></i> Registro completado correctamente.
        </div>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
        <div class="alert" role="alert" data-mdb-color="danger">
            <i class="fas fa-times-circle me-3"></i> Registro fallido.
        </div>
    <?php endif; ?>

    <!-- Eliminar Session register -->
    <?php Utils::deleteSession('register'); ?>

    <!-- Mensaje de editar complete - failed -->
    <?php if (isset($_SESSION['usuario_editar']) && $_SESSION['usuario_editar'] == 'complete') : ?>
        <div class="alert" role="alert" data-mdb-color="primary">
            <i class="fas fa-check-circle me-3"></i> Perfil actualizado correctamente.
        </div>
    <?php elseif (isset($_SESSION['usuario_editar']) && $_SESSION['usuario_editar'] == 'failed') : ?>
        <div class="alert" role="alert" data-mdb-color="danger">
            <i class="fas fa-times-circle me-3"></i> Error al actualizar el perfil.
        </div>
    <?php endif; ?>

    <!-- Eliminar Session usuario_editar -->
    <?php Utils::deleteSession('usuario_editar'); ?>

    <!-- Mensaje de eliminar complete - failed -->
    <?php if (isset($_SESSION['delete_usuario']) && $_SESSION['delete_usuario'] == 'complete') : ?>
        <div class="alert" role="alert" data-mdb-color="primary">
            <i class="fas fa-check-circle me-3"></i> Usuario eliminado correctamente.
        </div>
    <?php elseif (isset($_SESSION['delete_usuario']) && $_SESSION['delete_usuario'] == 'failed') : ?>
        <div class="alert" role="alert" data-mdb-color="danger">
            <i class="fas fa-times-circle me-3"></i> Error al eliminar el usuario.
        </div>
    <?php endif; ?>

    <!-- Eliminar Session delete_usuario -->
    <?php Utils::deleteSession('delete_usuario'); ?>
</div>

<form id="form-registro" action="<?= $url_action ?>" method="POST">
    <!-- 2 column grid layout with text inputs for the first and last names -->

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-6">
            <!-- Nombres input -->
            <div class="form-outline mb-3">
                <input type="text" name="nombre" class="form-control" required />
                <label class="form-label" for="nombre">Nombre</label>
            </div>

            <!-- Mostrar Error -->
            <?php echo isset($_SESSION['error_register_user']) ? Utils::mostrarError($_SESSION['error_register_user'], 'nombre') : ''; ?>

            <!-- Apellidos input -->
            <div class="form-outline mb-3">
                <input type="text" name="apellidos" class="form-control" required />
                <label class="form-label" for="apellidos">Apellidos</label>
            </div>

            <!-- Mostrar Error -->
            <?php echo isset($_SESSION['error_register_user']) ? Utils::mostrarError($_SESSION['error_register_user'], 'apellidos') : ''; ?>

            <!-- Email input -->
            <div class="form-outline">
                <input type="email" id="email" name="email" class="form-control" value="<?= isset($usuarioEditar) && is_object($usuarioEditar) ? $usuarioEditar->email : ''; ?>" required />
                <label class="form-label" for="email">Email</label>
            </div>

            <!-- Mostrar Error -->
            <?php echo isset($_SESSION['error_register_user']) ? Utils::mostrarError($_SESSION['error_register_user'], 'email') : ''; ?>
        </div>
    </div>

    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-sm-12 col-md-5">
            <!-- Password input -->
            <div class="form-outline">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Contraseña</label></br>
            </div>

            <!-- Mostrar Error -->
            <?php echo isset($_SESSION['error_register_user']) ? Utils::mostrarError($_SESSION['error_register_user'], 'password_nueva') : ''; ?>
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

    <!-- Ingresar contraseña nueva si va a editar-->
    <?php if (isset($edit) && isset($usuarioEditar) && is_object($usuarioEditar)) : ?>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-12 col-md-5">
                <!-- Password input -->
                <div class="form-outline">
                    <input type="password" id="password_nueva" name="password_nueva" class="form-control" />
                    <label class="form-label" for="password_nueva">Contraseña Nueva</label></br>
                </div>

                <!-- Mostrar Error -->
                <?php echo isset($_SESSION['error_register_user']) ? Utils::mostrarError($_SESSION['error_register_user'], 'password') : ''; ?>
            </div>
            <div class="col-sm-12 col-md-1">
                <!-- Mostrar contraseña -->
                <script>
                    function verContrasena_nueva() {
                        var tipo = document.getElementById("password_nueva");
                        if (tipo.type == "password") {
                            tipo.type = "text";
                        } else {
                            tipo.type = "password";
                        }
                    }
                </script>
                <button class="btn btn-floating btn-primary" type="button" onclick="verContrasena_nueva()">
                    <i class="fas fa-eye fa-lg"></i>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mb-4 d-flex justify-content-center">

        <div class="col-sm-12 col-md-6 text-center">
            <!-- Cargar la APi de JavaScript reCAPTCHA 
            <script src="https://www.google.com/recaptcha/api.js"></script>-->

            <!-- Devolución de llamada para manejar el token de reCAPTCHA 
            <script>
                function onSubmit(token) {
                    document.getElementById("form-registro").submit();
                }
            </script>-->

            <!-- Submit button con reCAPTCHA-->
            <button class="btn btn-primary mb-4 g-recaptcha" data-sitekey="6LdTiBQdAAAAAK1eYWxRywUNqBUH2FheS38biAUv" data-callback='onSubmit' data-action='submit'>
                Enviar
            </button>
            </br>
        </div>
    </div>
</form>

<?php if (!isset($_SESSION['admin']) && isset($edit) && isset($usuarioEditar) && is_object($usuarioEditar)) : ?>
    <div class="alert mb-3" role="alert" data-mdb-color="danger">
        <a href="<?= base_url ?>usuario/eliminar&id=<?= $usuarioEditar->id ?>" class="button">Eliminar Cuenta</a>
        <p>Se elimina la cuenta y todos los pedidos de esta.</p>
    </div>
<?php endif; ?>

<!-- Eliminar Session error_register_user -->
<?php Utils::deleteSession('error_register_user'); ?>