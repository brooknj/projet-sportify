<?php
$servername = "localhost";
$username = "root";
$password = "yourpassword";


// Créer la connexion

$database = "sportify";
//identifier votre serveur, login et mot de passe
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


$id = intval($_GET['id']);

// Récupérer les détails du coach
$sql = "SELECT * FROM coaches WHERE idcoach = $id";
$result = mysqli_query($db_handle, $sql);

if ($result->num_rows > 0) {
    // Afficher les détails du coach
    while($row = $result->fetch_assoc()) {
        echo "<strong>Name:</strong> " . $row["prenom"] . " " . $row["nom"] . "<br>";
        echo "<strong>Job Title:</strong> Coach <br>";
        echo "<strong>Specialty:</strong> " . $row["specialite"] . "<br>";
        echo "<strong>Room:</strong> " . $row["num_salle"] . "<br>";
        echo "<strong>Phone:</strong> " . $row["tel"] . "<br>";
        echo "<strong>Email:</strong> <a href='mailto:" . $row["mail"] . "'>" . $row["mail"] . "</a><br>";
        echo "<strong>Photo:</strong> <img src='" . $row["photo"] . "' alt='" . $row["prenom"] . " " . $row["nom"] . "' style='max-width: 100px;'><br>";

    }
} else {
    echo "No details available for this coach.";
}

mysqli_close($db_handle);
?>
