<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Carburant;

class CarburantModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM carburant");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayOne($id_carburant)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM carburant WHERE id_carburant = :id_carburant");
            $this->request->bindValue(':id_carburant', $id_carburant);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Carburant $carburant)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO carburant (type) VALUES (:type)");
            $type = $carburant->getType();
            $this->request->bindValue(":type", $type, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($carburant)
    {
        try {
            $id_carburant = $carburant->getId_carburant();
            $type = $carburant->getType();
            $this->request = $this->connection->prepare("UPDATE carburant SET type = :type WHERE id_carburant = :id_carburant");
            $this->request->bindValue(':id_carburant', $id_carburant, PDO::PARAM_INT);
            $this->request->bindValue(':type', $type, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_carburant)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM carburant WHERE id_carburant = :id_carburant");
        $this->request->bindValue(":id_carburant", $id_carburant, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
