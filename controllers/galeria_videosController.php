<?php
require_once 'models/galeria_videos.php';

class galeria_videosController
{
    public function index()
    {
        $galeria = new Servicio();
        $galeria = $galeria->getAll();

        // redireccionar vista
        require_once 'views/galeria_videos/galeria.php';
    }

    public function gestion()
    {
        Utils::isAdmin();

        // Obtener todos los galeria
        $galeria = new Galeria_videos();
        $galeria = $galeria->getAll();

        // Redirigir 
        require_once 'views/galeria_videos/gestion.php';
    }

    public function crear()
    {
        // Comprobar que el usuario es administrador
        Utils::isAdmin();

        // redireccionar vista
        require_once 'views/galeria_videos/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST['save'])) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if ($nombre) {
                $galeria = new Galeria_videos();
                $galeria->setNombre($nombre);

                // Validar si existe la carpeta donde se guardarán las videos
                if (!is_dir('uploads/galeria_videos')) {
                    // Si no existe, crear carpeta
                    mkdir('uploads/galeria_videos', 0777, true);
                }

                $hoy = date("Y-m-d_H-i-s");
                $random = rand(0, 99);
                $dir = 'uploads/galeria_videos/';

                // Imagen miniatura
                $file_miniatura = $_FILES['miniatura'];
                $mimetype = $file_miniatura['type'];
                $newName = $hoy . "-" . $random . ".webp";

                // Video
                $file_name = $_FILES['video']['name'];
                $file_temp = $_FILES['video']['tmp_name'];

                $file = explode('.', $file_name);
                $end = end($file);
                $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');

                $name = $hoy . "-" . $random . "." . $end;

                // Validar si existe GET para editar o agregar un nuevo elemento
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $galeria->setId($id);

                    // Imagen
                    if ($mimetype == "image/webp") {
                        $galeria->deleteMiniatura();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file_miniatura['tmp_name'], $dir . $newName);

                        $galeria->setMiniatura($newName);
                    } elseif ($mimetype == "image/png") {
                        $name_miniatura = $hoy . "-" . $random . ".png";

                        $galeria->deleteMiniatura();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file_miniatura['tmp_name'], $dir . $name_miniatura);

                        // Create and save image.webp
                        $img = imagecreatefrompng($dir . $name_miniatura);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.png
                        unlink($dir . $name_miniatura);

                        $galeria->setMiniatura($newName);
                    } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                        $name_miniatura = $hoy . "-" . $random . ".jpeg";

                        $galeria->deleteMiniatura();

                        // Guardar imagen en la carpeta 'galeria_imagenes'
                        move_uploaded_file($file_miniatura['tmp_name'], $dir . $name_miniatura);

                        // Create and save image.webp
                        $img = imagecreatefromjpeg($dir . $name_miniatura);
                        imagepalettetotruecolor($img);
                        imagealphablending($img, true);
                        imagesavealpha($img, true);
                        imagewebp($img, $dir . $newName, 100);
                        imagedestroy($img);

                        // Eliminar imagen.jpeg
                        unlink($dir . $name_miniatura);

                        $galeria->setMiniatura($newName);
                    }

                    // Video
                    if (in_array($end, $allowed_ext)) {
                        $location = $dir . $name;

                        $galeria->deleteVideo();

                        move_uploaded_file($file_temp, $location);

                        // Guardar el nombre de la videos en el objeto
                        $galeria->setVideo($name);
                    }

                    $save = $galeria->edit();

                    // Validar si se edito el galeria y mostrar mensaje
                    if ($save) {
                        $_SESSION['galeria_editar'] = "complete";
                    } else {
                        $_SESSION['galeria_editar'] = "failed";
                    }
                } else {
                    if (in_array($end, $allowed_ext)) {
                        $location = $dir . $name;
                        move_uploaded_file($file_temp, $location);

                        // Guardar el nombre de la videos en el objeto
                        $galeria->setVideo($name);

                        // Imagen
                        if ($mimetype == "image/webp") {
                            // Guardar imagen en la carpeta 'galeria_imagenes'
                            move_uploaded_file($file_miniatura['tmp_name'], $dir . $newName);

                            $galeria->setMiniatura($newName);
                        } elseif ($mimetype == "image/png") {
                            $name_miniatura = $hoy . "-" . $random . ".png";

                            // Guardar imagen en la carpeta 'galeria_imagenes'
                            move_uploaded_file($file_miniatura['tmp_name'], $dir . $name_miniatura);

                            // Create and save image.webp
                            $img = imagecreatefrompng($dir . $name_miniatura);
                            imagewebp($img, $dir . $newName, 100);
                            imagedestroy($img);

                            // Eliminar imagen.png
                            unlink($dir . $name_miniatura);

                            $galeria->setMiniatura($newName);
                        } elseif ($mimetype == "image/jpg" || $mimetype == "image/jpeg") {
                            $name_miniatura = $hoy . "-" . $random . ".jpeg";

                            // Guardar imagen en la carpeta 'galeria_imagenes'
                            move_uploaded_file($file_miniatura['tmp_name'], $dir . $name_miniatura);

                            // Create and save image.webp
                            $img = imagecreatefromjpeg($dir . $name_miniatura);
                            imagepalettetotruecolor($img);
                            imagealphablending($img, true);
                            imagesavealpha($img, true);
                            imagewebp($img, $dir . $newName, 100);
                            imagedestroy($img);

                            // Eliminar imagen.jpeg
                            unlink($dir . $name_miniatura);

                            $galeria->setMiniatura($newName);
                        }
                    }

                    $save = $galeria->save();

                    // Validar si guardo un galeria y mostrar mensaje
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
        header('Location:' . base_url . 'galeria_videos/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $galeria = new Galeria_videos();
            $galeria->setId($id);
            $galeriaEditar = $galeria->getOne();

            // Incluir la vista de editar galeria
            require_once 'views/galeria_videos/crear.php';
        } else {
            header('Location:' . base_url . 'galeria_videos/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $galeria = new Galeria_videos();
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
        header('Location:' . base_url . 'galeria_videos/gestion');
    }
}
