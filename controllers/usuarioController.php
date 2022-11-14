<?php
require_once 'models/usuario.php';
require_once 'models/recuperar.php';

class usuarioController
{

    public function login()
    {
        require_once 'views/usuario/login.php';
    }

    public function registro()
    {
        Utils::isAdmin();
        require_once 'views/usuario/registro.php';
    }

    public function solicitarPassword()
    {
        require_once 'views/usuario/solicitarPassword.php';
    }

    // Guardar Usuario en la BD
    public function save()
    {
        if (isset($_POST)) {

            $errores = array();

            if (isset($_POST['nombre']) && !empty($_POST['nombre']) && !is_numeric($_POST['nombre']) && !preg_match("/[0-9]/", $_POST['nombre'])) {
                $nombre = $_POST['nombre'];
            } else {
                $errores['nombre'] = "El nombre no es válido: no debe tener números";
            }

            if (isset($_POST['apellidos']) && !empty($_POST['apellidos']) && !is_numeric($_POST['apellidos']) && !preg_match("/[0-9]/", $_POST['apellidos'])) {
                $apellidos = $_POST['apellidos'];
            } else {
                $errores['apellidos'] = "Los apellidos no son válidos: no debe tener números";
            }

            if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                $errores['email'] = "El email no es válido";
            }

            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $password = $_POST['password'];
            } else {
                $errores['password'] = "El password no es válido";
            }

            //Validar si existe el email
            $usuarioEmail = new Usuario();
            $usuarioEmail->setEmail($email);

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $usuarioEmail->setId($id);
                $existe = $usuarioEmail->validarEmailUpdate();
            } else {
                $existe = $usuarioEmail->validarEmail();
            }

            if ($existe == true) {
                $errores['email'] = "El email ya existe";
            }

            if (count($errores) == 0 && $existe == false) {

                // Crear objeto de Usuario
                $usuario = new Usuario();

                // Guardar datos del formulario en los atributos del objeto
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                // Validar si existe GET para editar, sino agregar un nuevo usuario
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario->setId($id);

                    // Comprobar contraseña actual
                    $identity = $usuario->login();

                    // Editar usuario
                    if ($identity && is_object($identity)) {

                        // Validar si existe el parametro password_nueva
                        if (isset($_POST['password_nueva']) && !empty($_POST['password_nueva'])) {
                            $password_nueva = $_POST['password_nueva'];

                            // Insertar la variable en el objeto usuario
                            $usuario->setPassword_nueva($password_nueva);

                            // Cambiar password
                            $savePassword = $usuario->editPassword();
                        }

                        $save  = $usuario->edit();

                        // Validar si se edito el usuario y mostrar mensaje
                        if ($save) {
                            $_SESSION['usuario_editar'] = "complete";
                            header('Location: ' . base_url . 'usuario/editar&id=' . $_GET['id']);
                        } else {
                            $_SESSION['usuario_editar'] = "failed";
                            header('Location: ' . base_url . 'usuario/editar&id=' . $_GET['id']);
                        }
                    } else {
                        $_SESSION['usuario_editar'] = "failed";
                        header('Location: ' . base_url . 'usuario/editar&id=' . $_GET['id']);
                    }
                } else {
                    $save = $usuario->save();

                    // Validar si se guardo un nuevo usuario
                    if ($save) {
                        $_SESSION['register'] = "complete";
                        header('Location: ' . base_url . 'usuario/registro');
                    } else {
                        $_SESSION['register'] = "failed";
                        header('Location: ' . base_url . 'usuario/registro');
                    }
                }
            } else {
                $_SESSION['register'] = "failed";
                $_SESSION['error_register_user'] = $errores;
                if (isset($_GET['id'])) {
                    header('Location: ' . base_url . 'usuario/editar&id=' . $_GET['id']);
                } else {
                    header('Location: ' . base_url . 'usuario/registro');
                }
            }
        } else {
            $_SESSION['register'] = "failed";
            if (isset($_GET['id'])) {
                header('Location: ' . base_url . 'usuario/editar&id=' . $_GET['id']);
            } else {
                $_SESSION['register'] = "failed";
                header('Location: ' . base_url . 'usuario/registro');
            }
        }
    }

    public function editar()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuarioEditar = $usuario->getOne();

            // Incluir la vista de editar usuarios
            require_once 'views/usuario/registro.php';
        } else {
            header('Location: ' . base_url);
        }
    }

    // Iniciar Sesión
    public function iniciar_sesion()
    {
        if (isset($_POST)) {
            // Identificar al usuario
            // Consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();

            // Crear una sesion
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
                header("Location: " . base_url);
            } else {
                $_SESSION['error_login'] = true;
                header("Location: " . base_url . '/usuario/iniciar_sesion');
            }
        }
    }

    // Cerrar Sesión
    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header('Location:' . base_url);
    }

    // Eliminar Usuario
    public function eliminar()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $delete = $usuario->delete();
            if ($delete) {
                $_SESSION['delete_usuario'] = 'complete';
                $this->logout();
            } else {
                $_SESSION['delete_usuario'] = 'failed';
            }
        } else {
            $_SESSION['delete_usuario'] = 'failed';
        }
        header('Location: ' . base_url . 'usuario/editar');
    }

    // Recuperar contraseña
    public function recuperarPassword()
    {
        if (isset($_POST)) {

            $errores = array();

            if (isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST['email'];
            } else {
                $errores['email'] = "El email no es válido";
            }

            // Validar si existe el email
            $usuarioEmail = new Usuario();
            $usuarioEmail->setEmail($email);
            $existe = $usuarioEmail->validarEmail();

            if ($existe == true) {

                // Validar si ya se envió email de recuperación
                $exite_recuperar = new Recuperar();
                $exite_recuperar->setEmail($email);
                $validar = $exite_recuperar->validarEmail();

                if ($validar) {
                    $exite_recuperar->delete();
                }

                // Ingresar datos en la clase recuperar
                date_default_timezone_set('America/Santiago');
                $fecha_alta = date("Y-m-d H:i:s");

                $clave_nueva = rand(10000000, 99999999);
                $token = rand(10000000, 99999999);

                $recuperar = new Recuperar();
                $recuperar->setFecha_alta($fecha_alta);
                $recuperar->setEmail($email);
                $recuperar->setClave_nueva($clave_nueva);
                $recuperar->setToken($token);

                // Datos para enviar el email
                $from = "promarantofagasta@gmail.com";
                $to = "$email";
                $subject = "Recuperar contraseña Pro-Mar";

                $link = base_url . "usuario/confirmar_password&e=$email&t=$token";

                $message = "Estimado(a).\n\nUsted ha solicitado recuperar su contraseña en Pro-Mar.\n\n";
                $message .= "El sistema ha generado una nueva clave que es: $clave_nueva\n";
                $message .= "Pero antes de poder utilizar la clave, deberá hacer click en este vínculo: $link\n\n";
                $message .= "Si no ha hecho esta solicitud, ignore el mensaje.\n\n";
                $message .= "Este mensaje es generado de forma automática, no responda a este email.\n\n";
                $message .= "Contacto:\n";
                $message .= "Email: promarantofagasta@gmail.com\n";
                $message .= "Teléfono: +569-54035995\n";
                $message .= "Sitio web: www.promarantofagasta.com\n\n";
                $message .= "Pro Mar Antofagasta.";

                $headers = "From:" . $from;

                // Enviar Email
                $enviar_mail = mail($to, $subject, $message, $headers);

                if ($enviar_mail) {
                    // Guardar datos de recuperar en la base de datos
                    $save = $recuperar->save();

                    // Validar si se guardo el registro y mostrar mensaje
                    if ($save == true) {
                        $_SESSION['recuperar_password'] = "complete";
                    } else {
                        $_SESSION['recuperar_password'] = "failed";
                    }
                } else {
                    $_SESSION['recuperar_password'] = "failed";
                }
            } else {
                $errores['email'] = "El email no existe";
                $_SESSION['error_restablecer_password'] = $errores;
            }
        } else {
            $_SESSION['recuperar_password'] = "failed";
        }
        header('Location: ' . base_url . 'usuario/solicitarPassword');
    }

    // Confirmar Email de recuperar contraseña
    public function confirmar_password()
    {
        if (isset($_GET)) {
            $email = $_GET['e'];
            $token = $_GET['t'];

            $recuperar = new Recuperar();
            $recuperar->setEmail($email);
            $recuperar->setToken($token);

            $validar = $recuperar->validarRecuperar();

            if ($validar == true) {
                // Obtener clave nueva de la base de datos
                $clave = $recuperar->getOne();

                $password = $clave->clave_nueva;

                // Actualizar contraseña temporal
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $recuperarPassword = $usuario->recuperarPassword();

                // Eliminar registro de recuperar
                $deleteRecuperar = $recuperar->delete();

                if ($recuperarPassword == true and $deleteRecuperar == true) {
                    $_SESSION['confirmar_password'] = 'complete';
                    header('Location: ' . base_url . 'usuario/iniciar_sesion');
                } else {
                    header('Location: ' . base_url . 'usuario/solicitarPassword');
                    $_SESSION['confirmar_password'] = 'failed';
                }
            } else {
                header('Location: ' . base_url . 'usuario/solicitarPassword');
                $_SESSION['confirmar_nueva_password'] = 'failed';
            }
        } else {
            $_SESSION['confirmar_nueva_password'] = 'failed';
            header('Location: ' . base_url . 'usuario/solicitarPassword');
        }
    }
} // Fin de la clase