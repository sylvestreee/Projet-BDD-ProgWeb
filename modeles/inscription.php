<?php

function ajouter_membre_dans_bdd($nom_utilisateur, $prenom, $nom, $mdp, $adresse_email) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("INSERT INTO UTILISATEUR SET
		login 				= :nom_utilisateur,
		prenom 				= :prenom,
		nom_utilisateur 	= :nom,
		mdp 				= :mot_de_passe,
		email 				= :adresse_email");

	$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
	$requete->bindValue(':prenom',   		$prenom);
	$requete->bindValue(':nom',   			$nom);
	$requete->bindValue(':mot_de_passe',    $mdp);
	$requete->bindValue(':adresse_email',   $adresse_email);

	if ($requete->execute()) {
		
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}
