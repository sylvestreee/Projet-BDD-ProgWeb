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
	include CHEMIN_MODELE.'etape.php';

//AJOUT REPAS

	$monday = date('d/m/y', strtotime('monday this week'));
	$monday_r = date('y/m/d', strtotime('monday this week'));

	// Récupération des recettes plannifiées pour le lundi de la semaine courante
	$planning_monday = recherche_recette_date($_SESSION['id'], $monday_r);

	$tuesday = date('d/m/y', strtotime('tuesday this week'));
	$tuesday_r = date('y/m/d', strtotime('tuesday this week'));

	// Récupération des recettes plannifiées pour le mardi de la semaine courante
	$planning_tuesday = recherche_recette_date($_SESSION['id'], $tuesday_r);

	$wednesday = date('d/m/y', strtotime('wednesday this week'));
	$wednesday_r = date('y/m/d', strtotime('wednesday this week'));

	// Récupération des recettes plannifiées pour le mercredi de la semaine courante
	$planning_wednesday = recherche_recette_date($_SESSION['id'], $wednesday_r);

	$thursday = date('d/m/y', strtotime('thursday this week'));
	$thursday_r = date('y/m/d', strtotime('thursday this week'));

	// Récupération des recettes plannifiées pour le jeudi de la semaine courante
	$planning_thursday = recherche_recette_date($_SESSION['id'], $thursday_r);

	$friday = date('d/m/y', strtotime('friday this week'));
	$friday_r = date('y/m/d', strtotime('friday this week'));

	// Récupération des recettes plannifiées pour le vendredi de la semaine courante
	$planning_friday = recherche_recette_date($_SESSION['id'], $friday_r);

	$saturday = date('d/m/y', strtotime('saturday this week'));
	$saturday_r = date('y/m/d', strtotime('saturday this week'));

	// Récupération des recettes plannifiées pour le samedi de la semaine courante
	$planning_saturday = recherche_recette_date($_SESSION['id'], $saturday_r);

	$sunday = date('d/m/y', strtotime('sunday this week'));
	$sunday_r = date('y/m/d', strtotime('sunday this week'));

	// Récupération des recettes plannifiées pour le dimanche de la semaine courante
	$planning_sunday = recherche_recette_date($_SESSION['id'], $sunday_r);

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

	$gest_planning    ->add('Date', 'date_repas')
					  ->format('dd/mm/yy')
					  ->label("Date du repas (yy/mm/dd)");

	$gest_planning    ->add('Text', 'heure')
					  ->label("Heure du repas (hh:mm)");

	$gest_planning 	  ->add('Submit', 'recette')
					  ->value("Ajouter la recette");


	//Création d'un tableau des erreurs
	$erreurs_planning = array();

	// Validation des champs suivant des règles
	if ($gest_planning->is_valid($_POST)) 
	{ 

		// Récupération des informations du formulaire
		list($recette_planning, $date_repas, $heure) =
		$gest_planning->get_cleaned_data('recette_planning', 'date_repas', 'heure');
		
		// Ajout du repas dans la base de données
		$id_repas = ajouter_repas_dans_bdd($_SESSION['id'], $date_repas, $heure);

		// Si le repas a bien été ajoutée à la BDD
		if (ctype_digit($id_repas)) 
		{
			$id_recette = recherche_id_recette_par_nom($recette_planning);

			// Ajout de la recette sélectionnée pour le repas dans la BDD
			$id_repas_recette = ajouter_repas_recette_dans_bdd($id_recette, $id_repas);

			// Si la recette a bien été ajoutée à la BDD
			if (ctype_digit($id_repas_recette))
			{
				// Affichage de la confirmation de l'ajout de la recette
				include CHEMIN_VUE.'planning_recette_effectuee.php';
			}
		} 

		// Gestion des doublons
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_repas;

			// Vérificaton que l'erreur concerne un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				$erreurs_planning[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
			}

			else 
			{
				$erreurs_planning[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			// On réaffiche le formulaire d'ajout de recettes
			include CHEMIN_VUE.'gestion_affichage_planning.php';
		}
	} 

	else 
	{
		// On affiche à nouveau le formulaire d'ajout de recettes
		include CHEMIN_VUE.'gestion_affichage_planning.php';
	}
}