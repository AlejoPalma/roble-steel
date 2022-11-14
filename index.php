<?php
ob_start();
// Iniciar la sesion en el proyecto
session_start();

require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';

// Controllers/ErrorController.php
function show_error() {
    $error = new errorController();
    $error->index();
}

// Validar si existe controlador en la url
if(isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
}else {
    show_error();
    exit();
}

// Validar si existe el controlador en el sitio web
if(class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();

    // Validar si existe el método en el controlador
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    }else {
        show_error();
    }
}else {
    show_error();
}

require_once 'views/layout/footer.php';
ob_end_flush();
?>