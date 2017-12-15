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

	$requete->bindValue(':nom_recette', $id_recette);
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
