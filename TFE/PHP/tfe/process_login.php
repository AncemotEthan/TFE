<?php
session_start();
$host = 'localhost';
$db = 'NomDB';
$user = 'userDB';
$pass = 'MotDePasseDB';

// Création de la connexion
$conn = new mysqli($host, $user, $pass, $db);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer la requête SQL avec un paramètre de substitution
    $sql = "SELECT * FROM users_login WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Vérifier si la préparation de la requête a réussi
    if ($stmt === false) {
        die('Error: ' . htmlspecialchars($conn->error));
    }

    // Lier le paramètre de substitution
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: redirection.php");
            exit; // Terminer le script après la redirection
        } else {
            // Rediriger vers la page d'erreur de mot de passe incorrect
            header("Location: erreur_mdp.php");
            exit; // Terminer le script après la redirection
        }
    } else {
        // Rediriger vers la page d'erreur de nom d'utilisateur incorrect
        header("Location: erreur_user.php");
        exit; // Terminer le script après la redirection
    }

    $stmt->close();
} else {
    echo "Veuillez remplir tous les champs.";
}

$conn->close();
?>
