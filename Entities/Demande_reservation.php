<?php


namespace elitedrive\Entities;


class Demande_Reservation {

    private $id_demande_reservation;
    private $message;
    private $date_debut;
    private $date_fin;
    private $montant;
    private $statut;// Acceptée, En attente, Refusée
    private $date_creation;
    private $forfait;
    private $id_utilisateur;
    private $id_vehicule;

    /**
     * Get the value of id_demande_reservation
     */ 
    public function getId_demande_reservation()
    {
        return $this->id_demande_reservation;
    }

    /**
     * Set the value of id_demande_reservation
     *
     * @return  self
     */ 
    public function setId_demande_reservation($id_demande_reservation)
    {
        $this->id_demande_reservation = $id_demande_reservation;
        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;
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
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;
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
}
