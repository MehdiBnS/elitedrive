<?php

namespace elitedrive\Controllers;

use elitedrive\Models\VehiculeModel;
use elitedrive\Entities\Vehicule;
use elitedrive\Models\ModeleModel;
use elitedrive\Entities\Modele;
use elitedrive\Models\MarqueModel;
use elitedrive\Entities\Marque;
use elitedrive\Models\CarburantModel;
use elitedrive\Entities\Carburant;
use elitedrive\Models\TransmissionModel;
use elitedrive\Entities\Transmission;
use elitedrive\Models\PlacesModel;
use elitedrive\Entities\Places;
use elitedrive\Models\CouleurModel;
use elitedrive\Entities\Couleur;
use elitedrive\Models\CategorieModel;
use elitedrive\Models\UtilisateurModel;
use elitedrive\Models\ArchiveModel;
use elitedrive\Models\Demande_ReservationModel;
use elitedrive\Entities\Demande_Reservation;
use elitedrive\Models\ReservationModel;
use elitedrive\Entities\Reservation;
use elitedrive\Entities\Archive;
use elitedrive\Models\AvisModel;
use elitedrive\Entities\Utilisateur;
use elitedrive\Entities\Categorie;
use elitedrive\Models\MailsModel;

class AdminController extends Controller
{


    ///////////////////////////////////////////////////BACKOFFICE/////////////////////////////////////////////////////
    public function backOffice()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {

            $_SESSION['csrf_token'] = bin2hex(random_bytes(64));
            $id_utilisateur = $_SESSION['id_utilisateur'];
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
            $this->render('admin/backOffice', ['utilisateur' => $utilisateur]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    ///////////////////////////////////////////////////BACKOFFICE/////////////////////////////////////////////////////












    ///////////////////////////////////////////////////UTILISATEUR/////////////////////////////////////////////////////


    public function orderUsers()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $utilisateurModel = new UtilisateurModel();


            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $utilisateurs = !empty($search)
                ? $utilisateurModel->search($search)
                : $utilisateurModel->displayAll();

            if (empty($utilisateurs)) {
                $_SESSION['message'] = "Aucun utilisateur trouvé.";
            }
            $this->render('admin/orderUsers', ['utilisateurs' => $utilisateurs, 'search' => $search]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function orderUserOne()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_utilisateur']) && !empty($_GET['id_utilisateur'])) {
                $id_utilisateur = $_GET['id_utilisateur'];
                $utilisateurModel = new UtilisateurModel();
                $utilisateur = $utilisateurModel->displayOne($id_utilisateur);

                if ($utilisateur) {
                    $this->render('admin/orderUserOne', ['utilisateur' => $utilisateur]);
                } else {
                    $_SESSION['message'] = "Utilisateur introuvable.";
                    header('Location: index.php?controller=Admin&action=orderUsers');
                    exit();
                }
            } else {
                $_SESSION['message'] = "ID de l'utilisateur manquant.";
                header('Location: index.php?controller=Admin&action=orderUsers');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function createUser()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $mot_de_passe = trim($_POST['password']);
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $numero_telephone = htmlspecialchars(trim($_POST['tel']));
                $ville = htmlspecialchars(trim($_POST['ville']));
                $role = (int) $_POST['role'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(['success' => false, 'message' => 'Email invalide.<br>']);
                    exit();
                }
                if (!preg_match('/^[0-9]{10}$/', $numero_telephone)) {
                    echo json_encode(['success' => false, 'message' => 'Numéro de téléphone invalide.<br>']);
                    exit();
                }

                if (strlen($mot_de_passe) < 8) {
                    echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins 8 caractères.<br>']);
                    exit();
                }

                if (!preg_match('/[A-Z]/', $mot_de_passe) || !preg_match('/[a-z]/', $mot_de_passe)) {
                    echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir une majuscule et une minuscule.<br>']);
                    exit();
                }
                if (!preg_match('/\d/', $mot_de_passe)) {
                    echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un chiffre !<br>']);
                    exit();
                }
                if (!preg_match('/[@$!%*?&]/', $mot_de_passe)) {
                    echo json_encode(['success' => false, 'message' => 'Le mot de passe doit contenir au moins un symbole spécial (@$!%*?&) !<br>']);
                    exit();
                }
                if (empty($nom) || empty($prenom) || empty($mot_de_passe) || empty($email) || empty($numero_telephone) || empty($ville)) {
                    echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.<br>']);
                    exit();
                }



                $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

                $utilisateur = new Utilisateur();
                $utilisateur->setNom($nom);
                $utilisateur->setPrenom($prenom);
                $utilisateur->setEmail($email);
                $utilisateur->setMot_de_passe($mot_de_passe_hash);
                $utilisateur->setNumero_telephone($numero_telephone);
                $utilisateur->setVille($ville);
                $utilisateur->setRole($role);
                $utilisateurModel = new UtilisateurModel();
                if ($utilisateurModel->create($utilisateur)) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Utilisateur ajouté avec succès.'
                    ]);
                    exit();
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Erreur lors de l\'ajout de l\'utilisateur.'
                    ]);
                    exit();
                }
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Accès refusé.'
            ]);
            exit();
        }
    }

    public function updateUser()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_utilisateur = (int) $_POST['id_utilisateur'];
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $numero_telephone = $_POST['numero_telephone'];
                $ville = $_POST['ville'];
                $role = $_POST['role'];

                $utilisateurModel = new UtilisateurModel();
                $testMail = $utilisateurModel->displayOne($id_utilisateur);

                if ($email !== $testMail->email && $utilisateurModel->checkEmailExists($email)) {
                    $_SESSION['message'] = "L'email est déjà utilisé par un autre utilisateur.";
                    header('Location: index.php?controller=Admin&action=orderUsers');
                    exit();
                }
                $utilisateur = new Utilisateur();
                $utilisateur->setId_utilisateur($id_utilisateur);
                $utilisateur->setNom($nom);
                $utilisateur->setPrenom($prenom);
                $utilisateur->setEmail($email);
                $utilisateur->setNumero_telephone($numero_telephone);
                $utilisateur->setVille($ville);
                $utilisateur->setRole($role);

                $utilisateurModel = new UtilisateurModel();
                $updateSuccess = $utilisateurModel->update($utilisateur);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Utilisateur mis à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderUsers');
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteUser()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_utilisateur']) && !empty($_GET['id_utilisateur'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_utilisateur = $_GET['id_utilisateur'];
                $utilisateurModel = new UtilisateurModel();

                $demandeModel = new Demande_ReservationModel();
                $demandeModel->deleteByIdUser($id_utilisateur);

                if ($utilisateurModel->delete($id_utilisateur)) {
                    $_SESSION['message'] = "Utilisateur supprimé avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression.";
                }
            } else {
                $_SESSION['message'] = "ID utilisateur non fourni.";
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
        }
        header('Location: index.php?controller=Admin&action=orderUsers');
        exit();
    }



    ///////////////////////////////////////////////////UTILISATEUR/////////////////////////////////////////////////////








    ///////////////////////////////////////////////////VEHICULES/////////////////////////////////////////////////////


    public function orderCars()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $vehiculeModel = new VehiculeModel();

            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $vehicules = !empty($search)
                ? $vehiculeModel->searchVehicule($search)
                : $vehiculeModel->displayAll();

            $options = $vehiculeModel->displayOptions();

            $this->render('admin/orderCars', [
                'vehicules' => $vehicules,
                'options' => $options,
                'search' => $search
            ]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }




    public function orderCarOne()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_vehicule']) && !empty($_GET['id_vehicule'])) {
                $id_vehicule = $_GET['id_vehicule'];
                $vehiculeModel = new VehiculeModel();
                $vehicule = $vehiculeModel->displayOne($id_vehicule);
                $options = $vehiculeModel->displayOptions();

                if ($vehicule && $options) {
                    $this->render('admin/orderCarOne', ['vehicule' => $vehicule, 'options' => $options]);
                } else {
                    $_SESSION['message'] = "Véhicule introuvable.";
                    header('Location: index.php?controller=Admin&action=orderCars');
                    exit();
                }
            } else {
                $_SESSION['message'] = "ID du véhicule manquant.";
                header('Location: index.php?controller=Admin&action=orderCars');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }
    public function createCar()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars(trim($_POST['nom']));
                $prix_km = filter_var($_POST['prix_km'], FILTER_VALIDATE_FLOAT);
                $prix_jour = filter_var($_POST['prix_jour'], FILTER_VALIDATE_FLOAT);
                $prix_semaine = filter_var($_POST['prix_semaine'], FILTER_VALIDATE_FLOAT);
                $prix_mois = filter_var($_POST['prix_mois'], FILTER_VALIDATE_FLOAT);
                $annee = filter_var($_POST['annee'], FILTER_VALIDATE_INT);
                $description = trim($_POST['description']);
                $statut = in_array($_POST['statut'], ['Disponible', 'Réserver', 'Loué', 'Maintenance']) ? $_POST['statut'] : 'Disponible';
                $id_categorie = filter_var($_POST['id_categorie'], FILTER_VALIDATE_INT);
                $id_modele = filter_var($_POST['id_modele'], FILTER_VALIDATE_INT);
                $id_marque = filter_var($_POST['id_marque'], FILTER_VALIDATE_INT);
                $id_carburant = filter_var($_POST['id_carburant'], FILTER_VALIDATE_INT);
                $id_transmission = filter_var($_POST['id_transmission'], FILTER_VALIDATE_INT);
                $id_places = filter_var($_POST['id_places'], FILTER_VALIDATE_INT);
                $id_couleur = filter_var($_POST['id_couleur'], FILTER_VALIDATE_INT);


                $vehicule = new Vehicule();
                $vehicule->setNom($nom);
                $vehicule->setPrix_km($prix_km);
                $vehicule->setPrix_jour($prix_jour);
                $vehicule->setPrix_semaine($prix_semaine);
                $vehicule->setPrix_mois($prix_mois);
                $vehicule->setAnnee($annee);
                $vehicule->setDescription($description);
                $vehicule->setStatut($statut);
                $vehicule->setId_categorie($id_categorie ?? null);
                $vehicule->setId_modele($id_modele);
                $vehicule->setId_marque($id_marque);
                $vehicule->setId_carburant($id_carburant ?? null);
                $vehicule->setId_transmission($id_transmission ?? null);
                $vehicule->setId_places($id_places ?? null);
                $vehicule->setId_couleur($id_couleur ?? null);


                if (!empty($_FILES['photo']['name'])) {
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $max_size = 5 * 1024 * 1024; // 5MB
                    $file_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                    $file_size = $_FILES['photo']['size'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        $_SESSION['message'] = "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }

                    if ($file_size > $max_size) {
                        $_SESSION['message'] = "L'image dépasse la taille maximale de 2MB.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }

                    $file_name = time() . "_" . bin2hex(random_bytes(5)) . "." . $file_extension;
                    $file_path = "./uploads/photos/" . $file_name;

                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $file_path)) {
                        $vehicule->setPhoto($file_path);
                    } else {
                        $_SESSION['message'] = "Erreur lors de l'upload de l'image.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }
                }

                $vehiculeModel = new VehiculeModel();
                if ($vehiculeModel->create($vehicule)) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Véhicule ajouté avec succès.'
                    ]);
                    exit();
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Erreur lors de l\'ajout du véhicule.'
                    ]);
                    exit();
                }
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Accès refusé.'
            ]);
            exit();
        }
    }
    public function updateCar()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {

            $id_vehicule = isset($_GET['id_vehicule']) ? $_GET['id_vehicule'] : null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_vehicule = $_POST['id_vehicule'];
                $nom = htmlspecialchars(trim($_POST['nom']));
                $prix_km = filter_var($_POST['prix_km'], FILTER_VALIDATE_FLOAT);
                $prix_jour = filter_var($_POST['prix_jour'], FILTER_VALIDATE_FLOAT);
                $prix_semaine = filter_var($_POST['prix_semaine'], FILTER_VALIDATE_FLOAT);
                $prix_mois = filter_var($_POST['prix_mois'], FILTER_VALIDATE_FLOAT);
                $annee = filter_var($_POST['annee'], FILTER_VALIDATE_INT);
                $description = trim($_POST['description']);
                $statut = in_array($_POST['statut'], ['Disponible', 'Réserver', 'Loué', 'Maintenance']) ? $_POST['statut'] : 'Disponible';
                $id_categorie = filter_var($_POST['id_categorie'], FILTER_VALIDATE_INT);
                $id_modele = filter_var($_POST['id_modele'], FILTER_VALIDATE_INT);
                $id_marque = filter_var($_POST['id_marque'], FILTER_VALIDATE_INT);
                $id_carburant = filter_var($_POST['id_carburant'], FILTER_VALIDATE_INT);
                $id_transmission = filter_var($_POST['id_transmission'], FILTER_VALIDATE_INT);
                $id_places = filter_var($_POST['id_places'], FILTER_VALIDATE_INT);
                $id_couleur = filter_var($_POST['id_couleur'], FILTER_VALIDATE_INT);

                $vehicule = new Vehicule();
                $vehicule->setId_vehicule($id_vehicule);
                $vehicule->setNom($nom);
                $vehicule->setPrix_km($prix_km);
                $vehicule->setPrix_jour($prix_jour);
                $vehicule->setPrix_semaine($prix_semaine);
                $vehicule->setPrix_mois($prix_mois);
                $vehicule->setAnnee($annee);
                $vehicule->setDescription($description);
                $vehicule->setStatut($statut);
                $vehicule->setId_categorie($id_categorie ?? null);
                $vehicule->setId_modele($id_modele);
                $vehicule->setId_marque($id_marque);
                $vehicule->setId_carburant($id_carburant ?? null);
                $vehicule->setId_transmission($id_transmission ?? null);
                $vehicule->setId_places($id_places ?? null);
                $vehicule->setId_couleur($id_couleur ?? null);
                if (!empty($_FILES['photo']['name'])) {
                    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $max_size = 5 * 1024 * 1024; // 5MB
                    $file_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                    $file_size = $_FILES['photo']['size'];

                    if (!in_array($file_extension, $allowed_extensions)) {
                        $_SESSION['message'] = "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }

                    if ($file_size > $max_size) {
                        $_SESSION['message'] = "L'image dépasse la taille maximale de 2MB.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }

                    $file_name = time() . "_" . bin2hex(random_bytes(5)) . "." . $file_extension;
                    $file_path = "./uploads/photos/" . $file_name;

                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $file_path)) {
                        $vehicule->setPhoto($file_path);
                    } else {
                        $_SESSION['message'] = "Erreur lors de l'upload de l'image.";
                        header('Location: index.php?controller=Admin&action=orderCars');
                        exit();
                    }
                } else {
                    $vehiculeModel = new VehiculeModel();
                    $vehiculeExistant = $vehiculeModel->displayOne($id_vehicule);

                    if ($vehiculeExistant && $vehiculeExistant->photo) {
                        $vehicule->setPhoto($vehiculeExistant->photo);
                    }
                }
                $vehiculeModel = new VehiculeModel();
                if ($vehiculeModel->update($vehicule)) {
                    $_SESSION['message'] = "Véhicule mis à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderCars');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour du véhicule.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }
    public function deleteCar()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_vehicule = $_GET['id_vehicule'];
            if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                exit();
            }

            if (!$id_vehicule) {
                $_SESSION['message'] = "Véhicule introuvable.";
                header('Location: index.php?controller=Admin&action=orderCars');
                exit();
            }

            $vehiculeModel = new VehiculeModel();
            $vehicule = $vehiculeModel->displayOne($id_vehicule);

            if (!$vehicule) {
                $_SESSION['message'] = "Véhicule introuvable dans la base de données.";
                header('Location: index.php?controller=Admin&action=orderCars');
                exit();
            }

            if ($vehicule->photo && file_exists($vehicule->photo)) {
                unlink($vehicule->photo);
            }

            if ($vehiculeModel->delete($id_vehicule)) {
                $_SESSION['message'] = "Véhicule supprimé avec succès.";
            } else {
                $_SESSION['message'] = "Erreur lors de la suppression du véhicule.";
            }

            header('Location: index.php?controller=Admin&action=orderCars');
            exit();
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }





    ///////////////////////////////////////////////////VEHICULES/////////////////////////////////////////////////////







    ///////////////////////////////////////////////////ARCHIVES/////////////////////////////////////////////////////


    public function orderArchives()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $archiveModel = new ArchiveModel();
            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $archives = !empty($search)
                ? $archiveModel->search($search)
                : $archiveModel->displayAll();

            $this->render('admin/orderArchives', ['archives' => $archives]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function orderArchiveOne()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_archive'])) {
                $_SESSION['message'] = "Aucune archive sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderArchives');
                exit();
            }

            $id_archive = filter_var($_GET['id_archive'], FILTER_VALIDATE_INT);
            $archiveModel = new ArchiveModel();
            $archive = $archiveModel->displayOne($id_archive);

            if (!$archive) {
                $_SESSION['message'] = "Archive introuvable.";
                header('Location: index.php?controller=Admin&action=orderArchives');
                exit();
            }

            $this->render('admin/orderArchiveOne', ['archive' => $archive]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function createArchive()
    {
        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['role'] != 1) {
            echo "Accès refusé.";
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Méthode non autorisée.";
            exit();
        }
        if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
            exit();
        }

        $archive = new Archive();
        $archive->setNom(htmlspecialchars(($_POST['nom']), ENT_QUOTES, 'UTF-8'));
        $archive->setPrenom(htmlspecialchars(($_POST['prenom']), ENT_QUOTES, 'UTF-8'));
        $archive->setNumero_telephone(preg_replace('/[^\d+]/', '', $_POST['numero_telephone']));
        $archive->setVille(htmlspecialchars(($_POST['ville']), ENT_QUOTES, 'UTF-8'));
        $archive->setEmail(filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL));
        $archive->setNom_vehicule(htmlspecialchars(($_POST['nom_vehicule']), ENT_QUOTES, 'UTF-8'));
        $archive->setModele(htmlspecialchars(($_POST['modele']), ENT_QUOTES, 'UTF-8'));
        $archive->setMarque(htmlspecialchars(($_POST['marque']), ENT_QUOTES, 'UTF-8'));
        $archive->setCategorie_vehicule(htmlspecialchars(trim($_POST['categorie_vehicule']), ENT_QUOTES, 'UTF-8'));
        $archive->setMontant(floatval($_POST['montant']));
        $archive->setDate(date('Y-m-d', strtotime($_POST['date'])));


        $archiveModel = new ArchiveModel();

        if ($archiveModel->create($archive)) {
            echo "Archive créée";
        } else {
            echo "Erreur lors de l'archivage";
        }

        exit();
    }



    ///////////////////////////////////////////////////ARCHIVES/////////////////////////////////////////////////////








    ///////////////////////////////////////////////////AVIS////////////////////////////////////////////////////


    public function orderAvis()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $avisModel = new AvisModel();
            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $avis = !empty($search)
                ? $avisModel->search($search)
                : $avisModel->displayAll();


            $this->render('admin/orderAvis', ['avis' => $avis]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function orderAvisOne()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_avis'])) {
                $_SESSION['message'] = "Aucun avis sélectionné.";
                header('Location: index.php?controller=Admin&action=orderAvis');
                exit();
            }

            $id_avis = filter_var($_GET['id_avis'], FILTER_VALIDATE_INT);
            $avisModel = new AvisModel();
            $avis = $avisModel->displayOne($id_avis);

            if (!$avis) {
                $_SESSION['message'] = "Avis introuvable.";
                header('Location: index.php?controller=Admin&action=orderAvis');
                exit();
            }

            $this->render('admin/orderAvisOne', ['avis' => $avis]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteAvis()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_avis']) && !empty($_GET['id_avis'])) {
                $id_avis = $_GET['id_avis'];
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $avisModel = new AvisModel();
                if (!$id_avis) {
                    $_SESSION['message'] = "Avis introuvable.";
                    header('Location: index.php?controller=Admin&action=orderAvis');
                    exit();
                }
                if ($avisModel->delete($id_avis)) {
                    $_SESSION['message'] = "Avis supprimé avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de l'avis.";
                }

                header('Location: index.php?controller=Admin&action=orderAvis');
                exit();
            } else {
                $_SESSION['message'] = "Avis introuvable.";
                header('Location: index.php?controller=Admin&action=orderAvis');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }




    ///////////////////////////////////////////////////AVIS////////////////////////////////////////////////////




    ///////////////////////////////////////////////////OPTIONS////////////////////////////////////////////////////



    /////////////////////CATEGORIES///////////////////////////
    public function orderOptions()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $vehiculeModel = new VehiculeModel();
            $options = $vehiculeModel->displayOptions();

            $this->render('admin/orderOptions', ['options' => $options]);
        } else {
            $_SESSION['message'] = "Accès refusé. Administrateur uniquement.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    /////////////////////CATEGORIES///////////////////////////

    public function createCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars(trim($_POST['nom']));
                $description = htmlspecialchars(trim($_POST['description']), ENT_NOQUOTES, 'UTF-8');
                $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;
                $categorie = new Categorie();
                $categorie->setNom($nom);
                $categorie->setDescription($description);

                if (!empty($photo['name'])) {
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $maxSize = 5 * 1024 * 1024; // 5MB
                    $fileExtension = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
                    $fileSize = $photo['size'];

                    if (!in_array($fileExtension, $allowedExtensions)) {
                        echo json_encode([
                            'success' => false,
                            'message' => "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF."
                        ]);
                        exit();
                    }

                    if ($fileSize > $maxSize) {
                        echo json_encode([
                            'success' => false,
                            'message' => "L'image dépasse la taille maximale de 5MB."
                        ]);
                        exit();
                    }
                    $fileName = time() . "_" . bin2hex(random_bytes(5)) . "." . $fileExtension;
                    $filePath = "./uploads/photos/" . $fileName;

                    if (move_uploaded_file($photo['tmp_name'], $filePath)) {
                        $categorie->setPhoto($filePath);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => "Erreur lors de l'upload de l'image."
                        ]);
                        exit();
                    }
                }

                $categorieModel = new CategorieModel();
                if ($categorieModel->create($categorie)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Catégorie créée avec succès."
                    ]);
                } else {

                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création de la catégorie."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }


    public function updateCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_categorie = $_POST['id_categorie'];
                $nom = htmlspecialchars($_POST['nom']);
                $description = htmlspecialchars(($_POST['description']), ENT_NOQUOTES, 'UTF-8');
                $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;
                $categorie = new Categorie();
                $categorie->setId_categorie($id_categorie);
                $categorie->setNom($nom);
                $categorie->setDescription($description);
                if (!empty($photo['name'])) {
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $maxSize = 5 * 1024 * 1024; // 5MB
                    $fileExtension = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
                    $fileSize = $photo['size'];

                    if (!in_array($fileExtension, $allowedExtensions)) {
                        $_SESSION['message'] = "Format d'image non autorisé. Formats acceptés : JPG, PNG, GIF.";
                        header('Location: index.php?controller=Admin&action=orderOptions');
                        exit();
                    }

                    if ($fileSize > $maxSize) {
                        $_SESSION['message'] = "L'image dépasse la taille maximale de 5MB.";
                        header('Location: index.php?controller=Admin&action=orderOptions');
                        exit();
                    }

                    $fileName = time() . "_" . bin2hex(random_bytes(5)) . "." . $fileExtension;
                    $filePath = "./uploads/photos/" . $fileName;

                    if (move_uploaded_file($photo['tmp_name'], $filePath)) {
                        $categorie->setPhoto($filePath);
                    } else {
                        $_SESSION['message'] = "Erreur lors de l'upload de l'image.";
                        header('Location: index.php?controller=Admin&action=orderOptions');
                        exit();
                    }
                } else {
                    $categorieModel = new CategorieModel();
                    $categorieExistant = $categorieModel->displayOne($id_categorie);

                    if ($categorieExistant && $categorieExistant->photo) {
                        $categorie->setPhoto($categorieExistant->photo);
                    }
                }

                $categorieModel = new CategorieModel();
                $updateSuccess = $categorieModel->update($categorie);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Catégorie mise à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_categorie']) && !empty($_GET['id_categorie'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_categorie = $_GET['id_categorie'];
                $categorieModel = new CategorieModel();
                if ($categorieModel->delete($id_categorie)) {
                    $_SESSION['message'] = "Catégorie supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la catégorie.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Catégorie introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    /////////////////////CATEGORIES///////////////////////////



    /////////////////////MODELES///////////////////////////

    public function createModele()
    {

        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars(trim($_POST['nom']));

                $modele = new Modele();
                $modele->setNom($nom);
                $modeleModel = new ModeleModel();
                if ($modeleModel->create($modele)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Modèle créée avec succès."
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création du modèle."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }

    public function updateModele()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_modele = $_POST['id_modele'];
                $nom = htmlspecialchars(trim($_POST['nom']));
                $modele = new Modele();
                $modele->setId_modele($id_modele);
                $modele->setNom($nom);

                $modeleModel = new ModeleModel();
                $updateSuccess = $modeleModel->update($modele);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Modèle mis à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour du modèle.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?');
            exit();
        }
    }
    public function deleteModele()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_modele']) && !empty($_GET['id_modele'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_modele = $_GET['id_modele'];
                $modeleModel = new ModeleModel();
                if ($modeleModel->delete($id_modele)) {
                    $_SESSION['message'] = "Modèle supprimé avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression du modèle.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Modèle introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    /////////////////////MODELES///////////////////////////






    /////////////////////MARQUES///////////////////////////

    public function createMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars(trim($_POST['nom']));
                $marque = new Marque();
                $marque->setNom($nom);
                $marqueModel = new MarqueModel();
                if ($marqueModel->create($marque)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Marque créée avec succès."
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création de la marque."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }


    public function updateMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_marque = $_POST['id_marque'];
                $nom = htmlspecialchars(trim($_POST['nom']));

                if (!$nom) {
                    $_SESSION['message'] = "Veuillez remplir le champ nom.";
                    header("Location: index.php?controller=Admin&action=updateMarque&id_marque=$id_marque");
                    exit();
                }

                $marque = new Marque();
                $marque->setId_marque($id_marque);
                $marque->setNom($nom);

                $marqueModel = new MarqueModel();
                $updateSuccess = $marqueModel->update($marque);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Marque mise à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour de la marque.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_marque']) && !empty($_GET['id_marque'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_marque = $_GET['id_marque'];
                $marqueModel = new MarqueModel();
                if ($marqueModel->delete($id_marque)) {
                    $_SESSION['message'] = "Marque supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la marque.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Marque introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }



    /////////////////////MARQUES///////////////////////////




    /////////////////////CARBURANTS///////////////////////////

    public function createCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $type = htmlspecialchars(trim($_POST['type']));
                $carburant = new Carburant();
                $carburant->setType($type);
                $carburantModel = new CarburantModel();
                if ($carburantModel->create($carburant)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Carburant créé avec succès."
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création du carburant."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }

    public function updateCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_carburant = $_POST['id_carburant'];
                $type = htmlspecialchars(trim($_POST['type']));
                $carburant = new Carburant();
                $carburant->setId_carburant($id_carburant);
                $carburant->setType($type);

                $carburantModel = new CarburantModel();
                $updateSuccess = $carburantModel->update($carburant);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Carburant mis à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour du carburant.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_carburant']) && !empty($_GET['id_carburant'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_carburant = $_GET['id_carburant'];
                $carburantModel = new CarburantModel();
                if ($carburantModel->delete($id_carburant)) {
                    $_SESSION['message'] = "Carburant supprimé avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression du carburant.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Carburant introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    /////////////////////CARBURANTS///////////////////////////




    /////////////////////TRANSMISSIONS///////////////////////////

    // Créer une transmission
    public function createTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $type = htmlspecialchars(trim($_POST['type']));
                $transmission = new Transmission();
                $transmission->setType($type);
                $transmissionModel = new TransmissionModel();
                if ($transmissionModel->create($transmission)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Transmission créée avec succès.",
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création de la transmission."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }

    public function updateTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_transmission = $_POST['id_transmission'];
                $type = htmlspecialchars(trim($_POST['type']));
                $transmission = new Transmission();
                $transmission->setId_transmission($id_transmission);
                $transmission->setType($type);
                $transmissionModel = new TransmissionModel();
                $updateSuccess = $transmissionModel->update($transmission);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Transmission mise à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour de la transmission.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_transmission']) && !empty($_GET['id_transmission'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_transmission = $_GET['id_transmission'];
                $transmissionModel = new TransmissionModel();
                if ($transmissionModel->delete($id_transmission)) {
                    $_SESSION['message'] = "Transmission supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la transmission.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Transmission introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }



    /////////////////////TRANSMISSIONS///////////////////////////





    /////////////////////PLACES///////////////////////////

    public function createPlaces()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nombre = filter_var($_POST['nombre'], FILTER_VALIDATE_INT);
                $place = new Places();
                $place->setNombre($nombre);
                $placesModel = new PlacesModel();
                if ($placesModel->create($place)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Place créée avec succès.",
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création du nombre de place."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }

    public function updatePlaces()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_places = $_POST['id_places'];
                $nombre = filter_var($_POST['nombre'], FILTER_VALIDATE_INT);
                $place = new Places();
                $place->setId_places($id_places);
                $place->setNombre($nombre);
                $placesModel = new PlacesModel();
                $updateSuccess = $placesModel->update($place);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Place mise à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour de la place.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    public function deletePlaces()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_places']) && !empty($_GET['id_places'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_places = $_GET['id_places'];
                $placesModel = new PlacesModel();


                if (!$id_places) {
                    $_SESSION['message'] = "Place introuvable.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                }
                if ($placesModel->delete($id_places)) {
                    $_SESSION['message'] = "Place supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la place.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Place introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }


    /////////////////////PLACES///////////////////////////




    /////////////////////COULEURS///////////////////////////

    public function createCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $nom = htmlspecialchars(trim($_POST['nom']));
                $couleur = new Couleur();
                $couleur->setNom($nom);
                $couleurModel = new CouleurModel();
                if ($couleurModel->create($couleur)) {
                    echo json_encode([
                        'success' => true,
                        'message' => "Couleur créée avec succès."
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => "Erreur lors de la création de la couleur."
                    ]);
                }
                exit();
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => "Accès refusé."
            ]);
            exit();
        }
    }
    public function updateCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_couleur = $_POST['id_couleur'];
                $nom = htmlspecialchars(trim($_POST['nom']));
                $couleur = new Couleur();
                $couleur->setId_couleur($id_couleur);
                $couleur->setNom($nom);
                $couleurModel = new CouleurModel();
                $updateSuccess = $couleurModel->update($couleur);

                if ($updateSuccess) {
                    $_SESSION['message'] = "Couleur mise à jour avec succès.";
                    header('Location: index.php?controller=Admin&action=orderOptions');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour de la couleur.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function deleteCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_couleur']) && !empty($_GET['id_couleur'])) {
                if (!isset($_GET['session'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['session'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                $id_couleur = $_GET['id_couleur'];
                $couleurModel = new CouleurModel();
                if ($couleurModel->delete($id_couleur)) {
                    $_SESSION['message'] = "Couleur supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la couleur.";
                }

                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            } else {
                $_SESSION['message'] = "Couleur introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    /////////////////////COULEURS///////////////////////////

    ///////////////////////////////////////////////////OPTIONS////////////////////////////////////////////////////








    ///////////////////////////////////////////////////DEMANDE////////////////////////////////////////////////////

    public function orderDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $demandeReservationModel = new Demande_reservationModel();

            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $demandes = !empty($search)
                ? $demandeReservationModel->search($search)
                : $demandeReservationModel->displayAll();

            $this->render('admin/orderDemande', ['demandes' => $demandes, 'search' => $search]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }


    public function orderDemandeOne()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {

            if (isset($_GET['id_demande']) && !empty($_GET['id_demande'])) {
                $id_demande = filter_var($_GET['id_demande'], FILTER_VALIDATE_INT);
                $demandeReservationModel = new Demande_ReservationModel();
                $demande = $demandeReservationModel->displayOne($id_demande);

                if (!$demande) {
                    $_SESSION['message'] = "Demande introuvable.";
                    header('Location: index.php?controller=Admin&action=orderDemande');
                    exit();
                }

                $this->render('admin/orderDemandeOne', ['demande' => $demande]);
            } else {
                $_SESSION['message'] = "Accès refusé.";
                header('Location: index.php');
                exit();
            }
        }
    }
    public function updateStatutDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                exit();
            }
            if (
                isset($_POST['id_demande']) && !empty($_POST['id_demande']) &&
                isset($_POST['statut']) && in_array($_POST['statut'], ['Acceptée', 'Refusée'])

            ) {
                $id_demande = $_POST['id_demande'];
                $statut = $_POST['statut'];
                $id_utilisateur = $_POST['id_utilisateur'];
                $email = $_POST['email'];
                $id_vehicule = $_POST['id_vehicule'];
                $montant = $_POST['montant'];
                $forfait = $_POST['forfait'];
                $date_debut = $_POST['date_debut'];
                $date_fin = $_POST['date_fin'];

                $utilisateurModel = new UtilisateurModel();
                $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
                $nom = $utilisateur->nom;
                $prenom = $utilisateur->prenom;

                $vehiculeModel = new VehiculeModel();
                $vehicule = $vehiculeModel->displayOne($id_vehicule);
                $modele = $vehicule->modele;
                $marque = $vehicule->marque;

                $demandeReservationModel = new Demande_ReservationModel();
                $demandeData = new Demande_Reservation();
                $demandeData->setId_demande_reservation($id_demande);
                $demandeData->setStatut($statut);

                if ($statut === 'Acceptée') {
                    $reservationModel = new ReservationModel();
                    $reservation = new Reservation();
                    $reservation->setId_utilisateur($id_utilisateur);
                    $reservation->setId_vehicule($id_vehicule);
                    $reservation->setMontant($montant);
                    $reservation->setForfait($forfait);
                    $reservation->setDate_debut($date_debut);
                    $reservation->setDate_fin($date_fin);

                    if ($reservationModel->create($reservation)) {
                        $statut = 'Réserver';
                        $vehiculeModel->updateStatut($statut, $id_vehicule);
                        $_SESSION['message'] = "Réservation créée avec succès.";

                        $subject = "Votre réservation a été acceptée - EliteDrive";
                        $body = file_get_contents(__DIR__ . '/../Views/mails/accepteReserve.php');
                        $body = str_replace(
                            ['{{nom}}', '{{prenom}}', '{{modele}}', '{{marque}}', '{{montant}}', '{{forfait}}', '{{date_debut}}', '{{date_fin}}'],
                            [$nom, $prenom, $modele, $marque, $montant, $forfait, $date_debut, $date_fin],
                            $body
                        );

                        $mailModel = new MailsModel();
                        $mailModel->sendMail($email, $subject, $body);
                    } else {
                        $_SESSION['message'] = "Erreur lors de la création de la réservation.";
                    }
                }

                if ($statut === 'Refusée') {
                    $subject = "Votre demande a été refusée - EliteDrive";
                    $body = file_get_contents(__DIR__ . '/../Views/mails/refusReserve.php');
                    $body = str_replace(
                        ['{{nom}}', '{{prenom}}', '{{modele}}', '{{marque}}'],
                        [$nom, $prenom, $modele, $marque],
                        $body
                    );

                    $mailModel = new MailsModel();
                    if ($mailModel->sendMail($email, $subject, $body)) {
                        $_SESSION['message'] = "Email de refus envoyé.";
                    } else {
                        $_SESSION['message'] = "Erreur lors de l'envoi de l'email de refus.";
                    }
                }

                if ($demandeReservationModel->updateStatut($demandeData)) {
                    $_SESSION['message'] .= " Statut mis à jour.";
                } else {
                    $_SESSION['message'] .= " Erreur lors de la mise à jour du statut.";
                }

                header('Location: index.php?controller=Admin&action=orderDemande');
                exit();
            } else {
                $_SESSION['message'] = "Demande ou statut invalide.";
                header('Location: index.php?controller=Admin&action=orderDemande');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }




    ///////////////////////////////////////////////////DEMANDE////////////////////////////////////////////////////





    ///////////////////////////////////////////////////RESERVATIONS////////////////////////////////////////////////////


    public function orderReservations()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $reservationModel = new ReservationModel();
            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $reservations = !empty($search)
                ? $reservationModel->search($search)
                : $reservationModel->displayAll();

            $this->render('admin/orderReservations', ['reservations' => $reservations, 'search' => $search]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function updateReservationStatut()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_POST['id_vehicule']) && !empty($_POST['id_vehicule'])) {
                $id_reservation = $_POST['id_reservation'];
                $id_vehicule = $_POST['id_vehicule'];
                $statut = $_POST['statut'];
                if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                    echo json_encode(['success' => false, 'message' => 'Token CSRF invalide.']);
                    exit();
                }
                if (!in_array($statut, ['Réserver', 'Loué', 'Maintenance', 'Disponible'])) {
                    $_SESSION['message'] = "Statut invalide.";
                    header('Location: index.php?controller=Admin&action=orderReservations');
                    exit();
                }

                if ($statut === 'Disponible') {
                    $reservationModel = new ReservationModel();
                    $reservation = $reservationModel->updateEndDate($id_vehicule, $id_reservation);
                    if ($reservation) {
                        $statut = 'Disponible';
                    } else {
                        $_SESSION['message'] = "Erreur lors de la mise à jour de la date de fin.";
                        header('Location: index.php?controller=Admin&action=orderReservations');
                        exit();
                    }
                }

                $vehiculeModel = new VehiculeModel();
                if ($vehiculeModel->updateStatut($statut, $id_vehicule)) {
                    $_SESSION['message'] = "Statut de la réservation mis à jour avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la mise à jour du statut.";
                }

                header('Location: index.php?controller=Admin&action=orderReservations');
                exit();
            } else {
                $_SESSION['message'] = "Réservation introuvable.";
                header('Location: index.php?controller=Admin&action=orderReservations');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }
}



     ///////////////////////////////////////////////////RESERVATIONS////////////////////////////////////////////////////
