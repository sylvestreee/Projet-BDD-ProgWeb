<!DOCTYPE html>
<html lang = "fr" >
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Martin HEITZ">
	<title>Inscription/Connexion (php)</title>
</head>
	
<body>
	<h1>Hello Select</h1>

	<?php
		$db_username = "martin_heitz";
		$db_password = "bddlove68";

		$db = "oci:dbname=//osr-oracle.unistra.fr:1521/osr";
		try 
		{
			//Connexion a la base de donnees oracle
			$conn = new PDO($db,$db_username,$db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("INSERT INTO UTILISATEUR VALUES (0, :login, :prenom, :nom, :mail, :mdp)");
			$stmt->bindParam(':login', $login);
			$stmt->bindParam(':prenom', $prenom);
			$stmt->bindParam(':nom', $nom);
			$stmt->bindParam(':mail', $mail);
			$stmt->bindParam(':mdp', $mdp);

			// insertion d'une ligne
			if (isset($_POST['Login2']) 
				&& isset($_POST['Prenom']) 
				&& isset($_POST['Nom'])
				&& isset($_POST['Mail'])
				&& isset($_POST['Mdp']))
			{
				$login = $_POST['Login2'];
				$prenom = $_POST['Prenom'];
				$nom = $_POST['Nom'];
				$mail = $_POST['Mail'];
				$mdp = $_POST['Mdp'];
			}
			$stmt->execute();
		} 

		catch(PDOException $e) 
		{
			echo "Echec connexion : ".$e->getMessage();
			exit;
		}
	?>
</body>
</html>