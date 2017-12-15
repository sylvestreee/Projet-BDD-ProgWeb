<?php

function combinaison_connexion_valide($nom_utilisateur, $mot_de_passe) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id_utilisateur FROM UTILISATEUR
		WHERE
		login = :nom_utilisateur AND 
		mdp = :mot_de_passe");

	$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
	$requete->bindValue(':mot_de_passe', $mot_de_passe);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result['id_utilisateur'];
	}
	return false;
}

function lire_infos_utilisateur($id_utilisateur) {

	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT login, mdp, email
		FROM UTILISATEUR
		WHERE
		id_utilisateur = :id_utilisateur");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
}

function get_id()
{
	
}

function get_login()
{
	
}

