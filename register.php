<?php
// Définir les paramètres de connexion
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sportify";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$adresse_postale = $_POST['adresse_postale'];
$ville = $_POST['ville'];
$code_postal = $_POST['code_postal'];
$pays = $_POST['pays'];
$tel = $_POST['tel'];
$carte_etudiant = $_POST['carte_etudiant'];
$type_carte = $_POST['type_carte'];
$num_carte = $_POST['num_carte'];
$nom_carte = $_POST['nom_carte'];
$date_exp = $_POST['date_exp'];
$code_secu = $_POST['code_secu'];

$sql_clients = "INSERT INTO clients (nomclient, prenomclient, emailclient, adresseclient, carteEtudiante)
VALUES ('$nom', '$prenom', '$email', '$adresse_postale, $ville, $code_postal, $pays', '$carte_etudiant')";

if ($conn->query($sql_clients) === TRUE) {
    $last_id = $conn->insert_id;
    $sql_paiements = "INSERT INTO paiements (idclient, nom, prenom, email, adresse1, ville, pays, tel, typecarte, numcarte, nomcrate, dateexp, codesecu)
    VALUES ('$last_id', '$nom', '$prenom', '$email', '$adresse_postale', '$ville', '$pays', '$tel', '$type_carte', '$num_carte', '$nom_carte', '$date_exp', '$code_secu')";

    if ($conn->query($sql_paiements) === TRUE) {
        header("Location: login.html");
        exit();
    } else {
        echo "Erreur: " . $sql_paiements . "<br>" . $conn->error;
    }
} else {
    echo "Erreur: " . $sql_clients . "<br>" . $conn->error;
}

$conn->close();
?>

