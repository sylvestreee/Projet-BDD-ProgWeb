<?php

function ajouter_ingredient_dans_bdd($nom_ingr, $type_ingr) 
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("INSERT INTO INGREDIENT SET
		nom_ingr 		= :nom_ingr,
		type_ingr	 	= :type_ingr");
		
	$requete->bindValue(':nom_ingr', $nom_ingr);
	$requete->bindValue(':type_ingr', $type_ingr);
	
	if ($requete->execute()) 
	{
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

function ajouter_info_nutri_dans_bdd($id_ingr, $calories, $lipides, $glucides, $protides)
{	
	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("INSERT INTO INFORMATIONS_NUTRITIONNELLES SET
		id_ingr 	= :id_ingr,
		calories 	= :calories,
		lipides 	= :lipides,
		glucides 	= :glucides,
		protides 	= :protides");
	
	$requete->bindValue(':id_ingr', $id_ingr);
	$requete->bindValue(':calories', $calories);
	$requete->bindValue(':lipides', $lipides);
	$requete->bindValue(':glucides', $glucides);
	$requete->bindValue(':protides', $protides);
	
	if ($requete->execute()) 
	{
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}

function ajouter_regime_dans_bdd($id_ingr, $nom_regime)
{
	$pdo = PDO2::getIstance();
		
	$requete = $pdo->prepare("INSERT INTO REGIME SET
		id_ingr 		= :id_ingr,
		nom_regime		= :nom_regime");

	$requete->bindValue(':id_ingr', $id_ingr);
	$requete->bindValue(':nom_regime', $nom_regime);

	if ($requete->execute()) {
		
		return $pdo->lastInsertID();
	}
	return $requete->errorInfo();
}
