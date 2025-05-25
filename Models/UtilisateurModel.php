<?php

namespace elitedrive\Models;

use Exception;
use PDO;
use elitedrive\Core\DbConnect;
use elitedrive\Entities\Utilisateur;

class UtilisateurModel extends DbConnect
{
    public function displayAll()
    {
        try {
            $this->request = $this->connection->query("SELECT * FROM utilisateur");
            return $this->request->fetchAll();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function displayOne($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $this->request->execute();
            return $this->request->fetch();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    
    public function create(Utilisateur $utilisateur)
    {
        try {
            $this->request = $this->connection->prepare(
                "INSERT INTO utilisateur (nom, prenom, mot_de_passe, numero_telephone, ville, role, date_creation, email)
                VALUES (:nom, :prenom, :mot_de_passe, :numero_telephone, :ville, :role, NOW(), :email)"
            );

            $this->request->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(':mot_de_passe', $utilisateur->getMot_de_passe(), PDO::PARAM_STR);
            $this->request->bindValue(':numero_telephone', $utilisateur->getNumero_telephone(), PDO::PARAM_STR);
            $this->request->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $this->request->bindValue(':role', $utilisateur->getRole(), PDO::PARAM_STR);
            $this->request->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function checkEmailExists($email)
    {
        try {
            $this->request = $this->connection->prepare("SELECT COUNT(*) FROM utilisateur WHERE email = :email");
            $this->request->bindParam(':email', $email);
            $this->request->execute();
            $count = $this->request->fetchColumn();
            return $count > 0;
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function connect($email, $mot_de_passe)
    {
        try {
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $this->request->bindValue(':email', $email, PDO::PARAM_STR);
            $this->request->execute();
            $utilisateurData = $this->request->fetch();

            if ($utilisateurData && password_verify($mot_de_passe, $utilisateurData->mot_de_passe)) {
                return $utilisateurData;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }


    public function update(Utilisateur $utilisateur)
    {
        try {
            $this->request = $this->connection->prepare(
                "UPDATE utilisateur SET 
                nom = :nom, prenom = :prenom, numero_telephone = :numero_telephone, 
                ville = :ville, role = :role, email = :email
                WHERE id_utilisateur = :id_utilisateur"
            );

            $this->request->bindValue(':id_utilisateur', $utilisateur->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(':nom', $utilisateur->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(':prenom', $utilisateur->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(':numero_telephone', $utilisateur->getNumero_telephone(), PDO::PARAM_STR);
            $this->request->bindValue(':ville', $utilisateur->getVille(), PDO::PARAM_STR);
            $this->request->bindValue(':role', $utilisateur->getRole(), PDO::PARAM_INT);
            $this->request->bindValue(':email', $utilisateur->getEmail(), PDO::PARAM_STR);

            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function updatePassword($id_utilisateur, $mot_de_passe_hash)
    {
        try {

            $this->request = $this->connection->prepare("UPDATE utilisateur SET mot_de_passe = :mot_de_passe_hash WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(':mot_de_passe_hash', $mot_de_passe_hash, PDO::PARAM_STR);
            $this->request->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function delete($id_utilisateur)
    {
        try {
            $this->request = $this->connection->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(":id_utilisateur", $id_utilisateur, PDO::PARAM_INT);
            return $this->request->execute();
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function search($searchUser)
    {
        try {
            if (empty($searchUser)) {
            }
            $this->request = $this->connection->prepare("SELECT * FROM utilisateur WHERE nom LIKE :searchUser
                                                         OR prenom LIKE :searchUser
                                                         OR email LIKE :searchUser
                                                         OR numero_telephone LIKE :searchUser
                                                         OR ville LIKE :searchUser
                                                         OR role LIKE :searchUser
                                                         OR date_creation LIKE :searchUser");
            $this->request->bindValue(':searchUser', '%' . $searchUser . '%', PDO::PARAM_STR);
            $this->request->execute();
            return $this->request->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function getLastInsertId() {
    return $this->connection->lastInsertId(); 
}
}
