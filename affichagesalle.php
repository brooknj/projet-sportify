<?php
// Créer la connexion
$database = "sportify";
// Identifier votre serveur, login et mot de passe
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// Récupérer la liste des coaches
$sql = "SELECT * FROM salles";
$result = mysqli_query($db_handle, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
        }
        .names {
            width: 30%;
            border-right: 1px solid #ddd;
            padding: 10px;
        }
        .details {
            width: 70%;
            padding: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            cursor: pointer;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        li:hover {
            background-color: #f0f0f0;
        }
        .details {
            display: none;
            border: 1px solid #ddd;
            padding: 10px;
            margin-left: 10px;
        }
        .details.show {
            display: block;
        }
    </style>
    <script>
        function loadSalle(numsalle) {
            fetch('afficherespos.php?numsalle=' + numsalle)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detail-content').innerHTML = data;
                    document.getElementById('coach-details').classList.add('show');
                });
        }

    </script>
</head>
<body>
    <div class="container">
        <div class="names">
            <ul id="coach-list">
                <?php
                if ($result->num_rows > 0) {
                    // Afficher les noms des coaches
                    while($row = $result->fetch_assoc()) {
                        echo '<li onclick="loadSalle(\'' . $row["numsalle"] . '\')">' . $row["numsalle"] . ' ' . $row["photosalle"] . '</li>';

                    }
                } else {
                    echo "0 results";
                }
                mysqli_close($db_handle);
                ?>
            </ul>
        </div>

        <div class="details" id="coach-details">
            <h2>Salle</h2>
            <p id="detail-content">Sélectionnez une salle</p>
        </div>
    </div>
</body>
</html>
