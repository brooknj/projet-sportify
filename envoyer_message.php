<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $idcoach = $_POST['idcoach'];
    $message = $_POST['message'];

    // Effectuer la connexion à la base de données
    $database = "sportify";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    // Insérer le nouveau message dans la base de données
    $sql = "INSERT INTO messages (idcoach, idclient, text, sens) VALUES ('$idcoach', '1', '$message', '1')";
    $result = mysqli_query($db_handle, $sql);

    // Vérifier si l'insertion a réussi
    if ($result) {
        // Rediriger l'utilisateur vers messagerie.php
        header("Location: messagerie2.php?idcoach=$idcoach");
        exit(); // Assurer l'arrêt du script après la redirection
    } else {
        echo "Erreur lors de l'envoi du message.";
    }

    // Fermer la connexion à la base de données
    mysqli_close($db_handle);
}
?>
