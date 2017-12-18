<?php

function ajouter_repas_dans_bdd($id_utilisateur, $date_repas, $heure) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO REPAS SET
		id_utilisateur		= :id_utilisateur,
		date_repas			= :date_repas,
		heure				= :heure");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->bindValue(':date_repas', $date_repas);
	$requete->bindValue(':heure', $heure);

	if ($requete->execute())
	{	
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

function ajouter_repas_recette_dans_bdd($id_recette, $id_repas) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO REPAS_RECETTE SET
		id_recette			= :id_recette,
		id_repas			= :id_repas");

	$requete->bindValue(':id_recette', $id_recette);
	$requete->bindValue(':id_repas', $id_repas);
	
	if ($requete->execute())
	{	
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

// Recherche les recettes présents dans la BDD
function recherche_recette()
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT nom_recette
		FROM RECETTE");
	
	$requete->execute();
	
	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) 
	{
		$requete->closeCursor();
		return $result;
	}
	return false;
}