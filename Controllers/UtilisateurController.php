<?php

namespace elitedrive\Controllers;

use elitedrive\Models\UtilisateurModel;
use elitedrive\Entities\Utilisateur;
use elitedrive\Models\AvisModel;
use elitedrive\Models\Demande_ReservationModel;
use elitedrive\Models\ReservationModel;
use elitedrive\Models\MailsModel;

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
            $nom = htmlspecialchars($_POST['name']);
            $prenom = htmlspecialchars($_POST['surname']);
            $mot_de_passe = trim($_POST['password']);
            $numero_telephone = trim($_POST['tel']);
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $ville = htmlspecialchars(($_POST['city']));
            $role = 0;

            if ($role != 0) {
                $role = 0;
            }


            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message[] = "Email Invalide";
            }

            if (!preg_match('/^\+?[0-9]{10,15}$/', $numero_telephone)) {
                $message[] = "Numéro de téléphone invalide";
            }

            if (strlen($mot_de_passe) < 8) {
                $message[] = " Le mot de passe doit contenir au moins 8 caractères.";
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
                session_regenerate_id(true);
                $_SESSION['id_utilisateur'] = $utilisateur->getId_utilisateur();
                $_SESSION['email'] = $utilisateur->getEmail();
                $_SESSION['numero_telephone'] = $utilisateur->getNumero_telephone();
                $_SESSION['role'] = $utilisateur->getRole();
                $_SESSION['nom'] = $utilisateur->getNom();
                $_SESSION['prenom'] = $utilisateur->getPrenom();
                $_SESSION['ville'] = $utilisateur->getVille();
                $_SESSION['crsf_token'] = bin2hex(random_bytes(32));

                $mailModel = new MailsModel();
                $subject = "Bienvenue sur EliteDrive !";
                $body = file_get_contents(__DIR__ . '/../Views/mails/subUt.php');
                $to = $email;
                $mailModel->sendMail($to, $subject, $body);
                
               
                header('Location: index.php?controller=Utilisateur&action=showProfile');
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
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $mot_de_passe = trim($_POST['password']);
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->connect($email, $mot_de_passe);
            if ($utilisateur) {
                session_regenerate_id(true);
                $_SESSION['id_utilisateur'] = $utilisateur->id_utilisateur;
                $_SESSION['email'] = $utilisateur->email;
                $_SESSION['role'] = $utilisateur->role;
                $_SESSION['nom'] = $utilisateur->nom;
                $_SESSION['prenom'] = $utilisateur->prenom;
                $_SESSION['ville'] = $utilisateur->ville;
                $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
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
            session_unset();
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
            if (empty($id_utilisateur)) {
                header('Location: index.php?controller=Utilisateur&action=connectForm');
                exit();
            }
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

        $id_utilisateur = $_SESSION['id_utilisateur'];
        $id_utilisateur_get = $_GET['id_utilisateur'] ?? $id_utilisateur;
        if ($id_utilisateur != $id_utilisateur_get) {
            header('Location: index.php?controller=Utilisateur&action=showProfile');
            exit();
        }

        if (!isset($id_utilisateur)) {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit;
        } else {
            $token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
            $_SESSION['message'] = "";
            $this->render('utilisateur/updateForm', ['utilisateur' => $utilisateur, 'token' => $token]);
        }
    }
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])){
                header('Location: index.php?controller=Utilisateur&action=updateForm');
                exit();
            }
            $id_utilisateur = filter_input(INPUT_POST, 'id_utilisateur', FILTER_VALIDATE_INT);
            $nom = htmlspecialchars($_POST['name']);
            $prenom = htmlspecialchars($_POST['surname']);
            $numero_telephone = trim($_POST['tel']);
            $ville = htmlspecialchars($_POST['city']);
            $email = filter_var(($_POST['email']), FILTER_SANITIZE_EMAIL);
            $role = 0;

            if ($role != 0) {
                $role = 0;
            }
            if (empty($nom) || empty($prenom) || empty($numero_telephone) || empty($ville) || empty($email)) {
                $_SESSION['message'] = "Veuillez remplir tous les champs.";
                header('Location: index.php?controller=Utilisateur&action=updateForm');
                exit();
            }
            $utilisateurModel = new UtilisateurModel();
            $testMail = $utilisateurModel->displayOne($id_utilisateur);

            if ($email !== $testMail->email() && $utilisateurModel->checkEmailExists($email)) {
                $_SESSION['message'] = "L'email est déjà utilisé par un autre utilisateur.";
                header('Location: index.php?controller=Utilisateur&action=updateForm');
                exit();
            }
            $utilisateur = new Utilisateur();
            $utilisateur->setId_utilisateur($id_utilisateur);
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);
            $utilisateur->setNumero_telephone($numero_telephone);
            $utilisateur->setVille($ville);
            $utilisateur->setEmail($email);
            $utilisateur->setRole($role);

            if ($utilisateurModel->update($utilisateur)) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                $_SESSION['message'] = "";
                header('Location: index.php?controller=Utilisateur&action=showProfile');
            } else {
                $_SESSION['message'] = "Erreur lors de la modification";
                $this->render('utilisateur/updateForm', ['utilisateur' => $utilisateur]);
            }
        }
    }


    public function deletePage()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }

        if (isset($_GET['id_utilisateur']) && intval($_GET['id_utilisateur']) === $_SESSION['id_utilisateur']) {
            $token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $this->render('utilisateur/deletePage', ['token' => $token]);
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

        if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            header('Location: index.php?controller=Utilisateur&action=deletePage');
            exit();
        }

        if (isset($_GET['id_utilisateur']) && intval($_GET['id_utilisateur']) === $_SESSION['id_utilisateur']) {
            $id_utilisateur = intval($_GET['id_utilisateur']);
            $utilisateurModel = new UtilisateurModel();

            $demandeModel = new Demande_ReservationModel();
            $demandeModel->deleteByIdUser($id_utilisateur);

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

    public function resetPasswordVerif()
    {
        if (!isset($_SESSION['id_utilisateur'])) {
            header('Location: index.php?controller=Utilisateur&action=connectForm');
            exit();
        }

        $id_utilisateur = $_SESSION['id_utilisateur'];
        $token = $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->displayOne($id_utilisateur);
        if (!$utilisateur) {
            $_SESSION['message'] = "Utilisateur introuvable.";
            header('Location: index.php?controller=Utilisateur&action=showProfile');
            exit();
        }
        $this->render('utilisateur/resetPasswordVerif', ['utilisateur' => $utilisateur, 'token' => $token]);
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                header('Location: index.php?controller=Utilisateur&action=resetPasswordVerif');
                exit();
            }
            $id_utilisateur = $_SESSION['id_utilisateur'];
            $current_password = trim($_POST['current_password']);
            $new_password = trim($_POST['password']);

            $utilisateurModel = new UtilisateurModel();
            $utilisateur = $utilisateurModel->displayOne($id_utilisateur);

            if (password_verify($current_password, $utilisateur->mot_de_passe)) {
                if (strlen($new_password) < 8) {
                    $_SESSION['message'] = "Le mot de passe doit contenir au moins 8 caractères.";
                } elseif (!preg_match('/[A-Z]/', $new_password) || !preg_match('/[a-z]/', $new_password)) {
                    $_SESSION['message'] = "Le mot de passe doit contenir une majuscule et une minuscule.";
                } elseif (!preg_match('/\d/', $new_password)) {
                    $_SESSION['message'] = "Le mot de passe doit contenir au moins un chiffre.";
                } elseif (!preg_match('/[@$!%*?&]/', $new_password)) {
                    $_SESSION['message'] = "Le mot de passe doit contenir au moins un symbole spécial (@$!%*?&).";
                } else {
                    $mot_de_passe_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    if ($utilisateurModel->updatePassword($id_utilisateur, $mot_de_passe_hash)) {
                        $_SESSION['message'] = "Mot de passe mis à jour avec succès.";
                        header('Location: index.php?controller=Utilisateur&action=showProfile');
                        exit();
                    } else {
                        $_SESSION['message'] = "Erreur lors de la mise à jour du mot de passe.";
                    }
                }
            } else {
                $_SESSION['message'] = "Mot de passe actuel incorrect.";
            }
        }

        header('Location: index.php?controller=Utilisateur&action=resetPasswordVerif');
        exit();
    }
}
