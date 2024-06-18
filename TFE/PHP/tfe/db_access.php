<?php
$servername = "localhost";
$username = "userDB";
$password = "MotDePasseDB";
$dbname = "NomDB";

// Création de la connexion
$conn = new mysqli('p:' . $servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardID = $conn->real_escape_string($_POST['cardID']); // Sécurisation des entrées

    // Vérifier les droits d'accès et enregistrer la tentative
    $sql = "SELECT user_rights FROM users_data WHERE id='$cardID' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $accessGranted = ($row['user_rights'] == 1);
        $status = $accessGranted ? 'acceptee' : 'refusee';

        // Enregistrer la tentative d'accès
        $log_sql = "INSERT INTO historique_connexions (user_id, statut_connexion) VALUES ('$cardID', '$status')";
        if ($conn->query($log_sql) === TRUE) {
            echo json_encode(['access' => $accessGranted ? 'granted' : 'denied', 'status' => 'success']);
        } else {
            echo json_encode(['access' => $accessGranted ? 'granted' : 'denied', 'status' => 'error', 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['access' => 'denied', 'status' => 'error', 'error' => 'ID not found']);
    }
}

$conn->close();
?>
