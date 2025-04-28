<?php

namespace elitedrive\Controllers;

use elitedrive\Models\MailsModel;

class ContactController extends Controller
{
    public function newsletter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mailModel = new MailsModel();
                $subject = "Bienvenue sur la newsletter d'EliteDrive !";
                $body = file_get_contents(__DIR__ . '/../Views/mails/newsletter.php');
                $to = $email;

                if ($mailModel->sendMail($to, $subject, $body)) {
                    echo json_encode(['status' => 'success', 'message' => 'Vous êtes maintenant abonné(e) à notre newsletter !']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'envoi de l\'email.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Adresse email invalide.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
        }
    }

    public function contactUtilisateur()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mailModel = new MailsModel();

                $subject = "Demande de contact d'EliteDrive - {$prenom} {$nom}";
                $body = file_get_contents(__DIR__ . '/../Views/mails/contactUtilisateur.php');
                $body = str_replace(
                    ['{{nom}}', '{{prenom}}', '{{email}}', '{{message}}'],
                    [$nom, $prenom, $email, nl2br(htmlspecialchars($message))],
                    $body
                );

                $fromEmail = $email;
                $fromName = $prenom . ' ' . $nom;
                $to = 'elitedrive.rh@elite.fr';
                $adminMailSent = $mailModel->sendMail($to, $subject, $body, $fromEmail, $fromName);

                $subject = "Confirmation de votre message - EliteDrive";
                $body = file_get_contents(__DIR__ . '/../Views/mails/mailConfirmationContact.php');
                $body = str_replace(
                    ['{{nom}}', '{{prenom}}', '{{email}}', '{{message}}'],
                    [$nom, $prenom, $email, nl2br(htmlspecialchars($message))],
                    $body
                );

                $to = $email;
                $fromEmail = 'no-reply@elitedrive.fr';
                $fromName = 'EliteDrive';
                $userMailSent = $mailModel->sendMail($to, $subject, $body, $fromEmail, $fromName);

                if ($adminMailSent && $userMailSent) {
                    echo json_encode(['status' => 'success', 'message' => 'Votre message a bien été envoyé !']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'envoi de l\'email.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Veuillez remplir tous les champs correctement.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée.']);
        }
    }
}
