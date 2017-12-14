<?php

function ajouter_recette_dans_bdd($nom_recette, $descriptif, $difficulte, $prix, $nb_personnes) 
{
	$pdo = PDO2::getInstance();

	/* rajouter fonctions pour chopper l'id et le login de l'utilisateur courant 
	 * rajouter un s à nb_personne dans le fichier de création des tables*/
	
	$requete = $pdo->prepare("INSERT INTO RECETTE SET
		nom_recette 	= :nom_recette,
		descriptif 		= :descriptif,
		difficulte 		= :difficulte,
		prix 			= :prix,
		nb_personnes 	= :nb_personnes");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->bindValue(':descriptif', $descriptif);
	$requete->bindValue(':difficulte', $difficulte);
	$requete->bindValue(':prix', $prix);
	$requete->bindValue(':nb_personnes', $nb_personnes);

	if ($requete->execute()) {
		
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}
