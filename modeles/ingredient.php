<?php

function ajouter_recette_dans_bdd($nom_ingredient, $type_ingredient, $calories, $lipides, $glucides, $protides, $nom_regime) 
{
	//table INGREDIENT
	$pdo = PDO2::getInstance();
	
	//table INFORMATIONS_NUTRITIONNELLES
	$pdo1 = PDO2::getInstance();
	
	//table REGIME
	$pdo2 = PDO2::getIstance();
	
	$requete = $pdo->prepare("INSERT INTO INGREDIENT SET
		nom_ingredient 	= :nom_ingredient,
		type	 		= :type_ingredient");
		
	$requete->bindValue(':nom_ingredient', $nom_ingedient);
	$requete->bindValue(':type_ingredient', $type_ingredient);
	
	if ($requete->execute()) {
		
		return $pdo->lastInsertID();
	}
		
	//récupérer l'id de l'ingrédient
	$requete1 = $pdo1->prepare("INSERT INTO INFORMATIONS_NUTRITIONNELLES SET
		calories 	= :calories,
		lipides 	= :lipides,
		glucides 	= :glucides,
		protides 	= :protides");
		
	$requete1->bindValue(':calories', $calories);
	$requete1->bindValue(':lipides', $lipides);
	$requete1->bindValue(':glucides', $glucides);
	$requete1->bindValue(':protides', $protides);
	
	if ($requete1->execute()) {
		
		return $pdo1->lastInsertID();
	}
		
	//liaisons entre ingrédient et régime ?
	$requete2 = $pdo2->prepare("INSERT INTO REGIME SET
		nom_regime		= :nom_regime");

	$requete2->bindValue(':nom_regime', $nom_regime);

	if ($requete2->execute()) {
		
		return $pdo2->lastInsertID();
	}
	
	//???
	return $requete->errorInfo();
}
