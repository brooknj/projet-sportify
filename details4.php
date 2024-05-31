<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$idcoach = intval($_GET['idcoach']);
$idclient = 1;

$sql = "SELECT * FROM coaches JOIN calendrier ON coaches.idcoach = calendrier.idcoach WHERE coaches.idcoach = $idcoach";
$result = mysqli_query($db_handle, $sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<strong>Nom :</strong> " . $row["prenom"] . " " . $row["nom"] . "<br>";
        echo "<strong>Métier :</strong> Coach <br>";
        echo "<strong>Spécialité :</strong> " . $row["specialite"] . "<br>";
        echo "<strong>Salle :</strong> " . $row["num_salle"] . "<br>";
        echo "<strong>Téléphone :</strong> 0" . $row["tel"] . "<br>";
        echo "<strong>Email :</strong> <a href='mailto:" . $row["mail"] . "'>" . $row["mail"] . "</a><br>";
        echo "<strong>Photo :</strong> <img src='" . $row["photo"] . "' alt='" . $row["prenom"] . " " . $row["nom"] . "' style='max-width: 100px;'><br>";

        echo "<table border='1'>";
        echo "<tr><th colspan='3' align='center'>Calendrier</th></tr>";
        echo "<tr><th>Jour</th><th>Matin</th><th>Après-midi</th></tr>";

        $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        foreach ($days as $day) {
            $am = $day . "am";
            $pm = $day . "pm";
            echo "<tr>";
            echo "<td>" . ucfirst($day) . "</td>";
            echo "<td style='background-color:" . ($row[$am] ? 'white' : 'black') . "; color:" . ($row[$am] ? 'black' : 'white') . ";'> </td>";
            echo "<td style='background-color:" . ($row[$pm] ? 'white' : 'black') . "; color:" . ($row[$pm] ? 'black' : 'white') . ";'> </td>";
            echo "</tr>";
        }
        echo "</table>";

        echo "<button onclick='loadMessagerie(" . $idcoach . ")'> Messagerie </button>";
        echo "<button onclick='loadRdv(" . $idcoach . ")'> Prendre un RDV </button>";
        echo "<button onclick='loadCv(" . $idcoach . ")'> Voir CV </button>";
    }
} else {
    echo "No details available for this coach.";
}

mysqli_close($db_handle);
?>
