<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

include CHEMIN_LIB.'form.php';

// "formulaire_recherche_nom" est l'ID unique du formulaire
$form_recherche_nom = new Form('formulaire_recherche_nom');

$form_recherche_nom->method('POST');

$form_recherche_nom->add('Text', 'phrase')
			   ->label("Rechercher une recette");

$form_recherche_nom->add('Submit', 'submit')
				 ->value("Recherche d'une recette");
	

// Création d'un tableau des erreurs
$erreurs_recherche = array();

// Validation des champs suivant les règles
if ($form_recherche_nom->is_valid($_POST)) {
	
	echo "bla";
	list($phrase) = $form_recherche_nom->get_cleaned_data('phrase');
	
	include CHEMIN_MODELE.'recette.php';
	
	$id_recette = recherche_recette_par_nom($phrase);
	
	while($row=mysql_fetch_array($id_recette,MYSQL_ASSOC))
	{
		echo $row["id_recette"];
	}
	include CHEMIN_VUE.'resultat.php';	
}
else
{
	include CHEMIN_VUE.'afficher_resultat_recherche_recette.php';		
}
