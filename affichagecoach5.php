<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$sql = "SELECT idcoach, prenom, nom FROM coaches";
$result = mysqli_query($db_handle, $sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaches</title>
    <style>
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
    </style>
    <script>
        function loadDetails(idcoach) {
            fetch('details4.php?idcoach=' + idcoach)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('details').innerHTML = data;
                });
        }
    </script>
</head>
<body>
    <ul id="coach-list">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<li onclick="loadDetails(' . $row["idcoach"] . ')">' . $row["prenom"] . ' ' . $row["nom"] . '</li>';
            }
        } else {
            echo "0 results";
        }
        mysqli_close($db_handle);
        ?>
    </ul>
</body>
</html>
