<?php
$servername = "localhost";
$username = "root";
$password = "yourpassword";


// Créer la connexion

$database = "coachTest";
//identifier votre serveur, login et mot de passe
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


$id = intval($_GET['id']);

// Récupérer les détails du coach
$sql = "SELECT * FROM coaches WHERE id = $id";
$result = mysqli_query($db_handle, $sql);

if ($result->num_rows > 0) {
    // Afficher les détails du coach
    while($row = $result->fetch_assoc()) {
        echo "<strong>Name:</strong> " . $row["first_name"] . " " . $row["last_name"] . "<br>";
        echo "<strong>Job Title:</strong> " . $row["job_title"] . "<br>";
        echo "<strong>Specialty:</strong> " . $row["specialty"] . "<br>";
        echo "<strong>Room:</strong> " . $row["room"] . "<br>";
        echo "<strong>Phone:</strong> " . $row["phone"] . "<br>";
        echo "<strong>Email:</strong> <a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a><br>";
        echo "<strong>Photo:</strong> <img src='" . $row["photo"] . "' alt='" . $row["first_name"] . " " . $row["last_name"] . "' style='max-width: 100px;'><br>";
        echo "<strong>Schedule:</strong> " . $row["schedule"] . "<br>";
    }
} else {
    echo "No details available for this coach.";
}

mysqli_close($db_handle);
?>
