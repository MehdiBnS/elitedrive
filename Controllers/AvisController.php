<?php

namespace elitedrive\Controllers;

use elitedrive\Models\AvisModel;
use elitedrive\Entities\Avis;

class AvisController extends Controller
{
    public function create()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 0) {
            $inputData = json_decode(file_get_contents('php://input'), true);

            if (!$inputData) {
                echo json_encode(['success' => false, 'message' => 'Données invalides']);
                return;
            }

            if (!isset($_GET['id_vehicule'])) {
                echo json_encode(['success' => false, 'message' => 'ID véhicule introuvable.']);
                return;
            }

            $id_utilisateur = $_SESSION['id_utilisateur'];
            $nom = $_SESSION['nom'];
            $prenom = $_SESSION['prenom'];
            $id_vehicule = $_GET['id_vehicule'];
            $note = (int) $inputData['rate'];
            $commentaire = $inputData['comment'] ?? null;

            if (empty($note) || !is_numeric($note) || $note < 1 || $note > 5) {
                echo json_encode(['success' => false, 'message' => 'Note invalide.']);
                return;
            }

            $avis = new Avis();
            $avis->setId_utilisateur($id_utilisateur);
            $avis->setId_vehicule($id_vehicule);
            $avis->setNote($note);
            $avis->setCommentaire($commentaire);

            $avisModel = new AvisModel();
            if ($avisModel->create($avis)) {
                $avisList = $avisModel->displayByIdCar($id_vehicule);
                $response = [
                    'success' => true,
                    'message' => 'Avis ajouté avec succès.',
                    'avis' => $avisList,
                    'nom_utilisateur' => htmlspecialchars($nom),
                    'prenom_utilisateur' => htmlspecialchars($prenom),
                    'commentaire' => nl2br(htmlspecialchars($commentaire)),
                    'note' => htmlspecialchars($note)
                ];
                echo json_encode($response);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'avis.']);
            }
        } else {
            echo json_encode(['success' => false, 'redirect' => 'index.php?controller=Utilisateur&action=connectForm']);
        }
    }


    public function delete()
    {
        if (isset($_SESSION['id_utilisateur']) && ($_SESSION['role'] == 0 || $_SESSION['role'] == 1)) {
            if (isset($_POST['id_utilisateur'])) {
                $id_utilisateur = $_POST['id_utilisateur'];
                $id_avis = $_POST['id_avis'];
                $avisModel = new AvisModel();
                if ($avisModel->deleteByIdUser($id_utilisateur, $id_avis)) {
                    $response = ['status' => 'success', 'message' => 'Avis supprimé.'];
                    echo json_encode($response);
                } else {
                    $response = ['status' => 'error', 'message' => 'Erreur lors de la suppression.'];
                    echo json_encode($response);
                }
            } elseif (isset($_POST['id_avis'])) {
                $id_avis = $_POST['id_avis'];
                $avisModel = new AvisModel();
                if ($avisModel->delete($id_avis)) {
                    $response = ['status' => 'success', 'message' => 'Avis supprimé avec succès.'];
                    echo json_encode($response);
                } else {
                    $response = ['status' => 'error', 'message' => 'Erreur lors de la suppression.'];
                    echo json_encode($response);
                }
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Vous devez être connecté pour supprimer un avis.'];
            echo json_encode($response);
        }
    }



    public function update()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 0) {

            if (!isset($_GET['id_avis']) || !isset($_GET['id_utilisateur']) || !isset($_GET['id_vehicule'])) {
                $_SESSION['error_message'] = "Informations manquantes pour la modification de l'avis.";
                header('Location: index.php?controller=Vehicule&action=showVehicule');
                exit();
            } else {
                $id_utilisateur = $_SESSION['id_utilisateur'];
                $id_vehicule = $_GET['id_vehicule'];
                $id_avis = $_GET['id_avis'];

                if ($id_utilisateur != $_SESSION['id_utilisateur']) {
                    echo "Ce n'est pas votre avis, vous ne pouvez pas le modifier.";
                    //ajax
                } else {
                    $note = $_POST['rate'];
                    $commentaire = $_POST['comment'] ?? null;

                    if (empty($note) || !is_numeric($note) || $note < 1 || $note > 5) {
                        $_SESSION['message'] = "La note est obligatoire et doit être un nombre entre 1 et 5.";
                        //ajax
                    }

                    $avis = new Avis();
                    $avis->setId_avis($id_avis);
                    $avis->setId_utilisateur($id_utilisateur);
                    $avis->setId_vehicule($id_vehicule);
                    $avis->setNote($note);
                    $avis->setCommentaire($commentaire);

                    // Créer une instance du modèle AvisModel
                    $avisModel = new AvisModel();


                    if ($avisModel->update($avis)) {
                        // Si la mise à jour réussit, rediriger l'utilisateur avec un message de succès
                        $_SESSION['message'] = "Votre avis a été mis à jour avec succès.";
                        //ajax

                    } else {
                        // Si la mise à jour échoue, afficher un message d'erreur
                        $_SESSION['message'] = "Une erreur est survenue lors de la mise à jour de votre avis.";
                        //ajax
                    }
                }
            }
        } else {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }
    }
}
