<?php

namespace elitedrive\Entities;

class Vehicule
{

    private $id_vehicule;
    private $nom;
    private $id_modele;
    private $id_marque;
    private $prix_km;
    private $prix_jour;
    private $prix_semaine;
    private $prix_mois;
    private $annee;
    private $id_carburant;
    private $id_transmission;
    private $id_places;
    private $id_couleur;
    private $description;
    private $statut;
    private $date_creation;
    private $photo;
    private $id_categorie;

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
     * Get the value of prix_km
     */
    public function getPrix_km()
    {
        return $this->prix_km;
    }

    /**
     * Set the value of prix_km
     *
     * @return  self
     */
    public function setPrix_km($prix_km)
    {
        $this->prix_km = $prix_km;
        return $this;
    }

    /**
     * Get the value of prix_jour
     */
    public function getPrix_jour()
    {
        return $this->prix_jour;
    }

    /**
     * Set the value of prix_jour
     *
     * @return  self
     */
    public function setPrix_jour($prix_jour)
    {
        $this->prix_jour = $prix_jour;
        return $this;
    }

    /**
     * Get the value of prix_semaine
     */
    public function getPrix_semaine()
    {
        return $this->prix_semaine;
    }

    /**
     * Set the value of prix_semaine
     *
     * @return  self
     */
    public function setPrix_semaine($prix_semaine)
    {
        $this->prix_semaine = $prix_semaine;
        return $this;
    }

    /**
     * Get the value of prix_mois
     */
    public function getPrix_mois()
    {
        return $this->prix_mois;
    }

    /**
     * Set the value of prix_mois
     *
     * @return  self
     */
    public function setPrix_mois($prix_mois)
    {
        $this->prix_mois = $prix_mois;
        return $this;
    }

    /**
     * Get the value of annee
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
        return $this;
    }

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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of id_categorie
     */
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
        return $this;
    }
}
