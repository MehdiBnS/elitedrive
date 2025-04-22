<?php

namespace elitedrive\Controllers;

use elitedrive\Models\UtilisateurModel;
use elitedrive\Entities\Utilisateur;
use elitedrive\Models\AvisModel;
use elitedrive\Models\Demande_ReservationModel;
use elitedrive\Models\ReservationModel;

class UtilisateurController extends Controller
{
    public function subForm()
    {
        if (isset($_SESSION['id_utilisateur'])) {
            if ($_SESSION['role'] == 1) {
                header('Location: index.php?controller=Admin&action=backOffice');
                exit();
            } else {
                header('Location: index.php?controller=Utilisateur&action=showProfile');
                exit();
            }
        } else {
            $this->render('utilisateur/subForm');
        }
    }

    public function createUserUt()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(strip_tags(trim($_POST['name'])));
            $prenom = htmlspecialchars(strip_tags(trim($_POST['surname'])));
            $mot_de_passe = trim($_POST['password']);
            $numero_telephone = trim($_POST['tel']);
            $email = trim($_POST['email']);
            $ville = htmlspecialchars(strip_tags(trim($_POST['city'])));
            $role = 0;

            $message[] = "";

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message[] = "Email Invalide";
            }
            if (strlen($mot_de_passe) < 8) {
                $message[] = " Le mot de passe doit contenir au moins 8 caractères.";
            }

            if (!preg_match('/^\+?[0-9]{10,15}$/', $numero_telephone)) {
                $message[] = "Numéro de téléphone invalide";
            }

            if (!preg_match('/[A-Z]/', $mot_de_passe) || !preg_match('/[a-z]/', $mot_de_passe)) {
                $message[] = " Le mot de passe doit contenir une majuscule et une minuscule";
            }
            if (!preg_match('/\d/', $mot_de_passe)) {
                $message[] = "Le mot de passe doit contenir au moins un chiffre !<br>";
            }
            if (!preg_match('/[@$!%*?&]/', $mot_de_passe)) {
                $message[] = "Le mot de passe doit contenir au moins un symbole spécial (@$!%*?&) !<br>";
            }
            if (empty($message)) {
                $message[] = "";
            }
            $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            $utilisateurModel = new UtilisateurModel();

            if ($utilisateurModel->checkEmailExists($email)) {
                $_SESSION['message'] = 'L\'email est déjà utilisé par un autre utilisateur.';
                header('Location: index.php?controller=Utilisateur&action=subForm');
                exit();
            }

            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setMot_de_passe($mot_de_passe_hash);
            $utilisateur->setNumero_telephone($numero_telephone);
            $utilisateur->setEmail($email);
            $utilisateur->setVille($ville);
            $utilisateur->setRole($role);

            $utilisateurModel = new UtilisateurModel();
            if ($utilisateurModel->create($utilisateur)) {
                $_SESSION['id_utilisateur'] = $utilisateur->getId_utilisateur();
                $_SESSION['email'] = $utilisateur->getEmail();
                $_SESSION['numero_telephone'] = $utilisateur->getNumero_telephone();
                $_SESSION['role'] = $utilisateur->getRole();
                $_SESSION['nom'] = $utilisateur->getNom();
                $_SESSION['prenom'] = $utilisateur->getPrenom();
                $_SESSION['ville'] = $utilisateur->getVille();

                header('Location: index.php?controller=Home&action=homeAction');
                exit();
            } else {
                $message = "Erreur lors de l'inscription.";
                $this->render('utilisateur/subForm', ['message' => $message]);
            }
        }
    }

    public function connectForm()
    {
        if (isset($_SESSION['id_utilisateur'])) {
            if ($_SESSION['role'] == 1) {
                header('Location: index.php?controller=Admin&action=backOffice');
                exit();
            } else {
                header('Location: index.php?controller=Utilisateur&action=showProfile');
                exit();
            }
        } else {
            $this->render('utilisateur/connectForm');
        }
    }

    public function connectUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $mot_de_passe = $_POST['password'];

            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->connect($email, $mot_de_passe); // Connexion de l'utilisateur

            if ($utilisateur) {
                // Si la connexion est réussie, créer la session utilisateur
                $_SESSION['id_utilisateur'] = $utilisateur->id_utilisateur;
                $_SESSION['email'] = $utilisateur->email;
                $_SESSION['role'] = $utilisateur->role;
                $_SESSION['nom'] = $utilisateur->nom;
                $_SESSION['prenom'] = $utilisateur->prenom;
                $_SESSION['ville'] = $utilisateur->ville;

                // Redirection selon le rôle de l'utilisateur
                if ($_SESSION['role'] == 1) {
                    header('Location: index.php?controller=Admin&action=backoffice');
                } else {
                    header('Location: index.php?controller=Utilisateur&action=showProfile');
                }
                exit;
            } else {
                $_SESSION['message'] = "Identifiants ou mot de passe incorrects.";
                header('Location: index.php?controller=Utilisateur&action=connectForm');
                exit;
            }
        }
    }

    public function disconnect()
    {
        if (isset($_SESSION['id_utilisateur'])) {
            session_destroy();
            $_SESSION['message'] = "Vous êtes déconnecté avec succès.";
            header('Location: index.php?controller=Home&action=homeAction');
            exit();
        } else {
            header('Location: index.php?controller=Home&action=homeAction');
            exit();
        }
    }
    public function showProfile()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Home&action=homeAction');
            exit();
        }

        $role = $_SESSION['role'] ?? null;

        if ($role === 0) {
            $id_utilisateur = $_SESSION['id_utilisateur'];
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
            $avisModel = new AvisModel();
            $avis = $avisModel->displayByIdUser($id_utilisateur);
            $demandeModel = new Demande_ReservationModel();
            $demande = $demandeModel->displayByIdUser($id_utilisateur);
            $reservationModel = new ReservationModel();
            $reservation = $reservationModel->displayByIdUser($id_utilisateur);
            $this->render('utilisateur/showProfile', ['utilisateur' => $utilisateur, 'avis' => $avis, 'demande' => $demande, 'reservation' => $reservation]);
        } elseif ($role === 1) {
            header('Location: index.php?controller=Admin&action=backOffice');
            exit();
        } else {
            header('Location: index.php?controller=Home&action=homeAction');
            exit();
        }
    }
    public function updateForm()
    {

        if (isset($_GET['id_utilisateur'])) {
            $id_utilisateur = $_GET['id_utilisateur'];
        } else {
            $id_utilisateur = $_SESSION['id_utilisateur'];
        }

        if (!isset($id_utilisateur)) {
            // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
            // $_SESSION['message'] = "Veuillez vous connecter pour modifier votre profil";
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit;
        } else {
            // Récupérer les informations du profil de l'utilisateur
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
            $_SESSION['message'] = "";
            $this->render('utilisateur/updateForm', ['utilisateur' => $utilisateur]);
        }
    }
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_utilisateur = $_POST['id_utilisateur'];
            $nom = $_POST['name'];
            $prenom = $_POST['surname'];
            $numero_telephone = $_POST['tel'];
            $ville = $_POST['city'];
            $email = $_SESSION['email'];
            $role = 0;

            $utilisateur = new Utilisateur();
            $utilisateur->setId_utilisateur($id_utilisateur);
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setNumero_telephone($numero_telephone);
            $utilisateur->setVille($ville);
            $utilisateur->setEmail($email);
            $utilisateur->setRole($role);


            $utilisateurModel = new UtilisateurModel();

            if ($utilisateurModel->update($utilisateur)) {
                $_SESSION['message'] = "";
                header('Location: index.php?controller=Utilisateur&action=showProfile');
            } else {
                //$_SESSION['message'] = "Erreur lors de la modification";
                $this->render('utilisateur/updateForm', ['utilisateur' => $utilisateur]);
            }
        }
    }

    //function pour mettre à jour l'email et le mot de passe (séparée)


    public function deletePage()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }

        if (isset($_GET['id_utilisateur']) && intval($_GET['id_utilisateur']) === $_SESSION['id_utilisateur']) {
            $this->render('utilisateur/deletePage');
        } else {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }
    }

    public function delete()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }

        if (isset($_GET['id_utilisateur']) && intval($_GET['id_utilisateur']) === $_SESSION['id_utilisateur']) {
            $id_utilisateur = intval($_GET['id_utilisateur']);
            $utilisateurModel = new UtilisateurModel();

            if ($utilisateurModel->delete($id_utilisateur)) {
                $_SESSION['message'] = "Nous espérons vous revoir bientôt !";
                session_unset();
                header('Location: index.php?controller=Home&action=homeAction');
                exit();
            } else {
                $_SESSION['message'] = "Erreur lors de la suppression";
                header('Location: index.php?controller=Utilisateur&action=showProfile');
                exit();
            }
        } else {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }
    }
}
