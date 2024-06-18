<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<?php
    $Write = "<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php', $Write);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getUID").load("UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("UIDContainer.php");
            }, 500);
        });
    </script>
    
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
                width: 100%; /* Prend toute la largeur sur les petits écrans */
                border-radius: 0;
            }

            ul.topnav li {
                margin: 10px 0;
            }

            .container {
                max-width: 90%; /* Ajustez la largeur du conteneur pour les petits écrans */
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
            margin-top: 50px; /* Ajoutez cette ligne pour décaler le contenu vers le bas */
            width: 100%;
            max-width: 70%; /* Ajustez cette ligne pour aligner avec la barre de navigation sur les grands écrans */
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
    
    <title>Enregistrement</title>
</head>
    
<body>

    <h2>Base De Données Système RFID</h2>
    <ul class="topnav">
        <li><a href="./home.php">Accueil</a></li>
        <li><a href="./user data.php">Données Utilisateurs</a></li>
        <li><a class="active" href="./registration.php">Enregistrement</a></li>
        <li><a href="./read tag.php">Lecture Tag ID</a></li>
        <li><a href="./historique.php">Historique</a></li>
        <li><a href="./deconnexion.php">Déconnexion</a></li>
    </ul>

    <div class="container">
        <div class="center">
            <div class="row">
                <h3 align="center">Formulaire D'Enregistrement</h3>
            </div>
            <form class="form-horizontal" action="insertDB.php" method="post">
                <div class="form-group">
                    <label for="getUID" class="control-label">ID</label>
                    <div class="controls">
                        <textarea name="id" id="getUID" placeholder="Scannez Votre Carte" rows="1" cols="1" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="div_refresh" class="control-label">Nom</label>
                    <div class="controls">
                        <input id="div_refresh" name="name" type="text" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gender" class="control-label">Genre</label>
                    <div class="controls">
                        <select name="gender" id="gender" class="form-control form-control-lg" style="height: 3em; width: 100%;">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <div class="controls">
                        <input name="email" type="email" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile" class="control-label">Numéro De Téléphone</label>
                    <div class="controls">
                        <input name="mobile" type="tel" class="form-control" placeholder="" required>
                    </div>
                </div>

                <div class="form-actions text-center">
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div> <!-- /container -->    
</body>
</html>
