<?php

namespace elitedrive\Entities;

class Reservation {

    private $id_reservation;
    private $date_creation;
    private $id_utilisateur;
    private $id_vehicule;
    private $montant;
    private $date_debut;
    private $date_fin;
    private $forfait;

    /**
     * Get the value of id_reservation
     */ 
    public function getId_reservation()
    {
        return $this->id_reservation;
    }

    /**
     * Set the value of id_reservation
     *
     * @return  self
     */ 
    public function setId_reservation($id_reservation)
    {
        $this->id_reservation = $id_reservation;
        return $this;
    }

    /**
     * Get the value of date_creation
     */ 
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * Set the value of date_creation
     *
     * @return  self
     */ 
    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    /**
     * Get the value of id_vehicule
     */ 
    public function getId_vehicule()
    {
        return $this->id_vehicule;
    }

    /**
     * Set the value of id_vehicule
     *
     * @return  self
     */ 
    public function setId_vehicule($id_vehicule)
    {
        $this->id_vehicule = $id_vehicule;
        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;
        return $this;
    }

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    /**
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    /**
     * Get the value of forfait
     */ 
    public function getForfait()
    {
        return $this->forfait;
    }

    /**
     * Set the value of forfait
     *
     * @return  self
     */ 
    public function setForfait($forfait)
    {
        $this->forfait = $forfait;
        return $this;
    }
}
