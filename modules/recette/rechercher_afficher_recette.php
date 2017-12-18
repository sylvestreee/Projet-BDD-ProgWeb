<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

include CHEMIN_LIB.'form.php';
include CHEMIN_MODELE.'rechercher_recette.php';
include CHEMIN_MODELE.'afficher_recette.php';
include CHEMIN_MODELE.'etape.php';

// RECHERCHE DES RECETTES

$form_recherche_nom = new Form('formulaire_recherche_nom');

$form_recherche_nom 	->method('POST');

$form_recherche_nom 	->add('Text', 'phrase')
			    		->label("Rechercher une recette");

$form_recherche_nom 	->add('Submit', 'submit')
				  		->value("Rechercher");

if ($form_recherche_nom->is_valid($_POST)) 
{	
	$phrase = $form_recherche_nom->get_cleaned_data('phrase');

	$id_recette = recherche_recette_par_nom($phrase);

	include CHEMIN_VUE.'resultat_rechercher.php';
}

else
{
	include CHEMIN_VUE.'rechercher_recette.php';	
}

// RECHERCHE DES RECETTES (VIA INGREDIENTS)

$form_recherche_ingr = new Form('formulaire_recherche_ingr');

$form_recherche_ingr 	->method('POST');

$form_recherche_ingr 	->add('Text', 'phrase_ingr')
			    		->label("Rechercher une recette");

$form_recherche_ingr 	->add('Submit', 'submit')
				  		->value("Rechercher");

if ($form_recherche_ingr->is_valid($_POST)) 
{	
	$phrase_ingr = $form_recherche_ingr->get_cleaned_data('phrase_ingr');

	$id_recette = recherche_recette_par_nom($phrase_ingr);

	include CHEMIN_VUE.'resultat_rechercher.php';
}

else
{
	include CHEMIN_VUE.'rechercher_ingredient.php';	
}

// AFFICHAGE DES RECETTES

$affichage_recette = new Form('affichage_recette');

$affichage_recette 		->method('POST');

$affichage_recette 		->add('Text', 'nom_recette')
			   			->label("Recette à afficher");

$affichage_recette 		->add('Submit', 'submit')
				 		->value("Afficher");

// Validation des champs suivant des règles
if ($affichage_recette->is_valid($_POST)) 
{	
	$nom_recette = $affichage_recette->get_cleaned_data('nom_recette');
	
	$info_recette = info_recette($nom_recette);

	$id_recette = recherche_id_recette_par_nom($nom_recette);
	$info_etapes = info_etapes($id_recette);

	include CHEMIN_VUE.'resultat_afficher.php';
}

else
{
	include CHEMIN_VUE.'afficher_recette.php';		
}
