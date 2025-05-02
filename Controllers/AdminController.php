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


    // Affichage back office
    public function backOffice()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_utilisateur = $_SESSION['id_utilisateur'];
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
            $this->render('admin/backOffice', ['utilisateur' => $utilisateur]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
        }
    }


    // Gestion des utilisateurs 

    public function orderUsers()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $utilisateurModel = new UtilisateurModel();

            $search = isset($_POST['search']) ? trim($_POST['search']) : '';
            $utilisateurs = !empty($search)
                ? $utilisateurModel->search($search)
                : $utilisateurModel->displayAll();

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
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $mot_de_passe = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $numero_telephone = $_POST['tel'];
                $ville = $_POST['ville'];
                $role = $_POST['role'];

                $utilisateur = new Utilisateur();
                $utilisateur->setNom($nom);
                $utilisateur->setPrenom($prenom);
                $utilisateur->setEmail($email);
                $utilisateur->setMot_de_passe($mot_de_passe);
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

    public function updateUserForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_utilisateur = $_GET['id_utilisateur'] ?? null;
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);

            $this->render('admin/updateUserForm', ['utilisateur' => $utilisateur]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }
    public function updateUser()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_utilisateur = $_POST['id_utilisateur'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $numero_telephone = $_POST['numero_telephone'];
                $ville = $_POST['ville'];
                $role = $_POST['role'];
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
                $id_utilisateur = $_GET['id_utilisateur'];
                $utilisateurModel = new UtilisateurModel();

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





    // Gestion des véhicules


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
    public function updateCarForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_vehicule = $_GET['id_vehicule'] ?? null;
            $vehiculeModel = new VehiculeModel();
            $vehicule = $vehiculeModel->displayOne($id_vehicule);
            $options = $vehiculeModel->displayOptions();

            $this->render('admin/updateCarForm', ['vehicule' => $vehicule, 'options' => $options]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }
    public function updateCar()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {

            $id_vehicule = isset($_GET['id_vehicule']) ? $_GET['id_vehicule'] : null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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


    /* Gestion des archives */


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

        $archive = new Archive();
        $archive->setNom($_POST['nom']);
        $archive->setPrenom($_POST['prenom']);
        $archive->setNumero_telephone($_POST['numero_telephone']);
        $archive->setVille($_POST['ville']);
        $archive->setEmail($_POST['email']);
        $archive->setNom_vehicule($_POST['nom_vehicule']);
        $archive->setModele($_POST['modele']);
        $archive->setMarque($_POST['marque']);
        $archive->setCategorie_vehicule($_POST['categorie_vehicule']);
        $archive->setMontant($_POST['montant']);
        $archive->setDate($_POST['date']);

        $archiveModel = new ArchiveModel();

        if ($archiveModel->create($archive)) {
            echo "Archive créée";
        } else {
            echo "Erreur lors de l'archivage";
        }

        exit();
    }


    public function deleteArchive()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_archive']) && !empty($_GET['id_archive'])) {
                $id_archive = $_GET['id_archive'];
                $archiveModel = new ArchiveModel();
                if ($archiveModel->delete($id_archive)) {
                    $_SESSION['message'] = "Archive supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de l'archive.";
                }
                header('Location: index.php?controller=Admin&action=orderArchives');
                exit();
            } else {
                $_SESSION['message'] = "Archive introuvable.";
                header('Location: index.php?controller=Admin&action=orderArchives');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    // Gestion  des avis


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



    // Gestion des options


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

    public function orderOneCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_categorie'])) {
                $_SESSION['message'] = "Aucune catégorie sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_categorie = filter_var($_GET['id_categorie'], FILTER_VALIDATE_INT);
            $categorieModel = new CategorieModel();
            $categorie = $categorieModel->displayOne($id_categorie);

            if (!$categorie) {
                $_SESSION['message'] = "Catégorie introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/orderOneCategory', ['categorie' => $categorie]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = htmlspecialchars(trim($_POST['nom']));
                $description = htmlspecialchars(trim($_POST['description']));
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


    public function updateCategoryForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_categorie = $_GET['id_categorie'] ?? null;
            $categorieModel = new CategorieModel();
            $categorie = $categorieModel->displayOne($id_categorie);


            $this->render('admin/updateCategoryForm', ['categorie' => $categorie]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    public function updateCategory()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_categorie = $_POST['id_categorie'];
                $nom = $_POST['nom'];
                $description = $_POST['description'];
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
    // Afficher tous les modèles
    public function orderOneModeles()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_modele'])) {
                $_SESSION['message'] = "Aucun modèle sélectionné.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_modele = filter_var($_GET['id_modele'], FILTER_VALIDATE_INT);
            $modeleModel = new ModeleModel();
            $modele = $modeleModel->displayOne($id_modele);

            if (!$modele) {
                $_SESSION['message'] = "Modèle introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/orderOneModeles', ['modele' => $modele]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createModele()
    {

        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function updateModeleForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_modele = $_GET['id_modele'] ?? null;
            $modeleModel = new ModeleModel();
            $modele = $modeleModel->displayOne($id_modele);

            $this->render('admin/updateModeleForm', ['modele' => $modele]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function updateModele()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    // Afficher toutes les marques

    public function orderOneMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_marque'])) {
                $_SESSION['message'] = "Aucune marque sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_marque = filter_var($_GET['id_marque'], FILTER_VALIDATE_INT);
            $marqueModel = new MarqueModel();
            $marque = $marqueModel->displayOne($id_marque);

            if (!$marque) {
                $_SESSION['message'] = "Marque introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/showOneMarque', ['marque' => $marque]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function updateMarqueForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_marque = $_GET['id_marque'] ?? null;
            $marqueModel = new MarqueModel();
            $marque = $marqueModel->displayOne($id_marque);

            $this->render('admin/updateMarqueForm', ['marque' => $marque]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    public function updateMarque()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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



    public function orderOneCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_carburant'])) {
                $_SESSION['message'] = "Aucun carburant sélectionné.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_carburant = filter_var($_GET['id_carburant'], FILTER_VALIDATE_INT);
            $carburantModel = new CarburantModel();
            $carburant = $carburantModel->displayOne($id_carburant);

            if (!$carburant) {
                $_SESSION['message'] = "Carburant introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/orderOneCarburant', ['carburant' => $carburant]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function updateCarburantForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_carburant = $_GET['id_carburant'] ?? null;
            $carburantModel = new CarburantModel();
            $carburant = $carburantModel->displayOne($id_carburant);

            $this->render('admin/updateCarburantForm', ['carburant' => $carburant]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }


    public function updateCarburant()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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


    public function orderOneTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_transmission'])) {
                $_SESSION['message'] = "Aucune transmission sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_transmission = filter_var($_GET['id_transmission'], FILTER_VALIDATE_INT);
            $transmissionModel = new TransmissionModel();
            $transmission = $transmissionModel->displayOne($id_transmission);

            if (!$transmission) {
                $_SESSION['message'] = "Transmission introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/orderOneTransmission', ['transmission' => $transmission]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    // Créer une transmission
    public function createTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function updateTransmissionForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_transmission = $_GET['id_transmission'] ?? null;
            $transmissionModel = new TransmissionModel();
            $transmission = $transmissionModel->displayOne($id_transmission);

            $this->render('admin/updateTransmissionForm', ['transmission' => $transmission]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function updateTransmission()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function orderOnePlace()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_places'])) {
                $_SESSION['message'] = "Aucune place sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderPlaces');
                exit();
            }

            $id_places = filter_var($_GET['id_places'], FILTER_VALIDATE_INT);
            $placesModel = new PlacesModel();
            $place = $placesModel->displayOne($id_places);

            if (!$place) {
                $_SESSION['message'] = "Place introuvable.";
                header('Location: index.php?controller=Admin&action=orderPlaces');
                exit();
            }

            $this->render('admin/orderOnePlace', ['place' => $place]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createPlaces()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function updatePlacesForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_places = $_GET['id_places'] ?? null;
            $placesModel = new PlacesModel();
            $places = $placesModel->displayOne($id_places);

            $this->render('admin/updatePlacesForm', ['places' => $places]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function updatePlaces()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                $id_places = $_GET['id_places'];
                $placesModel = new PlacesModel();
                $place = $placesModel->displayOne($id_places);

                if (!$place) {
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

    public function orderOneCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_couleur'])) {
                $_SESSION['message'] = "Aucune couleur sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $id_couleur = filter_var($_GET['id_couleur'], FILTER_VALIDATE_INT);
            $couleurModel = new CouleurModel();
            $couleur = $couleurModel->displayOne($id_couleur);

            if (!$couleur) {
                $_SESSION['message'] = "Couleur introuvable.";
                header('Location: index.php?controller=Admin&action=orderOptions');
                exit();
            }

            $this->render('admin/orderOneCouleur', ['couleur' => $couleur]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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


    public function updateCouleurForm()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $id_couleur = $_GET['id_couleur'] ?? null;
            $couleurModel = new CouleurModel();
            $couleur = $couleurModel->displayOne($id_couleur);

            $this->render('admin/updateCouleurForm', ['couleur' => $couleur]);
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php');
            exit();
        }
    }

    public function updateCouleur()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    public function orderDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            $demandeReservationModel = new Demande_ReservationModel();

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
    public function createDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $message = htmlspecialchars(trim($_POST['message']));
                $date_debut = htmlspecialchars(trim($_POST['date_debut']));
                $date_fin = htmlspecialchars(trim($_POST['date_fin']));
                $montant = filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT);
                $statut = htmlspecialchars(trim($_POST['statut']));
                $forfait = htmlspecialchars(trim($_POST['forfait']));
                $id_utilisateur = intval($_POST['id_utilisateur']);
                $id_vehicule = intval($_POST['id_vehicule']);
                $demande = new Demande_Reservation();
                $demande->setMessage($message);
                $demande->setDate_debut($date_debut);
                $demande->setDate_fin($date_fin);
                $demande->setMontant($montant);
                $demande->setStatut($statut);
                $demande->setForfait($forfait);
                $demande->setId_utilisateur($id_utilisateur);
                $demande->setId_vehicule($id_vehicule);
                $demandeReservationModel = new Demande_ReservationModel();
                if ($demandeReservationModel->create($demande)) {
                    $_SESSION['message'] = "Demande de réservation créée avec succès.";
                    header('Location: index.php?controller=Admin&action=orderDemande');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la création de la demande de réservation.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?');
            exit();
        }
    }

    public function updateStatutDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
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


    public function deleteDemande()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_demande']) && !empty($_GET['id_demande'])) {
                $id_demande = $_GET['id_demande_reseid_demandervation'];
                $demandeReservationModel = new Demande_ReservationModel();
                $demande = $demandeReservationModel->displayOne($id_demande);

                if (!$demande) {
                    $_SESSION['message'] = "Demande introuvable.";
                    header('Location: index.php?controller=Admin&action=orderDemande');
                    exit();
                }
                if ($demandeReservationModel->delete($id_demande)) {
                    $_SESSION['message'] = "Demande supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la demande.";
                }

                header('Location: index.php?controller=Admin&action=orderDemande');
                exit();
            } else {
                $_SESSION['message'] = "Demande introuvable.";
                header('Location: index.php?controller=Admin&action=orderDemande');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }
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

    public function orderOneReservation()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (!isset($_GET['id_reservation'])) {
                $_SESSION['message'] = "Aucune réservation sélectionnée.";
                header('Location: index.php?controller=Admin&action=orderReservations');
                exit();
            }

            $id_reservation = filter_var($_GET['id_reservation'], FILTER_VALIDATE_INT);
            $reservationModel = new ReservationModel();
            $reservation = $reservationModel->displayOne($id_reservation);

            if (!$reservation) {
                $_SESSION['message'] = "Réservation introuvable.";
                header('Location: index.php?controller=Admin&action=orderReservations');
                exit();
            }

            $this->render('admin/orderOneReservation', ['reservation' => $reservation]);
        } else {
            $_SESSION['message'] = "Accès non autorisé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function createReservation()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id_utilisateur = intval($_POST['id_utilisateur']);
                $id_vehicule = intval($_POST['id_vehicule']);
                $montant = filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT);
                $date_debut = htmlspecialchars(trim($_POST['date_debut']));
                $date_fin = htmlspecialchars(trim($_POST['date_fin']));
                $forfait = htmlspecialchars(trim($_POST['forfait']));
                $reservation = new Reservation();
                $reservation->setId_utilisateur($id_utilisateur);
                $reservation->setId_vehicule($id_vehicule);
                $reservation->setMontant($montant);
                $reservation->setDate_debut($date_debut);
                $reservation->setDate_fin($date_fin);
                $reservation->setForfait($forfait);

                $reservationModel = new ReservationModel();
                if ($reservationModel->create($reservation)) {
                    $_SESSION['message'] = "Réservation créée avec succès.";
                    header('Location: index.php?controller=Admin&action=orderReservations');
                    exit();
                } else {
                    $_SESSION['message'] = "Erreur lors de la création de la réservation.";
                }
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }
    public function updateReservation()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
                $id_reservation = $_GET['id_reservation'];
                $reservationModel = new ReservationModel();
                $reservation = $reservationModel->displayOne($id_reservation);

                if (!$reservation) {
                    $_SESSION['message'] = "Réservation introuvable.";
                    header('Location: index.php?controller=Admin&action=orderReservations');
                    exit();
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id_utilisateur = intval($_POST['id_utilisateur']);
                    $id_vehicule = intval($_POST['id_vehicule']);
                    $montant = filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT);
                    $date_debut = htmlspecialchars(trim($_POST['date_debut']));
                    $date_fin = htmlspecialchars(trim($_POST['date_fin']));
                    $forfait = htmlspecialchars(trim($_POST['forfait']));
                    $reservation->setId_utilisateur($id_utilisateur);
                    $reservation->setId_vehicule($id_vehicule);
                    $reservation->setMontant($montant);
                    $reservation->setDate_debut($date_debut);
                    $reservation->setDate_fin($date_fin);
                    $reservation->setForfait($forfait);
                    if ($reservationModel->update($reservation)) {
                        $_SESSION['message'] = "Réservation mise à jour avec succès.";
                        header('Location: index.php?controller=Admin&action=orderReservations');
                        exit();
                    } else {
                        $_SESSION['message'] = "Erreur lors de la mise à jour de la réservation.";
                    }
                }
                $this->render('admin/updateReservation', ['reservation' => $reservation]);
            } else {
                $_SESSION['message'] = "Réservation introuvable.";
                header('Location: index.php?controller=Admin&action=orderReservations');
                exit();
            }
        } else {
            $_SESSION['message'] = "Accès refusé.";
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }

    public function deleteReservation()
    {
        if (isset($_SESSION['id_utilisateur']) && $_SESSION['role'] == 1) {
            if (isset($_GET['id_reservation']) && !empty($_GET['id_reservation'])) {
                $id_reservation = $_GET['id_reservation'];

                $reservationModel = new ReservationModel();
                $reservation = $reservationModel->displayOne($id_reservation);

                if (!$reservation) {
                    $_SESSION['message'] = "Réservation introuvable.";
                    header('Location: index.php?controller=Admin&action=orderReservations');
                    exit();
                }

                if ($reservationModel->delete($id_reservation)) {
                    $_SESSION['message'] = "Réservation supprimée avec succès.";
                } else {
                    $_SESSION['message'] = "Erreur lors de la suppression de la réservation.";
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
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        }
    }
}
