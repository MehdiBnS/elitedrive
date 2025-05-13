<?php

namespace elitedrive\Entities;

class Archive
{
    private $id_archive;
    private $nom;
    private $prenom;
    private $numero_telephone;
    private $ville;
    private $email;
    private $nom_vehicule;
    private $modele;
    private $marque;
    private $categorie_vehicule;
    private $montant;
    private $date;


    public function getId_archive()
    {
        return $this->id_archive;
    }

    public function setId_archive($id_archive)
    {
        $this->id_archive = $id_archive;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNumero_telephone()
    {
        return $this->numero_telephone;
    }

    public function setNumero_telephone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;
        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getNom_vehicule()
    {
        return $this->nom_vehicule;
    }

    public function setNom_vehicule($nom_vehicule)
    {
        $this->nom_vehicule = $nom_vehicule;
        return $this;
    }

    public function getModele()
    {
        return $this->modele;
    }

    public function setModele($modele)
    {
        $this->modele = $modele;
        return $this;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
        return $this;
    }

    public function getCategorie_vehicule()
    {
        return $this->categorie_vehicule;
    }

    public function setCategorie_vehicule($categorie_vehicule)
    {
        $this->categorie_vehicule = $categorie_vehicule;
        return $this;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant($montant)
    {
        $this->montant = $montant;
        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
}
?>
