<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Archive;

class ArchiveModel extends DbConnect
{
    // Afficher toutes les archives
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM archive");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Afficher une archive par ID
    public function displayOne($id_archive)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM archive WHERE id_archive = :id_archive");
            $this->request->bindValue(':id_archive', $id_archive, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Créer une nouvelle archive
    public function create(Archive $archive)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO archive 
                (nom, prenom, numero_telephone, ville, email, 
                 nom_vehicule, modele, marque, categorie_vehicule, montant, date) 
                 VALUES 
                (:nom, :prenom, :numero_telephone, :ville, :email, 
                 :nom_vehicule, :modele, :marque, :categorie_vehicule, :montant, :date)"
            );

            $this->request->bindValue(':nom', $archive->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':prenom', $archive->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(':numero_telephone', $archive->getNumero_telephone(), PDO::PARAM_STR);
            $this->request->bindValue(':ville', $archive->getVille(), PDO::PARAM_STR);
            $this->request->bindValue(':email', $archive->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(':nom_vehicule', $archive->getNom_vehicule(), PDO::PARAM_STR);
            $this->request->bindValue(':modele', $archive->getModele(), PDO::PARAM_STR);
            $this->request->bindValue(':marque', $archive->getMarque(), PDO::PARAM_STR);
            $this->request->bindValue(':categorie_vehicule', $archive->getCategorie_vehicule(), PDO::PARAM_STR);
            $this->request->bindValue(':montant', $archive->getMontant(), PDO::PARAM_STR);
            $this->request->bindValue(':date', $archive->getDate(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Mettre à jour une archive
    public function update(Archive $archive)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE archive 
                SET nom = :nom, prenom = :prenom, numero_telephone = :numero_telephone, 
                    ville = :ville, email = :email, nom_vehicule = :nom_vehicule, 
                    modele = :modele, marque = :marque, categorie_vehicule = :categorie_vehicule, 
                    montant = :montant, date = :date 
                WHERE id_archive = :id_archive"
            );

            $this->request->bindValue(':id_archive', $archive->getId_archive(), PDO::PARAM_INT);
            $this->request->bindValue(':nom', $archive->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':prenom', $archive->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(':numero_telephone', $archive->getNumero_telephone(), PDO::PARAM_STR);
            $this->request->bindValue(':ville', $archive->getVille(), PDO::PARAM_STR);
            $this->request->bindValue(':email', $archive->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(':nom_vehicule', $archive->getNom_vehicule(), PDO::PARAM_STR);
            $this->request->bindValue(':modele', $archive->getModele(), PDO::PARAM_STR);
            $this->request->bindValue(':marque', $archive->getMarque(), PDO::PARAM_STR);
            $this->request->bindValue(':categorie_vehicule', $archive->getCategorie_vehicule(), PDO::PARAM_STR);
            $this->request->bindValue(':montant', $archive->getMontant(), PDO::PARAM_STR);
            $this->request->bindValue(':date', $archive->getDate(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Supprimer une archive
    public function delete($id_archive)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM archive WHERE id_archive = :id_archive");
            $this->request->bindValue(":id_archive", $id_archive, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Rechercher des archives avec un critère
    public function search($search)
    {
        try {
            if (empty($search)) {
                return [];
            }
            // Préparer la requête SQL avec des conditions de recherche sur toutes les colonnes concernées
            $this->request = $this->connection->prepare(
                "SELECT * FROM archive 
            WHERE nom LIKE :search 
            OR prenom LIKE :search
            OR numero_telephone LIKE :search
            OR ville LIKE :search
            OR email LIKE :search
            OR nom_vehicule LIKE :search
            OR modele LIKE :search
            OR marque LIKE :search
            OR categorie_vehicule LIKE :search
            OR montant LIKE :search
            OR date LIKE :search"
            );

            // Ajouter des jokers pour effectuer une recherche partielle
            $this->request->bindValue(':search', "%$search%", PDO::PARAM_STR);

            // Exécuter la requête
            $this->request->execute();

            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
