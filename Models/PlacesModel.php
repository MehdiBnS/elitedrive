<?php


namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Places;

class PlacesModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM places");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayOne($id_places)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM places WHERE id_places = :id_places");
            $this->request->bindValue(':id_places', $id_places);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Places $places)
    {
        try {
            $this->request = $this->connection->prepare("INSERT INTO places (nombre) VALUES (:nombre)");
            $nombre = $places->getNombre();
            $this->request->bindValue(":nombre", $nombre, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update($places)
    {
        try {
            $id_places = $places->getId_places();
            $nombre = $places->getNombre();
            $this->request = $this->connection->prepare("UPDATE places SET nombre = :nombre WHERE id_places = :id_places");
            $this->request->bindValue(':id_places', $id_places, PDO::PARAM_INT);
            $this->request->bindValue(':nombre', $nombre, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_places)
    {
        try {
        $this->request = $this->connection->prepare("DELETE FROM places WHERE id_places = :id_places");
        $this->request->bindValue(":id_places", $id_places, PDO::PARAM_INT);
        return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
