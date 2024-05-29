<?php
    // Database connection
    $database = "sportify";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $choice = isset($_POST["button1"]) ? $_POST["button1"] : "";
    
    $recherche = isset($_POST["recherche"]) ? $_POST["recherche"] : "";
    
    echo "mot ". $recherche . "<br>";
    echo "recherche ". $choice;
    if ($db_found) {
        $erreur = false;
        $errorMessage = "";
        
        switch ($choice) {
            case "":
                $sql = "SELECT * FROM coaches WHERE prenom LIKE '%" . $recherche . "%' OR nom LIKE '%" . $recherche . "%' OR specialite LIKE '%" . $recherche . "%'";

                break;
            
            default:
                $sql = "SELECT * FROM coaches WHERE prenom = 'Alice'";
                break;
        }
        
        if (!$erreur) {
            echo "<h1>Résultat</h1>";
            echo "<p>Requete: " . $sql . "<br>";
            echo "Résultat: </p>";

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
