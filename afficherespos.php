<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$numsalle = $_GET['numsalle']; // Récupérer le numéro de salle
$idclient = 1;

$sql = "SELECT * FROM respos WHERE salle = '$numsalle'"; // Filtrer les résultats par numéro de salle
$result = mysqli_query($db_handle, $sql);
echo "<h1>". $numsalle ."</h1>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<strong>Nom :</strong> " . $row["prenom"] . " " . $row["nom"] . "<br>";
        echo "<strong>Email :</strong> <a href='mailto:" . $row["email"] . "'>" . $row["email"] . "</a><br>";
        echo "<strong>Téléphone :</strong> 0" . $row["tel"] . "<br>";

        // Vous pouvez ajouter d'autres détails si nécessaire
        echo "<br>"; // Ajoutez un séparateur entre chaque responsable
    }
} else {
    echo "No details available for this salle.";
}

mysqli_close($db_handle);
?>
