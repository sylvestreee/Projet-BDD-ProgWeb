<?php

function recherche_recette_par_nom($demande)
{
	$pdo = PDO2::getInstance();
	
	$phrase = "%";
	$phrase .= $demande;
	$phrase .= "%";
	
	$requete = $pdo->prepare("SELECT id_recette,nom_recette 
		FROM RECETTE
		WHERE 
		nom_recette like :phrase");

	$requete->bindValue(':phrase', $phrase);
	$requete->execute();
	
	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
}