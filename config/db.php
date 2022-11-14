<?php
class DataBase {

    public static function connect() {
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $database = "proyecto2";

        // Establecer una nueva conexión a un servidor MySQL.
        $conexion = mysqli_connect($serverName, $userName, $password, $database);

        // Validar conexión
        if(!$conexion) {
            die("Conexión fallida: ".mysqli_connect_error());
        }

        return $conexion;

    }
}