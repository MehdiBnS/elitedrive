<?php

namespace elitedrive\Entities;

class Modele {

    private $id_modele;
    private $nom;

    /**
     * Get the value of id_modele
     */ 
    public function getId_modele()
    {
        return $this->id_modele;
    }

    /**
     * Set the value of id_modele
     *
     * @return  self
     */ 
    public function setId_modele($id_modele)
    {
        $this->id_modele = $id_modele;

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
