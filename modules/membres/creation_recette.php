<?php

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

	$crea_recette   ->add('Select', 'difficulte')
					->choices(array('Très facile', 'Facile', 'Moyen', 'Difficile'))
					->label("Difficulté");

	$crea_recette   ->add('Select', 'prix')
					->choices(array('1', '2', '3', '4', '5'))
					->label("Prix");

	$crea_recette   ->add('Text', 'nb_personnes')
					->label("Nombre de personnes");

	$crea_recette 	->add('Submit', 'recette')
					->value("Sauvegarder la recette");

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
					   ->value("Sauvegarder l'ingrédient");*/

	include CHEMIN_VUE.'recette.php';
	//include CHEMIN_VUE.'etape.php';
	//include CHEMIN_VUE.'ingredient.php';
}
