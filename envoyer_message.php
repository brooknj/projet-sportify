<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcoach = $_POST['idcoach'];
    $message = $_POST['message'];
    $idclient = 1;

    $database = "sportify";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $sql = "INSERT INTO messages (idcoach, idclient, text, sens) VALUES ('$idcoach', $idclient, '$message', '0')";
    $result = mysqli_query($db_handle, $sql);

    if ($result) {

        echo json_encode(['status' => 'success']);
    } else {

        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'envoi du message.']);
    }

    mysqli_close($db_handle);
}
?>
