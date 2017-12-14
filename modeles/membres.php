<?php

function combinaison_connexion_valide($nom_utilisateur, $mot_de_passe) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id FROM membres
		WHERE
		nom_utilisateur = :nom_utilisateur AND 
		mot_de_passe = :mot_de_passe");

	$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
	$requete->bindValue(':mot_de_passe', $mot_de_passe);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result['id'];
	}
	return false;
}

function lire_infos_utilisateur($id_utilisateur) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT nom_utilisateur, mot_de_passe, adresse_email
		FROM membres
		WHERE
		id = :id_utilisateur");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
}

