<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

include CHEMIN_LIB.'form.php';

		// "formulaire_recherche_nom" est l'ID unique du formulaire
		$form_recherche_nom = new Form('formulaire_recherche_nom');
		
		$form_recherche_nom->method('POST');

		$form_recherche_nom->add('Text', 'phrase')
				       ->label("Rechercher une recette");
		
		// Création d'un tableau des erreurs
		$erreurs_connexion = array();

		// Validation des champs suivant les règles
		if ($form_connexion->is_valid($_POST)) {
			
			list($phrase) = $form_recherche_nom('phrase');
			
			include CHEMIN_MODELE.'recette.php';
			
			$id_recette = recherche_recette_par_nom($phrase);
			
			while($row=mysql_fetch_array($id_recette))
			{
				echo $row;
			}
			include CHEMIN_VUE.'afficher_resultat_recherche_recette.php';			
		}
