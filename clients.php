<?php
    // Database connection
    $database = "sportify";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    $choice = isset($_POST["button2"]) ? $_POST["button2"] : "";

    $recherche = isset($_POST["recherche"]) ? $_POST["recherche"] : "";
    if ($db_found) {
        $erreur = false;
        $errorMessage = "";

        switch ($choice) {
            case "":
                $sql = "SELECT * FROM clients WHERE prenomclient LIKE '%" . $recherche . "%' OR nomclient LIKE '%" . $recherche . "%'";

                break;

            default:
                $sql = "SELECT * FROM clients WHERE prenomclient = 'Paul'";
                break;
        }

        if (!$erreur) {
            $result = mysqli_query($db_handle, $sql);
            echo "<table border=\"1\">";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nom</th>";
            echo "<th>Prénom</th>";
            echo "<th>Email</th>";
            echo "<th>Adresse</th>";
            echo "</tr>";

            // Afficher le résultat
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['idclient'] . "</td>";
                echo "<td>" . $data['nomclient'] . "</td>";
                echo "<td>" . $data['prenomclient'] . "</td>";
                echo "<td>" . $data['emailclient'] . "</td>";
                echo "<td>" . $data['adresseclient'] . "</td>";
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

