<?php
class Galeria_videos
{
    private $id;
    private $video;
    private $nombre;
    private $miniatura;
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

    public function getVideo()
    {
        return $this->video;
    }

    public function getMiniatura()
    {
        return $this->miniatura;
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

    public function setVideo($video)
    {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->video = $this->db->real_escape_string($video);
    }

    public function setMiniatura($miniatura)
    {
        // real_escape_string = Limpiar y escapar los valores que llegan por el formulario
        $this->miniatura = $this->db->real_escape_string($miniatura);
    }

    public function getAll()
    {
        $galeria = $this->db->query("SELECT * FROM galeria_videos ORDER BY id DESC; ");
        return $galeria;
    }

    public function getDestacados()
    {
        $galeria = $this->db->query("SELECT * FROM galeria_videos ORDER BY id DESC limit 6; ");
        return $galeria;
    }

    public function getOne()
    {
        $galeria = $this->db->query(" SELECT * FROM galeria_videos WHERE id = {$this->getId()}; ");
        return $galeria->fetch_object();
    }

    public function save()
    {
        $sql = " INSERT INTO galeria_videos VALUES( NULL, '{$this->getNombre()}', '{$this->getVideo()}', '{$this->getMiniatura()}'); ";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit()
    {
        $sql = " UPDATE galeria_videos SET nombre = '{$this->getNombre()}' ";

        if ($this->getVideo() != null) {
            $sql .= " , video = '{$this->getVideo()}' ";
        }

        if ($this->getMiniatura() != null) {
            $sql .= " , miniatura = '{$this->getMiniatura()}' ";
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
        // Eliminar video del servidor
        $galeria = $this->getOne();
        $video = $galeria->video;
        $miniatura = $galeria->minuatura;

        if ($video != "") {
            unlink("uploads/galeria_videos/" . $video);
        }

        if ($miniatura != "") {
            unlink("uploads/galeria_videos/" . $miniatura);
        }

        // Eliminar
        $sql = " DELETE FROM galeria_videos WHERE id={$this->getId()}; ";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function deleteVideo()
    {
        // Eliminar video del servidor
        $galeria = $this->getOne();

        $video = $galeria->video;

        if ($video != "") {
            unlink("uploads/galeria_videos/" . $video);
        }
    }

    public function deleteMiniatura()
    {
        // Eliminar video del servidor
        $galeria = $this->getOne();

        $miniatura = $galeria->miniatura;

        if ($miniatura != "") {
            unlink("uploads/galeria_videos/" . $miniatura);
        }
    }
}