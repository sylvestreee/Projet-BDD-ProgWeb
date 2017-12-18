<?php

// Ajout dans la table ETAPE
function ajouter_etape_dans_bdd($id_recette, $id_ingr, $quantite_etape, $temps, $type_etape, $description) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO ETAPE SET
		id_recette		= :id_recette,
		id_ingr 		= :id_ingr,
		quantite_etape	= :quantite_etape,
		temps 			= :temps,
		type_etape 		= :type_etape,
		description 	= :description");

	$requete->bindValue(':id_recette', $id_recette);
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

// Recherche l'identifiant d'une recette à partir de son nom
function recherche_id_recette_par_nom($nom_recette)
{
	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT id_recette
		FROM RECETTE
		WHERE 
		nom_recette like :nom_recette");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->execute();
	if ($result = $requete->fetch()) 
	{
		return $result['id_recette'];
	}
	return false;
}

// Recherche l'identifiant d'un ingrédient à partir de son nom
function recherche_id_ingr_par_nom($nom_ingr)
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT id_ingr
		FROM INGREDIENT
		WHERE 
		nom_ingr = :nom_ingr");

	$requete->bindValue(':nom_ingr', $nom_ingr);
	$requete->execute();
	
	if ($result = $requete->fetch()) 
	{
		return $result['id_ingr'];
	}
	return false;
}

// Recherche les recettes créées par un utilisateur à partir de son identifiant
function recherche_recette_par_id($id_utilisateur)
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT nom_recette 
		FROM RECETTE
		WHERE 
		id_utilisateur like :id_utilisateur");

	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->execute();
	
	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) 
	{
		$requete->closeCursor();
		return $result;
	}
	return false;
}

// Recherche les ingrédients présents dans la BDD
function recherche_ingredient()
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT nom_ingr
		FROM INGREDIENT");
	
	$requete->execute();
	
	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) 
	{
		$requete->closeCursor();
		return $result;
	}
	return false;
}
