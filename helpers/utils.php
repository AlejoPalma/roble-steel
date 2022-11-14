<?php
class Utils {

    public static function mostrarError($errores, $campo) {
        $alerta = "";
        if(isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='alert mb-3' role='alert' data-mdb-color='danger'>".$errores[$campo]."</div>";
        }else{
            echo "";
        }

        return $alerta;
    }

    public static function deleteSession($name) {
        if(isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin() {
        if(!isset($_SESSION['admin'])) {
            header("Location:".base_url);
        }else {
            return true;
        }
    }

    public static function isIdentity() {
        if(!isset($_SESSION['identity'])) {
            header("Location:".base_url);
        }else {
            return true;
        }
    }

    public static function showServicios()
    {
        require_once 'models/servicio.php';
        $servicios = new Servicio();
        $servicios = $servicios->getAll();
        return $servicios;
    }

    public static function nombreServicio($id_servicio)
    {
        require_once 'models/servicio.php';
        $servicio = new Servicio();
        $servicio->setId($id_servicio);
        $servicio = $servicio->getOne();

        $nombre_servicio = $servicio->nombre;

        return $nombre_servicio;
    }

}