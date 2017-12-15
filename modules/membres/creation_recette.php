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

	//recette

	$crea_recette = new Form('creation_recette');

	$crea_recette   ->method('POST');

	$crea_recette   ->add('Text', 'nom_recette')
					->label("Nom de la recette");

	$crea_recette   ->add('Textarea', 'descriptif')
					->label("Descriptif");

	/*$crea_recette   ->add('Select', 'difficulte')
					->choices(array(
					'f' => 'Facile',
					'm' => 'Moyen',
					'd' => 'Difficile'))
					->label("Difficulté");*/

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
	$erreurs_inscription = array();

	// Validation des champs suivant les règles en utilisant les données du tableau $_POST
	if ($crea_recette->is_valid($_POST)) 
	{

		// On vérifie si nb_personnes est bien un nombre (is_numeric)
		if (is_numeric($crea_recette->get_cleaned_data('nb_personnes')))
		{
			$erreurs_inscription[] = "Vous n'avez pas entré un nombre de personnes valide";
			echo "yes";
		}

		// Si d'autres erreurs ne sont pas survenues
		if (empty($erreurs_inscription)) 
		{
			echo "yes2";
			// Tentative d'ajout du membre dans la base de données
			list($nom_recette, $descriptif/*, $difficulte*/, $prix, $nb_personnes) =
			$form_inscription->get_cleaned_data('nom_recette', 'descriptif', /*'difficulte',*/ 'prix', 'nb_personnes');

			// On veut utiliser le modèle de l'inscription (~/modeles/inscription.php)
			include CHEMIN_MODELE.'recette.php';

			$difficulte = 'Facile';

			// ajouter_membre_dans_bdd() est défini dans ~/modeles/inscription.php
			$id_recette = ajouter_recette_dans_bdd($nom_recette, $descriptif, $difficulte, $_SESSION['id'], 
			$_SESSION['pseudo'], $difficulte, $prix, $nb_personnes);

			// Si la base de données a bien voulu ajouter l'utilisateur (pas de doublons)
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
						$erreurs_inscription[] = "Ce nom de recette est déjà utilisé.";
					} 
					else 
					{
						$erreurs_inscription[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
						var_dump($valeur_probleme);
					}
				} 
				else 
				{
					$erreurs_inscription[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
				}
				// On réaffiche le formulaire de création de recettes
				include CHEMIN_VUE.'recette.php';
				echo "yes3";
			}
		} 
		else 
		{
			// On affiche à nouveau le formulaire de création de recettes
			include CHEMIN_VUE.'recette.php';
			echo "yes4";
		}
	} 
	else 
	{
		// On affiche à nouveau le formulaire de création de recettes
		include CHEMIN_VUE.'recette.php';
		echo "yes5";
	}
}

//etape

	/*$crea_etape = new Form('creation_etape');

	$crea_etape   ->method('POST');

	//sélectionner une recette de l'utilisateur

	//sélectionne un ingrédient

	$crea_etape   ->add('Text', 'quantite')
				  ->label("Quantité d'ingrédients");

	$crea_etape   ->add('Text', 'temps')
				  ->label("Temps");

	$crea_etape   ->add('Select', 'type_etape')
				  ->choices(array('cuisson', 'repos', 'autre'))
				  ->label("Type");

	$crea_etape   ->add('Textarea', 'description')
				  ->label("Description");

	$crea_etape   ->add('Submit', 'etape')
				  ->value("Sauvegarder l'étape");

	//ingredient

	$crea_ingredient = new Form('creation_ingredient');

	$crea_ingredient   ->method('POST');

	$crea_ingredient   ->add('Text', 'nom_ingredient')
					   ->label("Nom de l'ingredient");

	$crea_ingredient   ->add('Select', 'type_ingredient')
					   ->choices(array('u', 'g', 'mL'))
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

	include CHEMIN_VUE.'etape.php';
	include CHEMIN_VUE.'ingredient.php';*/
