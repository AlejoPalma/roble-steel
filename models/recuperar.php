<?php

    class Recuperar {
        private $email;
        private $clave_nueva;
        private $token;
        private $fecha_alta;
        private $db;

        public function __construct() {
            $this->db = DataBase::connect();
        } 

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setClave_nueva($clave_nueva) {
            $this->clave_nueva = $clave_nueva;
        }

        public function setToken($token) {
            $this->token = $token;
        }

        public function setFecha_alta($fecha_alta) {
            $this->fecha_alta = $fecha_alta;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getClave_nueva() {
            return $this->clave_nueva;
        }
    
        public function getToken() {
            return $this->token;
        }

        public function getFecha_alta() {
            return $this->fecha_alta;
        }

        public function save() {
            $sql = " INSERT INTO recuperar VALUES('{$this->getEmail()}', {$this->getClave_nueva()}, {$this->getToken()}, '{$this->getFecha_alta()}'); ";
            $save = $this->db->query($sql);
    
            $result = false;
            if($save) {
                $result = true;
            }
    
            return $result;
        }

        public function validarEmail() {
            $existe = false;
    
            // Comprobar si existe el email
            $sql = " SELECT email FROM recuperar WHERE email = '{$this->getEmail()}' ;";
            $validar = $this->db->query($sql);
    
            if($validar && $validar->num_rows == 1) {
                $existe = true;
            }else {
                $existe = false;
            }
    
            return $existe;
        }

        public function validarRecuperar() {
            $sql = " SELECT * FROM recuperar WHERE email = '{$this->getEmail()}' AND token = {$this->getToken()} LIMIT 1; ";
            $save = $this->db->query($sql);
    
            $result = false;
            if($save && $save->num_rows == 1) {
                $result = true;
            }
    
            return $result;
        }

        public function getOne() {
            $recuperar = $this->db->query(" SELECT * FROM recuperar WHERE email = '{$this->getEmail()}'; ");
            return $recuperar->fetch_object();
        }

        public function delete() {
            $sql = " DELETE FROM recuperar WHERE email = '{$this->getEmail()}'; ";
            $delete = $this->db->query($sql);

            $result = false;
            if($delete) {
                $result = true;
            }
            return $result;
        }

    } /* FIN CLASE */
?>