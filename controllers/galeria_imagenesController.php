<?php
require_once 'models/galeria_imagenes.php';

class galeria_imagenesController
{
    public function index()
    {
        $galeria = new Galeria_imagenes();
        $galeria = $galeria->getAll();

        // redireccionar vista
        require_once 'views/galeria_imagenes/galeria.php';
    }

    public function gestion()
    {
        Utils::isAdmin();

        // Obtener todos los galeria
        $galeria = new Galeria_imagenes();
        $galeria = $galeria->getAll();

        // Redirigir 
        require_once 'views/galeria_imagenes/gestion.php';
    }

    public function crear()
    {
        // Comprobar que el usuario es administrador
        Utils::isAdmin();

        // redireccionar vista
        require_once 'views/galeria_imagenes/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if ($nombre) {
                $galeria = new Galeria_imagenes();
                $galeria->setNombre($nombre);

                // Validar si existe la carpeta donde se guardarán las imagenes
                if (!is_dir('uploads/galeria_imagenes')) {
                    // Si no existe, crear carpeta
                    mkdir('uploads/galeria_imagenes', 0777, true);
                }

                $dir = 'uploads/galeria_imagenes/';
                $file = $_FILES['imagen'];
                $mimetype = $file['type'];

                $hoy = date("Y-m-d_H-i-s");
                $random = rand(0, 99);
                $newName = $hoy . "-" . $random . ".webp";

                // Validar si existe GET para editar o agregar un nuevo elemento
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $galeria->setId($id);

                    if ($mimetype == "image/webp") {
                        $galeria->deleteImagen();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file['tmp_name'], $dir . $newName);

                        $galeria->setImagen($newName);
                    } elseif ($mimetype == "image/png") {
                        $name = $hoy . "-" . $random . ".png";

                        $galeria->deleteImagen();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefrompng($dir . $name);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.png
                        unlink($dir . $name);

                        $galeria->setImagen($newName);
                    } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                        $name = $hoy . "-" . $random . ".jpeg";

                        $galeria->deleteImagen();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
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

                        $galeria->setImagen($newName);
                    }

                    $save = $galeria->edit();

                    // Validar si se edito el galeria y mostrar mensaje
                    if ($save) {
                        $_SESSION['galeria_editar'] = "complete";
                    } else {
                        $_SESSION['galeria_editar'] = "failed";
                    }
                } else {

                    if ($mimetype == "image/webp") {
                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file['tmp_name'], $dir . $newName);

                        $galeria->setImagen($newName);
                    } elseif ($mimetype == "image/png") {
                        $name = $hoy . "-" . $random . ".png";

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file['tmp_name'], $dir . $name);

                        // Create and save image.webp
                        $img = imagecreatefrompng($dir . $name);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.png
                        unlink($dir . $name);

                        $galeria->setImagen($newName);
                    } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                        $name = $hoy . "-" . $random . ".jpeg";

                        // Guardar imagen en la carpeta 'galeria_imagenes'
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

                        $galeria->setImagen($newName);
                    }

                    $save = $galeria->save();

                    // Validar si se edito el galeria y mostrar mensaje
                    if ($save) {
                        $_SESSION['galeria'] = "complete";
                    } else {
                        $_SESSION['galeria'] = "failed";
                    }
                }
            } else {
                $_SESSION['galeria'] = "failed";
            }
        } else {
            $_SESSION['galeria'] = "failed";
        }
        header('Location:' . base_url . 'galeria_imagenes/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $galeria = new Galeria_imagenes();
            $galeria->setId($id);
            $galeriaEditar = $galeria->getOne();

            // Incluir la vista de editar galeria
            require_once 'views/galeria_imagenes/crear.php';
        } else {
            header('Location:' . base_url . 'galeria_imagenes/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $galeria = new Galeria_imagenes();
            $galeria->setId($id);

            $delete = $galeria->delete();
            if ($delete) {
                $_SESSION['delete_galeria'] = 'complete';
            } else {
                $_SESSION['delete_galeria'] = 'failed';
            }
        } else {
            $_SESSION['delete_galeria'] = 'failed';
        }
        header('Location:' . base_url . 'galeria_imagenes/gestion');
    }
}