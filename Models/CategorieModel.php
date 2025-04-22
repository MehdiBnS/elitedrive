<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Categorie;

class CategorieModel extends DbConnect
{
    // Afficher toutes les catégories
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM categorie");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Afficher une catégorie par son ID
    public function displayOne($id_categorie)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM categorie WHERE id_categorie = :id_categorie");
            $this->request->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Créer une nouvelle catégorie
    public function create(Categorie $categorie)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO categorie (nom, description, photo, date_creation) 
                VALUES (:nom, :description, :photo, NOW())"
            );

            $this->request->bindValue(':nom', $categorie->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':description', $categorie->getDescription(), PDO::PARAM_STR);
            $this->request->bindValue(':photo', $categorie->getPhoto(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Mettre à jour une catégorie
    public function update(Categorie $categorie)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE categorie SET 
                nom = :nom, description = :description, photo = :photo 
                WHERE id_categorie = :id_categorie"
            );

            $this->request->bindValue(':id_categorie', $categorie->getId_categorie(), PDO::PARAM_INT);
            $this->request->bindValue(':nom', $categorie->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':description', $categorie->getDescription(), PDO::PARAM_STR);
            $this->request->bindValue(':photo', $categorie->getPhoto(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Supprimer une catégorie
    public function delete($id_categorie)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM categorie WHERE id_categorie = :id_categorie");
            $this->request->bindValue(":id_categorie", $id_categorie, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Rechercher une catégorie
    public function search($searchCategorie)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM categorie WHERE nom LIKE :searchCategorie OR description LIKE :searchCategorie");
            $this->request->bindValue(':searchCategorie', '%' . $searchCategorie . '%', PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
