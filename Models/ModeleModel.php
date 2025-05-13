<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Modele;

class ModeleModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM modele");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Modele $modele)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO modele (nom) VALUES (:nom)");
            $nom = $modele->getNom();
            $this->request->bindValue(":nom", $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($modele)
    {
        try {
            $id_modele = $modele->getId_modele();
            $nom = $modele->getNom();
            $this->request = $this->connection->prepare("UPDATE modele SET nom = :nom WHERE id_modele = :id_modele");
            $this->request->bindValue(':id_modele', $id_modele, PDO::PARAM_INT);
            $this->request->bindValue(':nom', $nom, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_modele)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM modele WHERE id_modele = :id_modele");
        $this->request->bindValue(":id_modele", $id_modele, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}