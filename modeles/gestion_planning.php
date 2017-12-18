<?php

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