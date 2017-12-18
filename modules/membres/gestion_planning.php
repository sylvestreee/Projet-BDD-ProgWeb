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

	$monday = date('d/m', strtotime('monday this week'));
	$tuesday = date('d/m', strtotime('tuesday this week'));
	$wednesday = date('d/m', strtotime('wednesday this week'));
	$thursday = date('d/m', strtotime('thursday this week'));
	$friday = date('d/m', strtotime('friday this week'));
	$saturday = date('d/m', strtotime('saturday this week'));
	$sunday = date('d/m', strtotime('sunday this week'));

	$recette = new Form('recette');

	// Affichage d'une liste contenant les recettes présentes dans la BDD
	$recettes = recherche_recette();

	$recette      ->add('Select', 'recettes_planning')
				  ->choices($recettes)
				  ->label("Recettes");

	$gest_planning = new Form('gestion_planning');

	$gest_planning    ->method('POST');

	$gest_planning    ->add('Text', 'recette_planning')
				      ->label("Recette choisie");

	$gest_planning    ->add('Date', 'date')
					  ->format('dd/mm/yy')
					  ->label("Date du repas (dd/mm/yy)");

	$gest_planning    ->add('Date', 'heure')
					  ->format('HH/MM')
					  ->label("Heure du repas (HH/MM)");

	$gest_planning 	  ->add('Submit', 'recette')
					  ->value("Ajouter la recette");

	include CHEMIN_VUE.'gestion_affichage_planning.php';
}