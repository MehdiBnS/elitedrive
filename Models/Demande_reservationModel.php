<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Demande_Reservation;

class Demande_ReservationModel extends DbConnect
{

    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT dr.*, v.nom FROM demande_reservation dr INNER JOIN vehicule v ON dr.id_vehicule = v.id_vehicule");
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayOne($id_demande)
    {
        try {
            $this->request = $this->connection->prepare("SELECT dr.*, u.nom, u.prenom, u.email, u.numero_telephone, u.ville, v.nom AS nom_vehicule, v.statut AS statut_vehicule, v.photo FROM demande_reservation dr
                                                        LEFT JOIN utilisateur u ON dr.id_utilisateur = u.id_utilisateur LEFT JOIN vehicule v ON dr.id_vehicule = v.id_vehicule WHERE id_demande_reservation = :id_demande");
            $this->request->bindValue(':id_demande', $id_demande, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayByIdUser($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("SELECT d.*, v.nom, v.photo FROM demande_reservation d INNER JOIN vehicule v ON d.id_vehicule = v.id_vehicule WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayByIdCar($id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM demande_reservation WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function create(Demande_Reservation $demande)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO demande_reservation (message, date_debut, date_fin, montant, statut, date_creation, forfait, id_utilisateur, id_vehicule) 
                VALUES (:message, :date_debut, :date_fin, :montant, :statut, NOW(), :forfait, :id_utilisateur, :id_vehicule)"
            );

            $this->request->bindValue(':message', $demande->getMessage(), PDO::PARAM_STR);
            $this->request->bindValue(':date_debut', $demande->getDate_debut(), PDO::PARAM_STR);
            $this->request->bindValue(':date_fin', $demande->getDate_fin(), PDO::PARAM_STR);
            $this->request->bindValue(':montant', $demande->getMontant(), PDO::PARAM_STR);
            $this->request->bindValue(':statut', $demande->getStatut(), PDO::PARAM_STR);
            $this->request->bindValue(':forfait', $demande->getForfait(), PDO::PARAM_STR);
            $this->request->bindValue(':id_utilisateur', $demande->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $demande->getId_vehicule(), PDO::PARAM_INT);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function update(Demande_Reservation $demande)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE demande_reservation SET 
                message = :message, date_debut = :date_debut, date_fin = :date_fin, 
                montant = :montant, statut = :statut, forfait = :forfait, 
                id_utilisateur = :id_utilisateur, id_vehicule = :id_vehicule 
                WHERE id_demande_reservation = :id_demande"
            );

            $this->request->bindValue(':id_demande', $demande->getId_demande_reservation(), PDO::PARAM_INT);
            $this->request->bindValue(':message', $demande->getMessage(), PDO::PARAM_STR);
            $this->request->bindValue(':date_debut', $demande->getDate_debut(), PDO::PARAM_STR);
            $this->request->bindValue(':date_fin', $demande->getDate_fin(), PDO::PARAM_STR);
            $this->request->bindValue(':montant', $demande->getMontant(), PDO::PARAM_STR);
            $this->request->bindValue(':statut', $demande->getStatut(), PDO::PARAM_STR);
            $this->request->bindValue(':forfait', $demande->getForfait(), PDO::PARAM_STR);
            $this->request->bindValue(':id_utilisateur', $demande->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $demande->getId_vehicule(), PDO::PARAM_INT);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function updateStatut(Demande_Reservation $demande)
    {
        try {
            $this->request = $this->connection->prepare("UPDATE demande_reservation SET statut = :statut WHERE id_demande_reservation = :id_demande");
            $this->request->bindValue(':statut', $demande->getStatut(), PDO::PARAM_STR);
            $this->request->bindValue(':id_demande', $demande->getId_demande_reservation(), PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function deleteByIdUser($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM demande_reservation WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function search($search)
    {
        try {
            $sql ="SELECT d.*, u.id_utilisateur, u.nom AS nom_utilisateur, u.prenom, v.nom
                FROM demande_reservation d 
                LEFT JOIN utilisateur u ON d.id_utilisateur = u.id_utilisateur 
                LEFT JOIN vehicule v ON d.id_vehicule = v.id_vehicule
                WHERE d.message LIKE :search
                OR d.date_debut LIKE :search
                OR d.date_fin LIKE :search
                OR d.montant LIKE :search
                OR d.statut LIKE :search
                OR d.forfait LIKE :search
                OR d.date_creation LIKE :search
                OR u.nom LIKE :search
                OR u.prenom LIKE :search
                OR v.nom LIKE :search";
            $this->request = $this->connection->prepare($sql);
            $this->request->bindValue(':search', "%$search%", PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
