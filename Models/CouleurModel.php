<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Couleur;

class CouleurModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM couleur");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Couleur $couleur)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO couleur (nom) VALUES (:nom)");
            $nom = $couleur->getNom();
            $this->request->bindValue(":nom", $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($couleur)
    {
        try {
            $id_couleur = $couleur->getId_couleur();
            $nom = $couleur->getNom();
            $this->request = $this->connection->prepare("UPDATE couleur SET nom = :nom WHERE id_couleur = :id_couleur");
            $this->request->bindValue(':id_couleur', $id_couleur, PDO::PARAM_INT);
            $this->request->bindValue(':nom', $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_couleur)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM couleur WHERE id_couleur = :id_couleur");
        $this->request->bindValue(":id_couleur", $id_couleur, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
