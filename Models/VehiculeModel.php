<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Vehicule;

class VehiculeModel extends DbConnect
{
    // Afficher tous les véhicules
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM vehicule");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Afficher un véhicule par son ID
    public function displayOne($id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("SELECT v.*, m.nom AS modele, ma.nom AS marque, c.type AS carburant, t.type AS transmission, p.nombre AS places, co.nom AS couleur, ca.nom AS categorie 
                    FROM vehicule v
                    LEFT JOIN modele m ON v.id_modele = m.id_modele
                    LEFT JOIN marque ma ON v.id_marque = ma.id_marque
                    LEFT JOIN carburant c ON v.id_carburant = c.id_carburant
                    LEFT JOIN transmission t ON v.id_transmission = t.id_transmission
                    LEFT JOIN places p ON v.id_places = p.id_places
                    LEFT JOIN couleur co ON v.id_couleur = co.id_couleur
                    LEFT JOIN categorie ca ON v.id_categorie = ca.id_categorie
                    WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayNew()
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM vehicule ORDER BY date_creation DESC");
            $this->request->execute();
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayAsc()
    {
        try {
            // Requête pour afficher les véhicules triés par prix croissant
            $this->request = $this->connection->prepare("SELECT * FROM vehicule ORDER BY prix_km ASC");
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function displayDesc()
{
    try {
        // Requête pour afficher les véhicules triés par prix décroissant
        $this->request = $this->connection->prepare("SELECT * FROM vehicule ORDER BY prix_km DESC");
        $this->request->execute();
        return $this->request->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}

    public function displayByCategory($id_categorie)
    {
        try {
            $this->request = $this->connection->prepare("SELECT v.*, 
                                                 ca.id_categorie AS categorie_id, 
                                                 ca.nom AS categorie_nom, 
                                                 ca.photo AS categorie_photo, 
                                                 ca.description AS categorie_description,
                                                 ca.date_creation AS categorie_date_creation
                                               FROM vehicule v
                                               INNER JOIN categorie ca ON v.id_categorie = ca.id_categorie
                                               WHERE v.id_categorie = :id_categorie");

            $this->request->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $this->request->execute();

            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Créer un nouveau véhicule
    public function create(Vehicule $vehicule)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO vehicule (nom, id_modele, id_marque, prix_km, prix_jour, prix_semaine, prix_mois, annee, 
                id_carburant, id_transmission, id_places, id_couleur, description, statut, date_creation, photo, id_categorie)
                VALUES (:nom, :id_modele, :id_marque, :prix_km, :prix_jour, :prix_semaine, :prix_mois, :annee, 
                :id_carburant, :id_transmission, :id_places, :id_couleur, :description, :statut, NOW(), :photo, :id_categorie)"
            );

            $this->request->bindValue(':nom', $vehicule->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':id_modele', $vehicule->getId_modele(), PDO::PARAM_INT);
            $this->request->bindValue(':id_marque', $vehicule->getId_marque(), PDO::PARAM_INT);
            $this->request->bindValue(':prix_km', $vehicule->getPrix_km(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_jour', $vehicule->getPrix_jour(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_semaine', $vehicule->getPrix_semaine(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_mois', $vehicule->getPrix_mois(), PDO::PARAM_STR);
            $this->request->bindValue(':annee', $vehicule->getAnnee(), PDO::PARAM_INT);
            $this->request->bindValue(':id_carburant', $vehicule->getId_carburant(), PDO::PARAM_INT);
            $this->request->bindValue(':id_transmission', $vehicule->getId_transmission(), PDO::PARAM_INT);
            $this->request->bindValue(':id_places', $vehicule->getId_places(), PDO::PARAM_INT);
            $this->request->bindValue(':id_couleur', $vehicule->getId_couleur(), PDO::PARAM_INT);
            $this->request->bindValue(':description', $vehicule->getDescription(), PDO::PARAM_STR);
            $this->request->bindValue(':statut', $vehicule->getStatut(), PDO::PARAM_STR);
            $this->request->bindValue(':photo', $vehicule->getPhoto(), PDO::PARAM_STR);
            $this->request->bindValue(':id_categorie', $vehicule->getId_categorie(), PDO::PARAM_INT);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Mettre à jour un véhicule
    public function update(Vehicule $vehicule)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE vehicule SET 
                nom = :nom, id_modele = :id_modele, id_marque = :id_marque, prix_km = :prix_km, prix_jour = :prix_jour, 
                prix_semaine = :prix_semaine, prix_mois = :prix_mois, annee = :annee, id_carburant = :id_carburant, 
                id_transmission = :id_transmission, id_places = :id_places, id_couleur = :id_couleur, description = :description, 
                statut = :statut, photo = :photo,  id_categorie = :id_categorie 
                WHERE id_vehicule = :id_vehicule"
            );

            $this->request->bindValue(':id_vehicule', $vehicule->getId_vehicule(), PDO::PARAM_INT);
            $this->request->bindValue(':nom', $vehicule->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':id_modele', $vehicule->getId_modele(), PDO::PARAM_INT);
            $this->request->bindValue(':id_marque', $vehicule->getId_marque(), PDO::PARAM_INT);
            $this->request->bindValue(':prix_km', $vehicule->getPrix_km(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_jour', $vehicule->getPrix_jour(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_semaine', $vehicule->getPrix_semaine(), PDO::PARAM_STR);
            $this->request->bindValue(':prix_mois', $vehicule->getPrix_mois(), PDO::PARAM_STR);
            $this->request->bindValue(':annee', $vehicule->getAnnee(), PDO::PARAM_INT);
            $this->request->bindValue(':id_carburant', $vehicule->getId_carburant(), PDO::PARAM_INT);
            $this->request->bindValue(':id_transmission', $vehicule->getId_transmission(), PDO::PARAM_INT);
            $this->request->bindValue(':id_places', $vehicule->getId_places(), PDO::PARAM_INT);
            $this->request->bindValue(':id_couleur', $vehicule->getId_couleur(), PDO::PARAM_INT);
            $this->request->bindValue(':description', $vehicule->getDescription(), PDO::PARAM_STR);
            $this->request->bindValue(':statut', $vehicule->getStatut(), PDO::PARAM_STR);
            $this->request->bindValue(':photo', $vehicule->getPhoto(), PDO::PARAM_STR);
            $this->request->bindValue(':id_categorie', $vehicule->getId_categorie(), PDO::PARAM_INT);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function updateStatut($statut, $id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("UPDATE vehicule SET statut = :statut WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(':statut', $statut, PDO::PARAM_STR);
            $this->request->bindValue(':id_vehicule', $id_vehicule, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    // Supprimer un véhicule
    public function delete($id_vehicule)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM vehicule WHERE id_vehicule = :id_vehicule");
            $this->request->bindValue(":id_vehicule", $id_vehicule, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function search(
        $searchCar = '',
        $filterModele = [],
        $filterMarque = [],
        $filterCarburant = [],
        $filterCategorie = [],
        $filterTransmission = [],
        $filterPlaces = [],
        $filterCouleur = []
    ) {
        try {
            $sql = "SELECT v.*, m.nom AS modele, ma.nom AS marque, c.type AS carburant, t.type AS transmission,
                           p.nombre AS places, co.nom AS couleur, ca.nom AS categorie 
                    FROM vehicule v
                    INNER JOIN modele m ON v.id_modele = m.id_modele
                    INNER JOIN marque ma ON v.id_marque = ma.id_marque
                    INNER JOIN carburant c ON v.id_carburant = c.id_carburant
                    INNER JOIN transmission t ON v.id_transmission = t.id_transmission
                    INNER JOIN places p ON v.id_places = p.id_places
                    INNER JOIN couleur co ON v.id_couleur = co.id_couleur
                    INNER JOIN categorie ca ON v.id_categorie = ca.id_categorie
                    WHERE 1=1";

            $params = [];

            if (!empty($searchCar)) {
                $sql .= " AND v.nom LIKE ?";
                $params[] = "%" . $searchCar . "%";
            }

            if (!empty($filterModele)) {
                $placeholders = implode(',', array_fill(0, count($filterModele), '?'));
                $sql .= " AND v.id_modele IN ($placeholders)";
                $params = array_merge($params, $filterModele);
            }

            if (!empty($filterMarque)) {
                $placeholders = implode(',', array_fill(0, count($filterMarque), '?'));
                $sql .= " AND v.id_marque IN ($placeholders)";
                $params = array_merge($params, $filterMarque);
            }

            if (!empty($filterCarburant)) {
                $placeholders = implode(',', array_fill(0, count($filterCarburant), '?'));
                $sql .= " AND v.id_carburant IN ($placeholders)";
                $params = array_merge($params, $filterCarburant);
            }

            if (!empty($filterCategorie)) {
                $placeholders = implode(',', array_fill(0, count($filterCategorie), '?'));
                $sql .= " AND v.id_categorie IN ($placeholders)";
                $params = array_merge($params, $filterCategorie);
            }

            if (!empty($filterTransmission)) {
                $placeholders = implode(',', array_fill(0, count($filterTransmission), '?'));
                $sql .= " AND v.id_transmission IN ($placeholders)";
                $params = array_merge($params, $filterTransmission);
            }

            if (!empty($filterPlaces)) {
                $placeholders = implode(',', array_fill(0, count($filterPlaces), '?'));
                $sql .= " AND v.id_places IN ($placeholders)";
                $params = array_merge($params, $filterPlaces);
            }

            if (!empty($filterCouleur)) {
                $placeholders = implode(',', array_fill(0, count($filterCouleur), '?'));
                $sql .= " AND v.id_couleur IN ($placeholders)";
                $params = array_merge($params, $filterCouleur);
            }

            $this->request = $this->connection->prepare($sql);
            $this->request->execute($params);

            return $this->request->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }


    public function displayOptions()
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM modele");
            $this->request->execute();
            $modeles = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM marque");
            $this->request->execute();
            $marques = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM carburant");
            $this->request->execute();
            $carburants = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM transmission");
            $this->request->execute();
            $transmissions = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM places");
            $this->request->execute();
            $places = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM couleur");
            $this->request->execute();
            $couleurs = $this->request->fetchAll(PDO::FETCH_ASSOC);
            $this->request = $this->connection->prepare("SELECT * FROM categorie");
            $this->request->execute();
            $categories = $this->request->fetchAll(PDO::FETCH_ASSOC);

            return [
                'modeles' => $modeles,
                'marques' => $marques,
                'carburants' => $carburants,
                'transmissions' => $transmissions,
                'places' => $places,
                'couleurs' => $couleurs,
                'categories' => $categories
            ];
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
}
