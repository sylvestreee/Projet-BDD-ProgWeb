<?php

function info_recette($nom_recette)
{
	$pdo = PDO2::getInstance();
	
	$requete = $pdo->prepare("SELECT nom_recette, auteur, descriptif, difficulte, prix, nb_personnes
		FROM RECETTE
		WHERE 
		nom_recette = :nom_recette");

	$requete->bindValue(':nom_recette', $nom_recette);
	$requete->execute();
	
	if ($result = $requete->fetch()) 
	{
		return $result;
	}
	return false;
}

function info_etapes($id_recette)
{
	$pdo = PDO2::getInstance();

	$requete = $pdo->prepare("SELECT e.description, i.nom_ingr, r.nom_regime, e.quantite_etape, e.temps, e.type_etape
		FROM ETAPE e
		INNER JOIN INGREDIENT i ON e.id_ingr = i.id_ingr
		INNER JOIN REGIME r ON e.id_ingr = r.id_ingr
		INNER JOIN RECETTE re ON e.id_recette = re.id_recette
		WHERE re.id_recette = :id_recette
		GROUP BY e.id_etape");

	$requete->bindValue(':id_recette', $id_recette)
	$requete->execute();

	if ($result = $requete->fetchAll(PDO::FETCH_ASSOC)) 
	{
		$requete->closeCursor();
		return $result;
	}
	return false;
}

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