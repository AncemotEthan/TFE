<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);

include 'database.php';

// Vérifiez si le bouton est cliqué
if (isset($_POST['delete_history'])) {
    $pdo = Database::connect();
    $sql = 'DELETE FROM historique_connexions';
    $pdo->exec($sql);
    Database::disconnect();
    $message = "<p style='color: green;'>L'historique a été supprimé.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <style>
            html {
                font-family: 'Roboto', sans-serif;
                display: inline-block;
                margin: 0px auto;
                text-align: center;
            }

            ul.topnav {
                list-style-type: none;
                margin: auto;
                padding: 0;
                overflow: hidden;
                background-color: #C8AD7F; /* Brun */
                width: 70%;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                display: flex;
                justify-content: center;
            }

            ul.topnav li {
                display: inline;
                margin: 0 10px; /* Espace entre les éléments */
            }

            ul.topnav li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                transition: background-color 0.3s;
                border-radius: 5px;
            }

            ul.topnav li a:hover:not(.active) {
                background-color: #85530f; /* Couleur plus claire au survol */
            }

            ul.topnav li a.active {
                background-color: #643d08; /* Brun foncé */
            }

            ul.topnav li.right {float: right;}

            @media screen and (max-width: 600px) {
                ul.topnav {
                    flex-direction: column;
                    width: 100%;
                }

                ul.topnav li {
                    margin: 10px 0;
                }
            }

            .table {
                margin: auto;
                width: 90%; 
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            thead {
                color: #FFFFFF;
                background-color: #8B4513; /* Brun */
                border-radius: 10px;
            }

            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                width: 100%;
                max-width: 70%;
            }

            .center {
                width: 100%;
                max-width: 495px;
                border-style: solid;
                border-color: #f2f2f2;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                text-align: left;
            }

            .form-horizontal .control-group {
                margin-bottom: 15px;
            }

            .form-horizontal .control-group label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                text-align: left;
            }

            .form-horizontal .controls {
                text-align: left;
            }

            .form-horizontal .controls input, 
            .form-horizontal .controls select, 
            .form-horizontal .controls textarea {
                width: calc(100% - 22px);
                padding: 10px;
                font-size: 16px;
                margin-bottom: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .form-actions {
                text-align: center;
            }

            .form-actions button {
                background-color: #8B4513;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .form-actions button:hover {
                background-color: #A0522D;
            }
        </style>
 
        <title>Historique</title>
    </head>
 
    <body>
        <h2>Base De Données Système RFID</h2>
        <ul class="topnav">
            <li><a href="./home.php">Accueil</a></li>
            <li><a href="./user data.php">Données Utilisateurs</a></li>
            <li><a href="./registration.php">Enregistrement</a></li>
            <li><a href="./read tag.php">Lecture Tag ID</a></li>
            <li><a class="active" href="historique.php">Historique</a></li>
            <li><a href="./deconnexion.php">Déconnexion</a></li>
        </ul>
        <br>
        <div class="container">
            <?php if (isset($message)) echo $message; ?>
            <div class="row">
                <h3>Historique</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr bgcolor="#703f00" color="#FFFFFF">
                            <th>Date</th>
                            <th>Utilisateur</th>
                            <th>Statut de Connexion</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $pdo = Database::connect();
                        $sql = 'SELECT h.timestamp, 
                                        CASE 
                                            WHEN u.name IS NOT NULL THEN CONCAT(u.name, "/", h.user_id)
                                            ELSE h.user_id
                                        END as user_info, 
                                        CASE 
                                            WHEN h.statut_connexion = "acceptee" THEN "Acceptée"
                                            WHEN h.statut_connexion = "refusee" THEN "Refusée"
                                        END as statut_connexion
                                FROM historique_connexions h 
                                LEFT JOIN users_data u ON h.user_id = u.id 
                                ORDER BY h.timestamp DESC';
                        foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['timestamp'] . '</td>';
                                echo '<td>'. $row['user_info'] . '</td>';
                                echo '<td>'. $row['statut_connexion'] . '</td>';
                                echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- Bouton pour supprimer l'historique -->
            <form method="post" class="form-horizontal">
                <div class="form-actions">
                    <button type="submit" name="delete_history" class="button">Supprimer tout l'historique</button>
                </div>
            </form>
        </div> <!-- /container -->
    </body>
</html>
