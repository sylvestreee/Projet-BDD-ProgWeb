<?php

session_start();

if (!utilisateur_est_connecte()) 
{
	// L'utilisateur doit être connecté pour avoir accès à la page de création de recettes
	include CHEMIN_VUE_GLOBALE.'erreur_non_connecte.php';	
} 

else 
{
	include CHEMIN_LIB.'form.php';
	include CHEMIN_MODELE.'recette.php';
	include CHEMIN_MODELE.'etape.php';
	include CHEMIN_MODELE.'ingredient.php';
	
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

	// Validation des champs suivant des règles (ex : pour un champ mail, on vérifie que l'utilisateur a bien rentré une adresse mail)
	if ($crea_recette->is_valid($_POST)) 
	{
		// Récupération des informations du formulaire
		list($nom_recette, $descriptif, $difficulte, $prix, $nb_personnes) =
		$crea_recette->get_cleaned_data('nom_recette', 'descriptif', 'difficulte', 'prix', 'nb_personnes');
		
		// Ajout de la recette dans la base de données
		$id_recette = ajouter_recette_dans_bdd($nom_recette, $descriptif, $_SESSION['id'], 
		$_SESSION['pseudo'], $difficulte, $prix, $nb_personnes);

		// Si la recette a bien été ajoutée à la BDD
		if (ctype_digit($id_recette)) 
		{
			// Affichage de la confirmation de l'ajout de la recette
			include CHEMIN_VUE.'recette_effectuee.php';
		} 

		// Gestion des doublons
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_recette;

			// Vérificaton que l'erreur concerne un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[1], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				if ($nom_recette == $valeur_probleme) 
				{
					$erreurs_recette[] = "Ce nom de recette est déjà utilisé.";
				} 
				else 
				{
					$erreurs_recette[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
				}
			}
			else 
			{
				$erreurs_recette[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}

			// On réaffiche le formulaire d'ajout de recettes
			include CHEMIN_VUE.'recette.php';
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire d'ajout de recettes
		include CHEMIN_VUE.'recette.php';
	}

//AJOUT ETAPE

	$etape_uti = new Form('etape_utilisateur');

	// Affichage d'une liste contenant les recettes créées par l'utilisateur
	$recettes = recherche_recette_par_id($_SESSION['id']);

	// Affichage d'une liste contenant les ingrédients présents dans la BDD
	$ingredients = recherche_ingredient();

	$etape_uti    ->add('Select', 'recettes')
				  ->choices($recettes)
				  ->label("Recettes");

	$etape_uti    ->add('Select', 'ingredients')
				  ->choices($ingredients)
				  ->label("Ingredients");

	$crea_etape = new Form('creation_etape');

	$crea_etape   ->method('POST');

	$crea_etape   ->add('Text', 'recette')
				  ->label("Recette choisie");

	$crea_etape   ->add('Text', 'ingredient')
				  ->label("Ingrédient choisi");		  

	$crea_etape   ->add('Text', 'quantite_etape')
				  ->label("Quantité d'ingrédients");

	$crea_etape   ->add('Text', 'temps')
				  ->label("Temps");

	$crea_etape   ->add('Select', 'type_etape')
				  ->choices(array(
				  '1' => '1',
				  '2' => '2',
				  '3' => '3'))
				  ->label("Type");

	$crea_etape   ->add('Textarea', 'description')
				  ->label("Description");

	$crea_etape   ->add('Submit', 'etape')
				  ->value("Sauvegarder l'étape");
				  
	// Création d'un tableau des erreurs
	$erreurs_etape = array();

	// Validation des champs suivant des règles
	if ($crea_etape->is_valid($_POST)) 
	{		
		// Récupération des informations du formulaire
		list($recette, $ingredient, $quantite_etape, $temps, $type_etape, $description) =
		$crea_etape->get_cleaned_data('recette', 'ingredient', 'quantite_etape', 'temps', 'type_etape', 'description');

		// Récupération de l'id de la recette choisie par l'utilisateur
		$id_recette = recherche_id_recette_par_nom($recette);

		// Récupération de l'id de l'ingrédient choisi par l'utilisateur
		$id_ingr = recherche_id_ingr_par_nom($ingredient);

		// Ajout de l'étape dans la base de données
		$id_etape = ajouter_etape_dans_bdd($id_recette, $id_ingr, $quantite_etape, $temps, $type_etape, $description);

		// Si l'étape a bien été ajoutée à la BDD
		if (ctype_digit($id_etape)) 
		{
			// Affichage de la confirmation de l'ajout de l'étape
			include CHEMIN_VUE.'etape_effectuee.php';
		} 
		// Gestion des doublons
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_etape;

			// Vérificaton que l'erreur concerne un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$erreurs_etape[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
			} 
			else 
			{
				$erreurs_etape[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			// On réaffiche le formulaire de création d'étapes
			include CHEMIN_VUE.'etape.php';
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire de création d'étapes
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

	$crea_ingredient   ->add('Text', 'calories')
					   ->label("Calories");

	$crea_ingredient   ->add('Text', 'lipides')
					   ->label("Lipides");

	$crea_ingredient   ->add('Text', 'glucides')
					   ->label("Glucides");

	$crea_ingredient   ->add('Text', 'protides')
					   ->label("Protides");

	$crea_ingredient   ->add('Text', 'nom_regime')
					   ->label("Régime");

	$crea_ingredient   ->add('Submit', 'ingredient')
					   ->value("Sauvegarder l'ingrédient");

	// Création d'un tableau des erreurs
	$erreurs_ingredient = array();

	//Validation des champs suivant des règles			   
	if ($crea_ingredient->is_valid($_POST)) 
	{
		// Récupération des informations du formulaire
		list($nom_ingr, $type_ingr, $calories, $lipides, $glucides, $protides, $nom_regime) =
		$crea_ingredient->get_cleaned_data('nom_ingr', 'type_ingr', 'calories', 'lipides', 'glucides', 'protides', 'nom_regime');

		// Ajout de l'éingrédient dans la base de données
		$id_ingr = ajouter_ingredient_dans_bdd($nom_ingr, $type_ingr);

		// Si l'ingrédient a bien été ajoutée à la BDD
		if (ctype_digit($id_ingr)) 
		{
			$id_info_nutri = ajouter_info_nutri_dans_bdd($id_ingr, $calories, $lipides, $glucides, $protides);

			// Si les informations nutritionelles de l'ingrédient ont bien été ajouté à la BDD
			if(ctype_digit($id_info_nutri))
			{
				$id_regime = ajouter_regime_dans_bdd($id_ingr, $nom_regime);

				// Si le régime de l'ingrédient a bien été ajouté à la BDD
				if(ctype_digit($id_regime))
				{
					// Affichage de la confirmation de l'ajout de l'ingrédient
					include CHEMIN_VUE.'ingredient_effectuee.php';
				}
			}
		}

		// Gestion des doublons
		else 
		{
			// Changement de nom de variable (plus lisible)
			$erreur =& $id_ingredient;

			// Vérificaton que l'erreur concerne un doublon
			if (23000 == $erreur[0]) 
			{	
				// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
				preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
				$valeur_probleme = $valeur_probleme[1];
				if ($nom_ingredient == $valeur_probleme) 
				{
					$erreurs_ingredient[] = "Ce nom d'ingrédient est déjà utilisé.";
				} 
				else 
				{
					$erreurs_ingredient[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
				}
			} 
			else 
			{
				$erreurs_ingredient[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
			}
			// On réaffiche le formulaire de création d'ingrédients
			include CHEMIN_VUE.'ingredient.php';
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire de création d'ingrédients
		include CHEMIN_VUE.'ingredient.php';
	}
}