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

function recherche_recette_par_ingr($demande)
{
	$pdo = PDO2::getInstance();
	
	$phrase = "%";
	$phrase .= $demande;
	$phrase .= "%";
	
	$requete = $pdo->prepare("SELECT distinct(r.nom_recette)
		FROM RECETTE r
		INNER JOIN (SELECT e.id_recette, i.nom_ingr
					FROM ETAPE e
					INNER JOIN INGREDIENT i ON e.id_ingr = i.id_ingr) r1 ON r.id_recette = r1.id_recette
		WHERE 
		r1.nom_ingr LIKE :phrase");

	$requete->bindValue(':phrase', $phrase);
	$requete->execute();
	
	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) {
	
		$requete->closeCursor();
		return $result;
	}
	return false;
}

