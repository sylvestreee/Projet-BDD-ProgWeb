<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

include CHEMIN_LIB.'form.php';
include CHEMIN_MODELE.'recette.php';
include CHEMIN_MODELE.'affichage_recette.php';

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

	include CHEMIN_VUE.'resultat.php';
}

else
{
	include CHEMIN_VUE.'afficher_resultat_recherche_recette.php';	
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

	include CHEMIN_VUE.'affichage_recette.php';
}
else
{
	include CHEMIN_VUE.'afficher_resultat_affichage_recette.php';		
}

/* Création d'un tableau des erreurs
$erreurs_recherche = array();*/