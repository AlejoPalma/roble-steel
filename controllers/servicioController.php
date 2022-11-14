<?php
require_once 'models/servicio.php';
require_once 'models/galeria_servicio.php';
require_once 'models/galeria_imagenes.php';
require_once 'models/galeria_videos.php';

class servicioController
{
    public function index()
    {
        $servicio = new Servicio();
        $servicios = $servicio->getAll();
        $nServicios = $servicios->num_rows;

        $galeria_imagenes = new Galeria_imagenes();
        $imagenes_galeria = $galeria_imagenes->getDestacados();
        $nImagenes = $imagenes_galeria->num_rows;

        $galeria_videos = new Galeria_videos();
        $videos_galeria = $galeria_videos->getDestacados();
        $nVideos = $videos_galeria->num_rows;

        // redireccionar vista
        require_once 'views/servicio/destacados.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $servicio = new Servicio();
            $servicio->setId($id);
            $servicio = $servicio->getOne();

            $galeria_servicio = new Galeria_servicio();
            $galeria_servicio->setId_servicio($id);

            $imagenes_galeria = $galeria_servicio->getAll_imagenes_servicio();
            $nImagenes = $imagenes_galeria->num_rows;
        }
        // Incluir la vista de ver servicio
        require_once 'views/servicio/ver.php';
    }

    public function gestion()
    {
        Utils::isAdmin();

        // Obtener todos los servicio
        $servicio = new Servicio();
        $servicios = $servicio->getAll();

        // Redirigir 
        require_once 'views/servicio/gestion.php';
    }

    public function buscador()
    {
        if (isset($_POST['buscar'])) {
            $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : false;

            if ($buscar) {
                $servicio = new Servicio();
                $servicio->setNombre($buscar);

                $serviciosBuscar = $servicio->buscador();
            }
        }
        // Redirigir 
        require_once 'views/servicio/gestion.php';
    }

    public function crear()
    {
        // Comprobar que el usuario es administrador
        Utils::isAdmin();

        // redireccionar vista
        require_once 'views/servicio/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;

            if ($nombre && $descripcion) {
                $servicio = new Servicio();
                $servicio->setNombre($nombre);
                $servicio->setDescripcion($descripcion);

                // Validar si existe la carpeta donde se guardarán las imagenes
                if (!is_dir('uploads/images')) {
                    // Si no existe, crear carpeta
                    mkdir('uploads/images', 0777, true);
                }

                $dir = 'uploads/images/';
                $file = $_FILES['imagen'];
                $mimetype = $file['type'];

                $hoy = date("Y-m-d_H-i-s");
                $random = rand(0, 99);
                $newName = $hoy . "-" . $random . ".webp";

                // Validar si existe GET para editar o agregar un nuevo elemento
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $servicio->setId($id);

                    if ($mimetype == "image/webp") {
                        $servicio->deleteImagen();

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $newName);

                        $servicio->setImagen($newName);
                    } elseif ($mimetype == "image/png") {
                        $name = $hoy . "-" . $random . ".png";

                        $servicio->deleteImagen();

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefrompng($dir . $name);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.png
                        unlink($dir . $name);

                        $servicio->setImagen($newName);
                    } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                        $name = $hoy . "-" . $random . ".jpeg";

                        $servicio->deleteImagen();

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefromjpeg($dir . $name);
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, true);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.jpeg
                        unlink($dir . $name);

                        $servicio->setImagen($newName);
                    }

                    $save = $servicio->edit();

                    // Validar si se edito el servicio y mostrar mensaje
                    if ($save) {
                        $_SESSION['servicio_editar'] = "complete";
                    } else {
                        $_SESSION['servicio_editar'] = "failed";
                    }
                } else {

                    if ($mimetype == "image/webp") {
                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $newName);

                        $servicio->setImagen($newName);
                    } elseif ($mimetype == "image/png") {
                        $name = $hoy . "-" . $random . ".png";

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefrompng($dir . $name);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.png
                        unlink($dir . $name);

                        $servicio->setImagen($newName);
                    } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                        $name = $hoy . "-" . $random . ".jpeg";

                        // Guardar imagen en la carpeta 'images'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefromjpeg($dir . $name);
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, true);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.jpeg
                        unlink($dir . $name);

                        $servicio->setImagen($newName);
                    }

                    $save = $servicio->save();

                    // Validar si guardo un servicio y mostrar mensaje
                    if ($save) {
                        $_SESSION['servicio'] = "complete";
                    } else {
                        $_SESSION['servicio'] = "failed";
                    }
                }
            } else {
                $_SESSION['servicio'] = "failed";
            }
        } else {
            $_SESSION['servicio'] = "failed";
        }
        header('Location:' . base_url . 'servicio/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $servicio = new Servicio();
            $servicio->setId($id);
            $servicioEditar = $servicio->getOne();

            // Incluir la vista de editar servicios
            require_once 'views/servicio/crear.php';
        } else {
            header('Location:' . base_url . 'servicio/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $servicio = new Servicio();
            $servicio->setId($id);

            $galeria = new Galeria_servicio();
            $galeria->setId_servicio($id);
            $galeria->delete_all_servicio();

            $delete = $servicio->delete();
            if ($delete) {
                $_SESSION['delete_servicio'] = 'complete';
            } else {
                $_SESSION['delete_servicio'] = 'failed';
            }
        } else {
            $_SESSION['delete_servicio'] = 'failed';
        }
        header('Location:' . base_url . 'servicio/gestion');
    }
}