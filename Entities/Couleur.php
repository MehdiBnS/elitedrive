<?php

namespace elitedrive\Entities;

class Couleur {

    private $id_couleur;
    private $nom;

    /**
     * Get the value of id_couleur
     */ 
    public function getId_couleur()
    {
        return $this->id_couleur;
    }

    /**
     * Set the value of id_couleur
     *
     * @return  self
     */ 
    public function setId_couleur($id_couleur)
    {
        $this->id_couleur = $id_couleur;

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
