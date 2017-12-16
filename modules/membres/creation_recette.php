<?php

session_start();

if (!utilisateur_est_connecte()) 
{
	// On affiche la page d'erreur comme quoi l'utilisateur doit être connecté pour voir la page
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';	
} 

else 
{
	include CHEMIN_LIB.'form.php';

//AJOUT RECETTE

	$crea_recette = new Form('creation_recette');

	$crea_recette   ->method('POST');

	$crea_recette   ->add('Text', 'nom_recette')
					->label("Nom de la recette");

	$crea_recette   ->add('Textarea', 'descriptif')
					->label("Descriptif");

	$crea_recette   ->add('Select', 'difficulte')
					->choices(array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'))
					->label("Difficulté");

	$crea_recette   ->add('Select', 'prix')
					->choices(array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'))
					->label("Prix");

	$crea_recette   ->add('Text', 'nb_personnes')
					->label("Nombre de personnes");

	$crea_recette 	->add('Submit', 'recette')
					->value("Sauvegarder la recette");
	
	// Création d'un tableau des erreurs
	$erreurs_recette = array();

	// Validation des champs suivant les règles en utilisant les données du tableau $_POST
	if ($crea_recette->is_valid($_POST)) 
	{
		// Tentative d'ajout de la recette dans la base de données
		list($nom_recette, $descriptif, $difficulte, $prix, $nb_personnes) =
		$crea_recette->get_cleaned_data('nom_recette', 'descriptif', 'difficulte', 'prix', 'nb_personnes');

		// On veut utiliser le modèle de la recette
		include CHEMIN_MODELE.'recette.php';

		// ajouter_recette_dans_bdd() est défini dans ~/modeles/recette.php
		$id_recette = ajouter_recette_dans_bdd($nom_recette, $descriptif, $_SESSION['id'], 
		$_SESSION['pseudo'], $difficulte, $prix, $nb_personnes);

		// Si la base de données a bien voulu ajouter la recette (pas de doublons)
		if (ctype_digit($id_recette)) 
		{
			// Affichage de la confirmation de l'inscription
			include CHEMIN_VUE.'recette_effectuee.php';
		// Gestion des doublons
		} 
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_recette;

			// On vérifie que l'erreur concerne bien un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				if ($nom_recette == $valeur_probleme) 
				{
					$erreurs_recette[] = "Ce nom de recette est déjà utilisé.";
				} 
				else 
				{
					$erreurs_recette[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
					var_dump($valeur_probleme);
				}
			} 
			else 
			{
				$erreurs_recette[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			// On réaffiche le formulaire de création de recettes
			include CHEMIN_VUE.'recette.php';
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire de création de recettes
		include CHEMIN_VUE.'recette.php';
	}

//AJOUT ETAPE

	$crea_etape = new Form('creation_etape');

	$crea_etape   ->method('POST');

	//sélectionner une recette de l'utilisateur

	//sélectionne un ingrédient

	$crea_etape   ->add('Text', 'quantite_etape')
				  ->label("Quantité d'ingrédients");

	$crea_etape   ->add('Text', 'temps')
				  ->label("Temps");

	$crea_etape   ->add('Select', 'type_etape')
				  ->choices(array(
				  '1' => '1',
				  '2' => '2',
				  '3' => '3',
			 	  '4' => '4',
				  '5' => '5'))
				  ->label("Type");

	$crea_etape   ->add('Textarea', 'description')
				  ->label("Description");

	$crea_etape   ->add('Submit', 'etape')
				  ->value("Sauvegarder l'étape");
				  
	// Création d'un tableau des erreurs
	$erreurs_etape = array();

	// Validation des champs suivant les règles en utilisant les données du tableau $_POST
	if ($crea_etape->is_valid($_POST)) 
	{
		// Tentative d'ajout du membre dans la base de données
		list($quantite_etape, $temps, $type_etape, $description) =
		$crea_etape->get_cleaned_data('quantite_etape', 'temps', 'type_etape', 'description');

		// On veut utiliser le modèle de l'inscription (~/modeles/inscription.php)
		include CHEMIN_MODELE.'etape.php';

		//echo "yes";
		$test = 'Carbonara';
		$test1 = recherche_id_recette_par_nom($test);
		
		//$id_ingr = recherche_id_ingr_par_nom($nom_ingr);

		// ajouter_membre_dans_bdd() est défini dans ~/modeles/inscription.php
		//$id_etape = ajouter_etape_dans_bdd($id_recette, $id_ingr, $quantite_etape, $temps, $type_etape, $description);

		// Si la base de données a bien voulu ajouter l'utilisateur (pas de doublons)
		if (ctype_digit($id_etape)) 
		{
			echo "yes1";
			// Affichage de la confirmation de l'inscription
			include CHEMIN_VUE.'etape_effectuee.php';
		} 
		// Gestion des doublons
		else 
		{
			//echo "yes2";
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_etape;

			// On vérifie que l'erreur concerne bien un doublon
			if (23000 == $erreur[0]) 
			{	
				echo "yes3";
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				if ($nom_etape == $valeur_probleme) 
				{
					echo "yes4";
					$erreurs_etape[] = "Ce nom de recette est déjà utilisé.";
				} 
				else 
				{
					echo "yes5";
					$erreurs_etape[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
					var_dump($valeur_probleme);
				}
			} 
			else 
			{
				//echo "yes6";
				$erreurs_etape[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			echo "yes7";
			// On réaffiche le formulaire de création de recettes
			include CHEMIN_VUE.'etape.php';
		}
	} 
	else 
	{
		echo "yes8";
		// On affiche à nouveau le formulaire de création de recettes
		include CHEMIN_VUE.'etape.php';
	}

//AJOUT INGREDIENT

	$crea_ingredient = new Form('creation_ingredient');

	$crea_ingredient   ->method('POST');

	$crea_ingredient   ->add('Text', 'nom_ingr')
					   ->label("Nom de l'ingredient");

	$crea_ingredient   ->add('Select', 'type_ingr')
						->choices(array(
						'1' => '1',
						'2' => '2',
						'3' => '3'))
						->label("Type");

	//informations nutritionnelles

	$crea_ingredient   ->add('Text', 'calories')
					   ->label("Calories");

	$crea_ingredient   ->add('Text', 'lipides')
					   ->label("Lipides");

	$crea_ingredient   ->add('Text', 'glucides')
					   ->label("Glucides");

	$crea_ingredient   ->add('Text', 'protides')
					   ->label("Protides");

	//regime

	$crea_ingredient   ->add('Text', 'nom_regime')
					   ->label("Régime");

	$crea_ingredient   ->add('Submit', 'ingredient')
					   ->value("Sauvegarder l'ingrédient");

	if ($crea_ingredient->is_valid($_POST)) 
	{
		// Tentative d'ajout de l'ingrédient dans la base de données
		list($nom_ingr, $type_ingr, $calories, $lipides, $glucides, $protides, $nom_regime) =
		$crea_ingredient->get_cleaned_data('nom_ingr', 'type_ingr', 'calories', 'lipides', 'glucides', 'protides', 'nom_regime');

		// On veut utiliser le modèle de la recette
		include CHEMIN_MODELE.'ingredient.php';

		// ajouter_ingredient_dans_bdd() est défini dans ~/modeles/ingredient.php
		$id_ingr = ajouter_ingredient_dans_bdd($nom_ingr, $type_ingr);

		// Si la base de données a bien voulu ajouter l'ingrédient (pas de doublons)
		if (ctype_digit($id_ingr)) 
		{
			$id_info_nutri = ajouter_info_nutri_dans_bdd($id_ingr, $calories, $lipides, $glucides, $protides);

			if(ctype_digit($id_info_nutri))
			{
				$id_regime = ajouter_regime_dans_bdd($id_ingr, $nom_regime);

				if(ctype_digit($id_regime))
				{
					// Affichage de la confirmation de l'inscription
					include CHEMIN_VUE.'ingredient_effectuee.php';
				}
			}
		}

		// Gestion des doublons
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_ingredient;

			// On vérifie que l'erreur concerne bien un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				if ($nom_ingredient == $valeur_probleme) 
				{
					$erreurs_recette[] = "Ce nom d'ingrédient est déjà utilisé.";
				} 
				else 
				{
					$erreurs_recette[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
					var_dump($valeur_probleme);
				}
			} 
			else 
			{
				$erreurs_recette[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			// On réaffiche le formulaire de création de recettes
			include CHEMIN_VUE.'ingredient.php';
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire de création de recettes
		include CHEMIN_VUE.'ingredient.php';
	}
}