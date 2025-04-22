<?php

namespace elitedrive\Entities;

class Carburant {

    private $id_carburant;
    private $type;

    /**
     * Get the value of id_carburant
     */ 
    public function getId_carburant()
    {
        return $this->id_carburant;
    }

    /**
     * Set the value of id_carburant
     *
     * @return  self
     */ 
    public function setId_carburant($id_carburant)
    {
        $this->id_carburant = $id_carburant;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
