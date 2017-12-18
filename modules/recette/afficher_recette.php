<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

include CHEMIN_LIB.'form.php';
include CHEMIN_MODELE.'affichage_recette.php';

// "formulaire_recherche_nom" est l'ID unique du formulaire
$form_recherche_nom = new Form('formulaire_recherche_nom');

$form_recherche_nom->method('POST');

$form_recherche_nom->add('Text', 'phrase')
			   ->label("Rechercher une recette");

$form_recherche_nom->add('Submit', 'submit')
				 ->value("Faire la recherche");
	

// Création d'un tableau des erreurs
$erreurs_recherche = array();

// Validation des champs suivant les règles
if ($form_recherche_nom->is_valid($_POST)) 
{	
	$phrase = $form_recherche_nom->get_cleaned_data('phrase');
	
	$info_recette = info_recette($phrase);

	$id_recette = recherche_id_recette_par_nom($phrase);
	echo $id_recette;
	$info_etapes = info_etapes($id_recette);

	include CHEMIN_VUE.'affichage_recette.php';

	/*include CHEMIN_MODELE.'recette.php';
	
	$id_recette = recherche_recette_par_nom($phrase);
	
	include CHEMIN_VUE.'resultat.php';*/			
}
else
{
	include CHEMIN_VUE.'afficher_resultat_recherche_recette.php';		
}
