<?php
    $database = "sportify";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $idclient = 1;
/*
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['idclient'])) {
            $idclient = intval($_POST['idclient']);
        }
    }*/


    if ($db_found) {
        $erreur = false;
        $errorMessage = "";

        $sql = "SELECT * FROM rdv JOIN coaches ON coaches.idcoach=rdv.idcoach WHERE idclient = $idclient";
        
        if (!$erreur){
            echo "<h1>Listes RDV</h1>";
            $result = mysqli_query($db_handle, $sql);
            echo "<table border=\"1\">";
            echo "<tr>";
            echo "<th>Nom</th>";
            echo "<th>Prénom</th>";
            echo "<th>Horaire</th>";
            echo "<th>Jour</th>";
            echo "<th>Salle</th>";
            echo "</tr>";

            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['nom'] . "</td>";
                echo "<td>" . $data['prenom'] . "</td>";
                echo "<td>" . $data['horaire'] . "</td>";
                echo "<td>" . $data['jour'] . "</td>";
                echo "<td>" . $data['salle'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




        }else {
            echo $errorMessage . "<br>";
        } 

    } else {
        echo "<br>Database not found"; 
    }   
    

    // Close the connection
    mysqli_close($db_handle);
        


?>
