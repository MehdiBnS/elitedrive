<?php

namespace elitedrive\Entities;

class Marque {

    private $id_marque;
    private $nom;

    /**
     * Get the value of id_marque
     */ 
    public function getId_marque()
    {
        return $this->id_marque;
    }

    /**
     * Set the value of id_marque
     *
     * @return  self
     */ 
    public function setId_marque($id_marque)
    {
        $this->id_marque = $id_marque;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}
