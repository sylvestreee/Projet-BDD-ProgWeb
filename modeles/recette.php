<?php

function ajouter_recette_dans_bdd($nom_recette, $descriptif, $id_utilisateur, $auteur, $difficulte, $prix, $nb_personnes) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO RECETTE SET
		nom_recette 	= :nom_recette,
		descriptif 		= :descriptif,
		id_utilisateur	= :id_utilisateur,
		auteur 			= :auteur,
		difficulte 		= :difficulte,
		prix 			= :prix,
		nb_personnes 	= :nb_personnes");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->bindValue(':descriptif', $descriptif);
	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->bindValue(':auteur', $auteur);
	$requete->bindValue(':difficulte', $difficulte);
	$requete->bindValue(':prix', $prix);
	$requete->bindValue(':nb_personnes', $nb_personnes);

	if ($requete->execute())
	{	
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

function recherche_recette_par_nom($demande)
{
	$pdo = PDO2::getInstance();
	
	
	$phrase = "%";
	$phrase .= $demande;
	$phrase .= "%";
	
	$requete = $pdo->prepare("SELECT id_recette,nom_recette 
		FROM RECETTE
		WHERE 
		nom_recette like :phrase%");

	$requete->bindValue(':phrase', $phrase);
	
	var_dump($requete);
	
	$requete->execute();
	
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
	
}
