<?php
$database = "sportify";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$idcoach = intval($_GET['idcoach']);
$idclient = 1;

$sql = "SELECT * FROM messages JOIN coaches ON messages.idcoach = coaches.idcoach JOIN clients ON messages.idclient = clients.idclient WHERE messages.idcoach = $idcoach AND messages.idclient = $idclient";
$result = mysqli_query($db_handle, $sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row["sens"] == 1) {
            echo "<p>" . $row["nom"] . " " . $row["prenom"] . " : " . $row["text"] . "</p>";
        } else {
            echo "<p>" . $row["nomclient"] . " " . $row["prenomclient"] . " : " . $row["text"] . "</p>";
        }
    }
} else {
    echo "No conversation available.";
}

mysqli_close($db_handle);
?>

<!-- Formulaire pour envoyer un nouveau message -->
<form action="envoyer_message.php" method="post">
    <input type="hidden" name="idcoach" value="<?php echo $idcoach; ?>">
    <textarea name="message" rows="4" cols="50" placeholder="Votre message..."></textarea><br>
    <input type="submit" value="Envoyer">
</form>
