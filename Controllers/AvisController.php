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

            if (!isset($inputData['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $inputData['csrf_token'])) {
                echo json_encode(['success' => false, 'error' => 'Token CSRF invalide.']);
                exit();
            }

            if (!$inputData) {
                echo json_encode(['success' => false, 'message' => 'Données invalides.']);
                return;
            }

            if (!isset($_GET['id_vehicule'])) {
                echo json_encode(['success' => false, 'message' => 'ID véhicule introuvable.']);
                return;
            }

            $id_utilisateur = (int) $_SESSION['id_utilisateur'];
            $nom = htmlspecialchars($_SESSION['nom']);
            $prenom = htmlspecialchars($_SESSION['prenom']);
            $id_vehicule = filter_var($_GET['id_vehicule'], FILTER_VALIDATE_INT);
            $note = filter_var($inputData['rate'], FILTER_VALIDATE_INT);
            $commentaire = htmlspecialchars(trim($inputData['comment'] ?? ''), ENT_NOQUOTES, 'UTF-8');

            if (!$id_vehicule || !$note || $note < 1 || $note > 5 || empty($commentaire)) {
                echo json_encode(['success' => false, 'message' => 'Note ou commentaire invalide.']);
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
                echo json_encode([
                    'success' => true,
                    'message' => 'Avis ajouté avec succès.',
                    'avis' => $avisList,
                    'nom_utilisateur' => $nom,
                    'prenom_utilisateur' => $prenom,
                    'commentaire' => nl2br(htmlspecialchars($commentaire)),
                    'note' => $note
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'avis.']);
            }
        } else {
            echo json_encode(['success' => false, 'redirect' => 'index.php?controller=Utilisateur&action=connectForm']);
        }
    }
    public function delete()
    {
        if (isset($_SESSION['id_utilisateur']) && in_array($_SESSION['role'], [0, 1])) {
            $id_avis = filter_input(INPUT_POST, 'id_avis', FILTER_VALIDATE_INT);
            $id_utilisateur = filter_input(INPUT_POST, 'id_utilisateur', FILTER_VALIDATE_INT);


            if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                echo json_encode(['success' => false, 'error' => 'Token CSRF invalide.']);
                exit();
            }

            if (!$id_avis) {
                echo json_encode(['status' => 'error', 'message' => 'ID avis manquant ou invalide.']);
                return;
            }

            $avisModel = new AvisModel();
            $result = false;

            if ($id_utilisateur) {
                $result = $avisModel->deleteByIdUser($id_utilisateur, $id_avis);
            } else {
                $result = $avisModel->delete($id_avis);
            }

            echo json_encode([
                'status' => $result ? 'success' : 'error',
                'message' => $result ? 'Avis supprimé.' : 'Erreur lors de la suppression.'
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Vous devez être connecté pour supprimer un avis.']);
        }
    }
    public function update()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 0) {
            $id_vehicule = filter_input(INPUT_GET, 'id_vehicule', FILTER_VALIDATE_INT);
            $id_avis = filter_input(INPUT_GET, 'id_avis', FILTER_VALIDATE_INT);


            if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                echo json_encode(['success' => false, 'error' => 'Token CSRF invalide.']);
                exit();
            }

            if (!$id_vehicule || !$id_avis) {
                $_SESSION['error_message'] = "Informations manquantes pour la modification de l'avis.";
                header('Location: index.php?controller=Vehicule&action=showVehicule');
                exit();
            }

            $note = filter_input(INPUT_POST, 'rate', FILTER_VALIDATE_INT);
            $commentaire = htmlspecialchars(trim($_POST['comment'] ?? ''), ENT_NOQUOTES, 'UTF-8');

            if (!$note || $note < 1 || $note > 5 || empty($commentaire)) {
                $_SESSION['message'] = "La note est obligatoire et doit être entre 1 et 5. Le commentaire ne peut pas être vide.";
                header('Location: index.php?controller=Vehicule&action=showVehicule&id=' . $id_vehicule);
                exit();
            }

            $avis = new Avis();
            $avis->setId_avis($id_avis);
            $avis->setId_utilisateur((int) $_SESSION['id_utilisateur']);
            $avis->setId_vehicule($id_vehicule);
            $avis->setNote($note);
            $avis->setCommentaire($commentaire);

            $avisModel = new AvisModel();

            if ($avisModel->update($avis)) {
                $_SESSION['message'] = "Votre avis a été mis à jour avec succès.";
            } else {
                $_SESSION['message'] = "Une erreur est survenue lors de la mise à jour.";
            }

            header('Location: index.php?controller=Vehicule&action=showVehicule&id=' . $id_vehicule);
            exit();
        } else {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }
    }
}
