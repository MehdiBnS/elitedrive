<?php

namespace elitedrive\Entities;

class Transmission {

    private $id_transmission;
    private $type;

    /**
     * Get the value of id_transmission
     */ 
    public function getId_transmission()
    {
        return $this->id_transmission;
    }

    /**
     * Set the value of id_transmission
     *
     * @return  self
     */ 
    public function setId_transmission($id_transmission)
    {
        $this->id_transmission = $id_transmission;

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
