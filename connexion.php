<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialiser les variables pour stocker les messages de validation
    $message = "";
    $role = "";

    // Déterminer quel formulaire a été soumis en vérifiant les champs spécifiques
    if (isset($_POST['adminnom']) && isset($_POST['adminprenom']) && isset($_POST['adminmail'])) {
        $role = "Administrateur";
        $nom = trim($_POST['adminnom']);
        $prenom = trim($_POST['adminprenom']);
        $email = trim($_POST['adminmail']);
        
        if (!empty($nom) && !empty($prenom) && !empty($email)) {
            // Vous pouvez ajouter ici une validation supplémentaire comme la vérification de l'email
            $message = "Compte $role validé avec succès !";
        } else {
            $message = "Veuillez remplir tous les champs pour l'Administrateur.";
        }
    } elseif (isset($_POST['coachnom']) && isset($_POST['coachprenom']) && isset($_POST['coachmail'])) {
        $role = "Coach";
        $nom = trim($_POST['coachnom']);
        $prenom = trim($_POST['coachprenom']);
        $email = trim($_POST['coachmail']);
        
        if (!empty($nom) && !empty($prenom) && !empty($email)) {
            // Vous pouvez ajouter ici une validation supplémentaire comme la vérification de l'email
            $message = "Compte $role validé avec succès !";
        } else {
            $message = "Veuillez remplir tous les champs pour le Coach.";
        }
    } elseif (isset($_POST['clientnom']) && isset($_POST['clientprenom']) && isset($_POST['clientadresse']) && isset($_POST['clientmail']) && isset($_POST['clientcarteEtudiante'])) {
        $role = "Client";
        $nom = trim($_POST['clientnom']);
        $prenom = trim($_POST['clientprenom']);
        $adresse = trim($_POST['clientadresse']);
        $email = trim($_POST['clientmail']);
        $carteEtudiante = trim($_POST['clientcarteEtudiante']);
        
        if (!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($email) && !empty($carteEtudiante)) {
            // Vous pouvez ajouter ici une validation supplémentaire comme la vérification de l'email
            $message = "Compte $role validé avec succès !";
        } else {
            $message = "Veuillez remplir tous les champs pour le Client.";
        }
    } else {
        $message = "Formulaire non reconnu.";
    }

    // Afficher le message de validation
    echo "<h1>$message</h1>";
}
?>
