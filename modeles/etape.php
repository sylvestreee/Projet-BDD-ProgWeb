<?php

function ajouter_etape_dans_bdd($id_recette, $id_ingr, $quantite_etape, $temps, $type_etape, $description) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO RECETTE SET
		id_recette		= :id_recette,
		id_ingr 		= :id_ingr,
		quantite_etape	= :quantite_etape,
		temps 			= :temps,
		type_etape 		= :type_etape,
		description 	= :description");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->bindValue(':id_ingr', $id_ingr);
	$requete->bindValue(':quantite_etape', $quantite_etape);
	$requete->bindValue(':temps', $temps);
	$requete->bindValue(':type_etape', $type_etape);
	$requete->bindValue(':description', $description);

	if ($requete->execute())
	{	
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

function recherche_id_recette_par_nom($nom_recette)
{
	echo $nom_recette;
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT id_recette
		FROM RECETTE
		WHERE 
		nom_recette like :nom_recette");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->execute();
	
	if ($result = $requete->fetch()) 
	{
		echo $result;
		return $result;
	}
	return false;
}

function recherche_id_ingr_par_nom($nom_ingr)
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT id_ingr
		FROM INGREDIENT
		WHERE 
		nom_ingr like :nom_ingr");

	$requete->bindValue(':nom_ingr', $nom_ingr);
	$requete->execute();
	
	if ($result = $requete->fetch()) 
	{
		return $result;
	}
	return false;
}
