<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Avis;

class AvisModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT a.*, u.nom, u.prenom, v.nom AS nom_vehicule FROM avis a
                                                    INNER JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur
                                                    INNER JOIN vehicule v ON a.id_vehicule = v.id_vehicule");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayOne($id_avis)
    {
        try {
            $this->request = $this->connection->prepare("SELECT a.*, u.nom, u.prenom, u.email, v.nom AS nom_vehicule, v.photo FROM avis a
                                                    INNER JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur
                                                    INNER JOIN vehicule v ON a.id_vehicule = v.id_vehicule WHERE id_avis = :id_avis");
            $this->request->bindValue(':id_avis', $id_avis, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayByIdUser($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("SELECT a.*, v.nom, v.photo FROM avis a INNER JOIN vehicule v ON a.id_vehicule = v.id_vehicule WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayByIdCar($id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("SELECT a.*, u.id_utilisateur AS utilisateur_id,
                                                    u.nom AS nom_utilisateur,
                                                    u.prenom AS prenom_utilisateur
                                                    FROM avis a
                                                    INNER JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur WHERE a.id_vehicule = :id_vehicule");
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayNoteByCar($id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("SELECT note FROM avis WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_COLUMN); 
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function create(Avis $avis)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO avis (id_utilisateur, id_vehicule, note, commentaire, date_creation) 
                VALUES (:id_utilisateur, :id_vehicule, :note, :commentaire, NOW())"
            );

            $this->request->bindValue(':id_utilisateur', $avis->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $avis->getId_vehicule(), PDO::PARAM_INT);
            $this->request->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $this->request->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function update(Avis $avis)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE avis SET 
                id_utilisateur = :id_utilisateur, id_vehicule = :id_vehicule, 
                note = :note, commentaire = :commentaire 
                WHERE id_avis = :id_avis"
            );

            $this->request->bindValue(':id_avis', $avis->getId_avis(), PDO::PARAM_INT);
            $this->request->bindValue(':id_utilisateur', $avis->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $avis->getId_vehicule(), PDO::PARAM_INT);
            $this->request->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $this->request->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function delete($id_avis)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM avis WHERE id_avis = :id_avis");
            $this->request->bindValue(":id_avis", $id_avis, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function deleteByIdUser($id_utilisateur, $id_avis)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM avis WHERE id_utilisateur = :id_utilisateur AND id_avis = :id_avis");
            $this->request->bindValue(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            $this->request->bindValue(':id_avis', $id_avis, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function search($search)
    {
        try {
            if (empty($search)) {
                return [];
            }
            $this->request = $this->connection->prepare(
                "SELECT a.*, u.id_utilisateur, u.nom, u.prenom, v.nom AS nom_vehicule
                FROM avis a 
                INNER JOIN utilisateur u ON a.id_utilisateur = u.id_utilisateur 
                INNER JOIN vehicule v ON a.id_vehicule = v.id_vehicule
                WHERE a.commentaire LIKE :search
                OR a.note LIKE :search
                OR u.nom LIKE :search
                OR u.prenom LIKE :search
                OR a.date_creation LIKE :search
                OR v.nom LIKE :search"
            );
            $this->request->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
