<?php
// Database connection
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$choice = isset($_POST["button1"]) ? $_POST["button1"] : "";

$recherchenom = isset($_POST["nomrech"]) ? $_POST["nomrech"] : "";
$salle = isset($_POST["sallerech"]) ? $_POST["sallerech"] : "";
$spe = isset($_POST["sperech"]) ? $_POST["sperech"] : "";




if ($db_found) {
    $erreur = false;
    $errorMessage = "";
    $sql = "SELECT * FROM coaches WHERE 1";

    // Vérifier si le champ nom est saisi
    if (!empty($recherchenom)) {
        $sql .= " AND (prenom LIKE '%" . $recherchenom . "%' OR nom LIKE '%" . $recherchenom . "%')";
    }

    // Vérifier si le champ spécialité est saisi
    if (!empty($spe)) {
        $sql .= " AND specialite LIKE '%" . $spe . "%'";
    }

    // Vérifier si le champ salle est saisi
    if (!empty($salle)) {
        $sql .= " AND num_salle LIKE '%" . $salle . "%'";
    }



    if (!$erreur) {
        echo "<h1>Résultat</h1>";
        //echo "<p>Requete: " . $sql . "<br>";
        //echo "Résultat: </p>";

        $result = mysqli_query($db_handle, $sql);
        echo "<table border=\"1\">";
        echo "<tr>";
        echo "<th>Nom</th>";
        echo "<th>Prénom</th>";
        echo "<th>Spécialité</th>";
        echo "<th>Salle</th>";
        echo "<th>Photo</th>";
        echo "</tr>";

        // Afficher le résultat
        while ($data = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $data['prenom'] . "</td>";
            echo "<td>" . $data['nom'] . "</td>";
            echo "<td>" . $data['specialite'] . "</td>";
            echo "<td>" . $data['num_salle'] . "</td>";
            $image = $data['photo'];
            echo "<td><img src='$image' height='60' width='80'></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo $errorMessage . "<br>";
    }
} else {
    echo "<br>Database not found";
}

// Close the connection
mysqli_close($db_handle);
?>

