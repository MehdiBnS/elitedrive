<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Transmission;

class TransmissionModel extends DbConnect
{

    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM transmission");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayOne($id_transmission)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM transmission WHERE id_transmission = :id_transmission");
            $this->request->bindValue(':id_transmission', $id_transmission);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Transmission $transmission)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO transmission (type) VALUES (:type)");
            $type = $transmission->getType();
            $this->request->bindValue(":type", $type, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($transmission)
    {
        try {
            $id_transmission = $transmission->getId_transmission();
            $type = $transmission->getType();
            $this->request = $this->connection->prepare("UPDATE transmission SET type = :type WHERE id_transmission = :id_transmission");
            $this->request->bindValue(':id_transmission', $id_transmission, PDO::PARAM_INT);
            $this->request->bindValue(':type', $type, PDO::PARAM_STR);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_transmission)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM transmission WHERE id_transmission = :id_transmission");
        $this->request->bindValue(":id_transmission", $id_transmission, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
