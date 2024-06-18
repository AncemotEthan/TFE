<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $user_rights = isset($_POST['user_rights']) ? 1 : 0;

    $pdo = Database::connect();
    $sql = "UPDATE users_data SET user_rights=? WHERE id=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($user_rights, $id));
    Database::disconnect();
}

header("Location: user data.php");
?>
