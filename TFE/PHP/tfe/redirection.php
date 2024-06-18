<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

// Rediriger vers la page d'accueil après connexion réussie
header("Location: ./home.php");
exit;
?>
