<?php
class Servicio
{
    private $id;
    private $nombre;
    private $descripcion;
    private $imagen;
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

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setId($id)
    {
        $this->id = $this->db->real_escape_string($id);
    }

    public function setNombre($nombre)
    {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function setImagen($imagen)
    {
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function getAll()
    {
        $servicios = $this->db->query("SELECT * FROM servicios ORDER BY id DESC; ");
        return $servicios;
    }

    public function buscador()
    {
        $serviciosBuscar = $this->db->query("SELECT * from servicios WHERE nombre LIKE ('%{$this->getNombre()}%')");
        return $serviciosBuscar;
    }

    public function getOne()
    {
        $servicio = $this->db->query(" SELECT * FROM servicios WHERE id = {$this->getId()}; ");
        return $servicio->fetch_object();
    }

    public function getPrimera()
    {
        $primera = $this->db->query(" SELECT * FROM servicios ORDER BY id ASC limit 1; ");
        return $primera->fetch_object();
    }

    public function getServicios()
    {
        $servicios = $this->db->query(" SELECT * FROM servicios WHERE id > 1 ORDER BY id ASC; ");
        return $servicios;
    }

    public function save()
    {
        $sql = " INSERT INTO servicios VALUES( NULL, '{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getImagen()}'); ";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit()
    {
        $sql = " UPDATE servicios SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}' ";

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

    public function delete()
    {
        // Eliminar imagen del servidor
        $servicio = $this->getOne();
        $imagen = $servicio->imagen;

        if ($imagen != "") {
            unlink("uploads/images/" . $imagen);
        }

        // Eliminar el servicio
        $sql = " DELETE FROM servicios WHERE id={$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function deleteImagen()
    {
        // Eliminar imagen del servidor
        $servicio = $this->getOne();

        $imagen = $servicio->imagen;

        if ($imagen != "") {
            unlink("uploads/images/" . $imagen);
        }
    }
}