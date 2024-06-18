<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>


<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<script>
			$(document).ready(function(){
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
                height: 100vh;
            }

            .center {
                width: 495px;
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
		
		<title>Lecture Tag ID</title>
	</head>
	
	<body>
		<h2 align="center">Base De Données Système RFID</h2>
		<ul class="topnav">
			<li><a href="./home.php">Accueil</a></li>
			<li><a href="./user data.php">Données Utilisateurs</a></li>
			<li><a href="./registration.php">Enregistrement</a></li>
			<li><a class="active" href="./read tag.php">Lecture Tag ID</a></li>
			<li><a href="./historique.php">Historique</a></li>
			<li><a href="./deconnexion.php">Déconnexion</a></li>
		</ul>
		
		<br>
		
		<h3 align="center" id="blink">Scannez Votre Carte RFID</h3>
		
		<p id="getUID" hidden></p>
		
		<br>
		
		<div id="show_user_data">
			<form>
				<table  width="452" border="1" bordercolor="#703f00" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#703f00"><font  color="#FFFFFF">
							<b>Données Utilisateur</b>
							</font>
						</td>
					</tr>
					<tr>
						<td  bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Nom</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr>
									<td align="left" class="lf">Genre</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Email</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
								<tr>
									<td align="left" class="lf">Numéro De Téléphone</td>
									<td style="font-weight:bold">:</td>
									<td align="left">--------</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>

		<script>
			var myVar = setInterval(myTimer, 1000);
			var myVar1 = setInterval(myTimer1, 1000);
			var oldID="";
			clearInterval(myVar1);

			function myTimer() {
				var getID=document.getElementById("getUID").innerHTML;
				oldID=getID;
				if(getID!="") {
					myVar1 = setInterval(myTimer1, 500);
					showUser(getID);
					clearInterval(myVar);
				}
			}
			
			function myTimer1() {
				var getID=document.getElementById("getUID").innerHTML;
				if(oldID!=getID) {
					myVar = setInterval(myTimer, 500);
					clearInterval(myVar1);
				}
			}
			
			function showUser(str) {
				if (str == "") {
					document.getElementById("show_user_data").innerHTML = "";
					return;
				} else {
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("show_user_data").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","read tag user data.php?id="+str,true);
					xmlhttp.send();
				}
			}
			
			var blink = document.getElementById('blink');
			setInterval(function() {
				blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
			}, 750); 
		</script>
	</body>
</html>