<?php
// Démarrer une session
session_start();

// Database connection
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Protection contre les injections SQL
        $email = mysqli_real_escape_string($db_handle, $email);

        if ($password == '1') {
            // Vérification pour les clients
            $sql = "SELECT idclient FROM clients WHERE emailclient='$email'";
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['idclient'];
                $_SESSION['role'] = 'client';
                header("Location: Accueil.html?userType=u&id=" . $user['idclient']); // Ajout du paramètre userType=u
                exit();
            } else {
                echo "Adresse e-mail client non trouvée.";
            }
        } elseif ($password == '2') {
            // Vérification pour les coaches
            $sql = "SELECT idcoach FROM coaches WHERE mail='$email'";
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['idcoach'];
                $_SESSION['role'] = 'coach';
                header("Location: accueilc.html?userType=c&id=" . $user['idcoach']); // Ajout du paramètre userType=c
                exit();
            } else {
                echo "Adresse e-mail coach non trouvée.";
            }
        } elseif ($password == '3') {
            // Vérification pour les admins
            $sql = "SELECT idadmin FROM admins WHERE email='$email'";
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['idadmin'];
                $_SESSION['role'] = 'admin';
                header("Location: admin.html?userType=a&id=" . $user['idadmin']); // Ajout du paramètre userType=a
                exit();
            } else {
                echo "Adresse e-mail admin non trouvée.";
            }
        } else {
            echo "Mot de passe invalide.";
        }
    }
} else {
    echo "Database not found.";
}
?>
