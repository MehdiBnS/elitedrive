<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Reservation;

class ReservationModel extends DbConnect
{
    // Afficher toutes les réservations avec les informations des utilisateurs et des véhicules
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query(
                "SELECT r.*, u.nom, u.prenom, u.email, u.ville, u.numero_telephone, 
                 v.nom AS vehicule_nom, v.annee, v.description, v.statut,
                  m.nom AS modele_nom, ma.nom AS marque_nom, ca.nom AS categorie_nom
                FROM reservation r
            INNER JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur 
            INNER JOIN vehicule v ON r.id_vehicule = v.id_vehicule
            INNER JOIN modele m ON v.id_modele = m.id_modele
        INNER JOIN marque ma ON v.id_marque = ma.id_marque 
        INNER JOIN categorie ca ON v.id_categorie = ca.id_categorie
            "
            );
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayByIdUser($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("SELECT r.*, v.nom, v.photo FROM reservation r INNER JOIN vehicule v ON r.id_vehicule = v.id_vehicule WHERE id_utilisateur = :id_utilisateur");
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
            $this->request = $this->connection->prepare("SELECT * FROM reservation WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }


    public function updateEndDate($id_vehicule, $id_reservation) {
        try {
            $this->request = $this->connection->prepare("UPDATE reservation SET date_fin = NOW() WHERE id_vehicule = :id_vehicule AND id_reservation = :id_reservation");
            $this->request->bindValue(':id_reservation', $id_reservation, PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function create(Reservation $reservation)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO reservation (date_creation, id_utilisateur, id_vehicule, montant, date_debut, date_fin, forfait) 
                 VALUES (NOW(), :id_utilisateur, :id_vehicule, :montant, :date_debut, :date_fin, :forfait)"
            );

            $this->request->bindValue(':id_utilisateur', $reservation->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':id_vehicule', $reservation->getId_vehicule(), PDO::PARAM_INT);
            $this->request->bindValue(':montant', $reservation->getMontant(), PDO::PARAM_STR);
            $this->request->bindValue(':date_debut', $reservation->getDate_debut(), PDO::PARAM_STR);
            $this->request->bindValue(':date_fin', $reservation->getDate_fin(), PDO::PARAM_STR);
            $this->request->bindValue(':forfait', $reservation->getForfait(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function search($search)
    {
        try {
            $this->request = $this->connection->prepare(
                "SELECT r.*, u.nom, u.prenom, u.email, u.ville, u.numero_telephone, 
                        v.nom AS vehicule_nom, v.annee, v.description, v.statut
                 FROM reservation r
                 INNER JOIN utilisateur u ON r.id_utilisateur = u.id_utilisateur
                 INNER JOIN vehicule v ON r.id_vehicule = v.id_vehicule
                 WHERE u.nom LIKE :search 
                 OR v.nom LIKE :search
                 OR u.prenom LIKE :search
                 OR u.email LIKE :search
                 OR u.ville LIKE :search
                 OR u.numero_telephone LIKE :search
                 OR r.date_debut LIKE :search
                 OR r.date_fin LIKE :search
                 OR r.montant LIKE :search
                 OR r.forfait LIKE :search"
            );
            $this->request->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
