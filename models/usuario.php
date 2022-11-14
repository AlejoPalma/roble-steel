<?php

class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $password_nueva;
    private $rol;
    // Conexion base de datos
    private $db;

    public function __construct() {
        $this->db = DataBase::connect();
    }    

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        // cifrar contraseña password_hash
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function getPassword_nueva() {
        // cifrar contraseña password_hash
        return password_hash($this->db->real_escape_string($this->password_nueva), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    public function setPassword($password) {
        $this->password = $this->db->real_escape_string($password);
    }

    public function setPassword_nueva($password_nueva) {
        $this->password_nueva = $this->db->real_escape_string($password_nueva);
    }

    public function setRol($rol) {
        $this->rol = $this->db->real_escape_string($rol);
    }

    public function save() {
        $sql = " INSERT INTO usuarios VALUES( NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'admin'); ";
        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }

        return $result;
    }

    public function login() {
        $result = false;
        $email = $this->getEmail();
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = " SELECT * FROM usuarios WHERE email = '{$email}' ;";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if($verify) {
                $result = $usuario;
            }
        }

        // Devuelve al objeto obtenido de la base de datos
        return $result;
    }

    public function validarEmail() {
        $existe = false;
        $email = $this->getEmail();

        // Comprobar si existe el email
        $sql = " SELECT email FROM usuarios WHERE email = '{$email}' ;";
        $validar = $this->db->query($sql);

        if($validar && $validar->num_rows == 1) {
            $existe = true;
        }else {
            $existe = false;
        }

        // Devuelve boolean
        return $existe;
    }

    public function validarEmailUpdate() {
        $existe = false;
        $email = $this->getEmail();
        $id = $this->getId();

        // Comprobar si existe el email y que el id sea distinto del usuario
        $sql = " SELECT email FROM usuarios WHERE email = '{$email}' and id != {$id};";
        $validar = $this->db->query($sql);

        if($validar && $validar->num_rows == 1) {
            $existe = true;
        }else {
            $existe = false;
        }

        return $existe;
    }

    public function getOne() {
        $usuario = $this->db->query(" SELECT * FROM usuarios WHERE id={$this->getId()}; ");
        return $usuario->fetch_object();
    }


    public function edit() {
        $sql = " UPDATE usuarios SET nombre = '{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}' WHERE id = {$this->getId()}; ";

        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function editPassword() {
        $sql = " UPDATE usuarios SET password = '{$this->getPassword_nueva()}' WHERE id = {$this->getId()}; ";

        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function recuperarPassword() {
        $sql = " UPDATE usuarios SET password = '{$this->getPassword()}' WHERE email = '{$this->getEmail()}'; ";

        $save = $this->db->query($sql);

        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }

    public function delete() {
        $sql = " DELETE FROM usuarios WHERE id = {$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete) {
            $result = true;
        }
        return $result;
    }
}

?>