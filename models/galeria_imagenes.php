<?php
class Galeria_imagenes
{
    private $id;
    private $imagen;
    private $nombre;
    // Conexion base de datos
    private $db;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setImagen($imagen)
    {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getAll()
    {
        $galeria = $this->db->query("SELECT * FROM galeria_imagenes ORDER BY id DESC; ");
        return $galeria;
    }

    public function getDestacados()
    {
        $galeria = $this->db->query("SELECT * FROM galeria_imagenes ORDER BY id DESC limit 6; ");
        return $galeria;
    }

    public function getOne()
    {
        $galeria = $this->db->query(" SELECT * FROM galeria_imagenes WHERE id = {$this->getId()}; ");
        return $galeria->fetch_object();
    }

    public function save()
    {
        $sql = " INSERT INTO galeria_imagenes VALUES( NULL, '{$this->getNombre()}', '{$this->getImagen()}'); ";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit()
    {
        $sql = " UPDATE galeria_imagenes SET nombre = '{$this->getNombre()}' ";

        if ($this->getImagen() != null) {
            $sql .= " , imagen = '{$this->getImagen()}' ";
        }

        $sql .= " WHERE id = '{$this->getId()}'; ";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function deleteImagen()
    {
        // Eliminar imagen del servidor
        $imagen = $this->getOne();
        $imagen = $imagen->imagen;

        if ($imagen != "") {
            unlink("uploads/galeria_imagenes/" . $imagen);
        }
    }

    public function delete()
    {
        // Eliminar imagen del servidor
        $galeria = $this->getOne();
        $imagen = $galeria->imagen;

        if ($imagen != "") {
            unlink("uploads/galeria_imagenes/" . $imagen);
        }

        // Eliminar la imagen
        $sql = " DELETE FROM galeria_imagenes WHERE id={$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}