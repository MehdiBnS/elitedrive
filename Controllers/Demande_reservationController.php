<?php

namespace elitedrive\Controllers;

use elitedrive\Entities\Demande_Reservation;
use elitedrive\Models\Demande_ReservationModel;
use elitedrive\Models\UtilisateurModel;
use elitedrive\Models\VehiculeModel;
use elitedrive\Models\MailsModel;


class Demande_reservationController extends Controller
{

    public function createForm()
    {
        if (isset($_SESSION['id_utilisateur']) && !empty($_SESSION['id_utilisateur'])) {
            $id_utilisateur = intval($_SESSION['id_utilisateur']);
            $id_vehicule = filter_input(INPUT_GET, 'id_vehicule', FILTER_VALIDATE_INT);
            if (!$id_vehicule) {
                header('Location: index.php?controller=Vehicule&action=showCar');
                exit();
            }
            if (isset($id_vehicule) && $id_utilisateur) {
                $utilisateurModel = new UtilisateurModel();
                $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
                $vehiculeModel = new VehiculeModel();
                $vehicule = $vehiculeModel->displayOne($id_vehicule);
                if (empty($vehicule)) {
                    header('Location: index.php?controller=Vehicule&action=showCar');
                    exit();
                }
                if (empty($utilisateur)) {
                    header('Location: index.php?controller=Utilisateur&action=connectForm');
                    exit();
                }

                $token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                $this->render('demande/createForm', ['utilisateur' => $utilisateur, 'vehicule' => $vehicule, 'token' => $token]);
            } else {
                header('Location: index.php?controller=Vehicule&action=showCar');
                exit();
            }
        } else {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_utilisateur = intval($_SESSION['id_utilisateur']);
            $id_vehicule = filter_input(INPUT_POST, 'id_vehicule', FILTER_VALIDATE_INT);
            if (!$id_utilisateur) {
                header('Location: index.php?controller=Utilisateur&action=connectForm');
                exit();
            }
            if (!$id_vehicule) {
                header('Location: index.php?controller=Vehicule&action=showCar');
                exit();
            }

            if ($id_utilisateur && $id_vehicule) {
                if ($_SESSION['role'] == 1) {
                    $_SESSION['message'] = 'Conformément aux règles d’EliteDrive, les administrateurs ne peuvent pas envoyer de demandes via ce formulaire.';
                    header('Location: index.php?controller=Demande_reservation&action=createForm&id_vehicule=' . $id_vehicule);
                    exit();
                }

                $message = htmlspecialchars($_POST['message'] ?? '', ENT_NOQUOTES, 'UTF-8');
                $date_debut = $_POST['date_debut'];
                $date_fin = $_POST['date_fin'];
                $forfait = htmlspecialchars($_POST['forfait'], ENT_NOQUOTES, 'UTF-8');
                $quantite = intval($_POST['quantite_forfait']);
                $statut = 'En attente';

                if (!$date_debut || !$date_fin || !$forfait || !$quantite) {
                    echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis.']);
                    exit();
                }
                if ($quantite < 0) {
                    echo json_encode(['success' => false, 'error' => 'La quantité ne peut pas être négative.']);
                    exit();
                }


                $vehiculeModel = new VehiculeModel();
                $vehicule = $vehiculeModel->displayOne($id_vehicule);

                if (!$vehicule) {
                    echo json_encode(['success' => false, 'error' => 'Véhicule introuvable.']);
                    exit();
                }

                $utilisateurModel = new UtilisateurModel();
                $utilisateur = $utilisateurModel->displayOne($id_utilisateur);

                if (!$utilisateur) {
                    echo json_encode(['success' => false, 'error' => 'Utilisateur introuvable.']);
                    exit();
                }

                switch ($forfait) {
                    case 'KM':
                        $prix_unitaire = floatval($vehicule->prix_km);
                        if ($quantite > 10000) {
                            echo json_encode(['success' => false, 'error' => 'Le nombre de kilomètres ne peut pas dépasser 10 000.']);
                            exit();
                        }
                        break;

                    case 'Jour':
                        $prix_unitaire = floatval($vehicule->prix_jour);
                        if ($quantite > 6) {
                            echo json_encode(['success' => false, 'error' => 'Le nombre de jours ne peut pas dépasser 6 pour un forfait journalier.']);
                            exit();
                        }
                        break;

                    case 'Semaine':
                        $prix_unitaire = floatval($vehicule->prix_semaine);
                        if ($quantite > 3) {
                            echo json_encode(['success' => false, 'error' => 'Le nombre de semaines ne peut pas dépasser 3 pour un forfait hebdomadaire.']);
                            exit();
                        }
                        break;

                    case 'Mois':
                        $prix_unitaire = floatval($vehicule->prix_mois);
                        if ($quantite > 6) {
                            echo json_encode(['success' => false, 'error' => 'Le nombre de mois ne peut pas dépasser 6 pour un forfait mensuel.']);
                            exit();
                        }
                        break;

                    default:
                        echo json_encode(['success' => false, 'error' => 'Type de forfait invalide.']);
                        exit();
                }

                $montant = $prix_unitaire * $quantite;
                if ($montant < 0) {
                    echo json_encode(['success' => false, 'error' => 'Le montant ne peut pas être négatif.']);
                    exit();
                }
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'error' => 'Token CSRF invalide.']);
                    exit();
                }
                
                $demande = new Demande_Reservation();
                $demande->setMessage($message);
                $demande->setDate_debut($date_debut);
                $demande->setDate_fin($date_fin);
                $demande->setMontant($montant);
                $demande->setForfait($forfait);
                $demande->setStatut($statut);
                $demande->setId_utilisateur($id_utilisateur);
                $demande->setId_vehicule($id_vehicule);
                $demandeModel = new Demande_ReservationModel();


                if ($demandeModel->create($demande)) {
                    $mailModel = new MailsModel();
                    $nom = $utilisateur->nom;
                    $prenom = $utilisateur->prenom;
                    $email = $utilisateur->email;
                    $tel = $utilisateur->numero_telephone;
                    $modele = $vehicule->modele;
                    $marque = $vehicule->marque;

                    $subject = "Confirmation de votre demande de réservation - EliteDrive";
                    $body = file_get_contents(__DIR__ . '/../Views/mails/demandeReservation.php');

                    $body = str_replace(
                        ['{{nom}}', '{{prenom}}', '{{tel}}', '{{message}}', '{{date_debut}}', '{{date_fin}}', '{{forfait}}', '{{quantite}}', '{{montant}}', '{{modele}}', '{{marque}}'],
                        [$nom, $prenom, $tel, nl2br($message), htmlspecialchars($date_debut), htmlspecialchars($date_fin), $forfait, $quantite, $montant, htmlspecialchars($modele), htmlspecialchars($marque)],
                        $body
                    );

                    $to = $email;
                    $mailModel->sendMail($to, $subject, $body);

                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    echo json_encode(['success' => false, 'error' => 'Échec de la création de la demande.']);
                }
                exit();
            } else {
                header('Location: index.php?controller=Vehicule&action=showVehicule');
                exit();
            }
        }
    }
}
