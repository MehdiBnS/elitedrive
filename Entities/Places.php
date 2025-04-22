<?php

namespace elitedrive\Entities;

class Places {

    private $id_places;
    private $nombre;

    /**
     * Get the value of id_places
     */ 
    public function getId_places()
    {
        return $this->id_places;
    }

    /**
     * Set the value of id_places
     *
     * @return  self
     */ 
    public function setId_places($id_places)
    {
        $this->id_places = $id_places;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
