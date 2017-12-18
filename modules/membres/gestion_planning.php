<?php

session_start();

if (!utilisateur_est_connecte()) 
{
	// L'utilisateur doit être connecté pour avoir accès à la page de gestion
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';	
} 

else 
{
	include CHEMIN_LIB.'form.php';
	include CHEMIN_MODELE.'gestion_planning.php';

//AJOUT REPAS

	$recette = new Form('recette');

	// Affichage d'une liste contenant les recettes présentes dans la BDD
	$recettes = recherche_recette();

	$recette      ->add('Select', 'recettes')
				  ->choices($recettes)
				  ->label("Recettes");

	$gest_planning = new Form('gestion_planning');

	$gest_planning    ->method('POST');

	$gest_planning    ->add('Text', 'recette')
				      ->label("Recette choisie");

	$gest_planning    ->add('Date', 'date')
					  ->format('dd/mm/yy')
					  ->label("Nom de la recette");

	$gest_planning 	  ->add('Submit', 'recette')
					  ->value("Ajouter la recette");

	include CHEMIN_VUE.'gestion_affichage_planning';
}