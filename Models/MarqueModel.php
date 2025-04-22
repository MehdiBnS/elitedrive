<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Marque;

class MarqueModel extends DbConnect
{public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM marque");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayOne($id_marque)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM marque WHERE id_marque = :id_marque");
            $this->request->bindValue(':id_marque', $id_marque);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Marque $marque)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO marque (nom) VALUES (:nom)");
            $nom = $marque->getNom();
            $this->request->bindValue(":nom", $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($marque)
    {
        try {
            $id_marque = $marque->getId_marque();
            $nom = $marque->getNom();
            $this->request = $this->connection->prepare("UPDATE marque SET nom = :nom WHERE id_marque = :id_marque");
            $this->request->bindValue(':id_marque', $id_marque, PDO::PARAM_INT);
            $this->request->bindValue(':nom', $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_marque)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM marque WHERE id_marque = :id_marque");
        $this->request->bindValue(":id_marque", $id_marque, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function search($searchMarque)
    {
        try {
            if (empty($searchMarque)) {
                return [];
            }
            $this->request = $this->connection->prepare("SELECT * FROM marque WHERE nom LIKE :searchMarque");
            $this->request->bindValue(':searchMarque', '%' . $searchMarque . '%', PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}