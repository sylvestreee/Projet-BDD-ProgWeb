<?php

function ajouter_membre_dans_bdd($nom_utilisateur, $mdp, $adresse_email) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("INSERT INTO UTILISATEUR SET
		login = :nom_utilisateur,
		mdp = :mot_de_passe,
		email = :adresse_email");

	$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
	$requete->bindValue(':mot_de_passe',    $mdp);
	$requete->bindValue(':adresse_email',   $adresse_email);

	if ($requete->execute()) {
		
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}
