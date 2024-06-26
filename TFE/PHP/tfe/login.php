<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .form-group {
            margin-bottom: 1em;
        }
        .toggle-password-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            white-space: nowrap;
        }
        .toggle-password-container label {
            margin-right: 0.5em;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php
        if (isset($_GET['error'])) {
            echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
        <form action="process_login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group toggle-password-container">
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
