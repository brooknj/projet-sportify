<?php
// Créer la connexion
$database = "sportify";
//identifier votre serveur, login et mot de passe
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$idcoach = intval($_GET['idcoach']);
$idclient = 1;

// Récupérer les détails du coach
$sql = "SELECT * FROM coaches JOIN calendrier ON coaches.idcoach = calendrier.idcoach WHERE coaches.idcoach = $idcoach";
$result = mysqli_query($db_handle, $sql);

if ($result && $result->num_rows > 0) {
    // Récupérer les rendez-vous du coach
    $rdv_schedule = [];
    $sql_rdv = "SELECT jour, horaire FROM rdv WHERE idcoach = $idcoach";
    $result_rdv = mysqli_query($db_handle, $sql_rdv);
    while ($row_rdv = mysqli_fetch_assoc($result_rdv)) {
        $rdv_schedule[$row_rdv['jour']][] = date('H:i', strtotime($row_rdv['horaire']));
    }

    // Afficher les détails du coach
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h1>Calendrier du coach : " . $row["prenom"] . " " . $row["nom"] . "</h1><br>";
        echo "<strong>Spécialité :</strong> " . $row["specialite"] . "<br>";
        echo "<strong>Salle :</strong> " . $row["num_salle"] . "<br>";
        echo "<strong>Téléphone :</strong> 0" . $row["tel"] . "<br>";
        echo "<strong>Email :</strong> <a href='mailto:" . $row["mail"] . "'>" . $row["mail"] . "</a><br>";
        echo "<strong>Photo :</strong> <img src='" . $row["photo"] . "' alt='" . $row["prenom"] . " " . $row["nom"] . "' style='max-width: 100px;'><br>";

        // Tableau avec les horaires qui s'affichent pour chaque demi-journée où le coach est présent
        $days = [
            'lundi' => ['lundiam', 'lundipm'],
            'mardi' => ['mardiam', 'mardipm'],
            'mercredi' => ['mercrediam', 'mercredipm'],
            'jeudi' => ['jeudiam', 'jeudipm'],
            'vendredi' => ['vendrediam', 'vendredipm'],
            'samedi' => ['samediam', 'samedipm']
        ];

        function generateTimeSlots($start, $end) {
            $times = [];
            $current = strtotime($start);
            $end = strtotime($end);
            while ($current <= $end) {
                $times[] = date('H:i', $current);
                $current = strtotime('+20 minutes', $current);
            }
            return $times;
        }

        $morningSlots = generateTimeSlots('09:00', '12:00');
        $afternoonSlots = generateTimeSlots('14:00', '18:00');

        echo "<table border='1'>";
        echo "<tr><th colspan='12' align='center'>Calendrier</th></tr>";
        echo "<tr>";
        foreach ($days as $day => $periods) {
            echo "<th colspan='2'>" . ucfirst($day) . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($days as $day => $periods) {
            echo "<th>Matin</th><th>Après-midi</th>";
        }
        echo "</tr>";

        // Générer les lignes horaires
        $maxSlots = max(count($morningSlots), count($afternoonSlots));
        for ($i = 0; $i < $maxSlots; $i++) {
            echo "<tr>";
            foreach ($days as $day => $periods) {
                foreach ($periods as $index => $period) {
                    if ($row[$period] == 1) {
                        $slots = $index == 0 ? $morningSlots : $afternoonSlots;
                        $currentSlot = isset($slots[$i]) ? $slots[$i] : null;

                        echo "<td>";
                        if ($currentSlot) {
                            $color = (isset($rdv_schedule[$day]) && in_array($currentSlot, $rdv_schedule[$day])) ? 'blue' : 'white';
                            $textColor = ($color == 'blue') ? 'white' : 'black';
                            echo "<div style='background-color: $color; color: $textColor;'>$currentSlot</div>";
                        } else {
                            echo "&nbsp;";
                        }
                        echo "</td>";
                    } else {
                        echo "<td style='background-color:black; color:white;'>&nbsp;</td>";
                    }
                }
            }
            echo "</tr>";
        }

        echo "</table>";
    }
} else {
    echo "No details available for this coach.";
}

mysqli_close($db_handle);
?>
