<?php
require 'database.php';

if (!empty($_POST)) {
    // Keep track of post values
    $name = $_POST['name'];
    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    try {
        // Connect to database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the ID already exists
        $sql = "SELECT COUNT(*) FROM users_data WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $count = $q->fetchColumn();

        if ($count > 0) {
            // ID already exists
            echo "Erreur : L'ID existe déjà.";
        } else {
            // Insert data
            $sql = "INSERT INTO users_data (name, id, gender, email, mobile) VALUES (?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name, $id, $gender, $email, $mobile));
            echo "Enregistrement inséré avec succès";
            header("Location: user data.php");
        }

        // Disconnect from database
        Database::disconnect();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            // Handle duplicate entry error
            echo "Erreur : Entrée en double pour la clé primaire.";
        } else {
            // Handle other PDO exceptions
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
