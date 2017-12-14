<?php

session_start();

	// Vérification des droits d'accès de la page
	if (utilisateur_est_connecte()) {

		// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
		include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
	
	} else {

		// Ne pas oublier d'inclure la librarie Form
		include CHEMIN_LIB.'form.php';

		// "formulaire_inscription" est l'ID unique du formulaire
		$form_inscription = new Form('formulaire_inscription');
		$form_inscription->method('POST');

		$form_inscription->add('Text', 'nom_utilisateur')
						 ->label("Votre nom d'utilisateur");
		
		$form_inscription->add('Text', 'prenom')
						 ->label("Votre prenom");
						 
		$form_inscription->add('Text', 'nom')
						 ->label("Votre nom");
	
		$form_inscription->add('Password', 'mdp')
						 ->label("Votre mot de passe");
	
		$form_inscription->add('Password', 'mdp_verif')
						 ->label("Votre mot de passe (vérification)");
	
		$form_inscription->add('Email', 'adresse_email')
						 ->label("Votre adresse email");
	
		$form_inscription->add('Submit', 'submit')
						 ->value("Je veux m'inscrire !");
	
		// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
		$form_inscription->bound($_POST);

		// Creation d'un tableau des erreurs
		$erreurs_inscription = array();

		// Validation des champs suivant les règles en utilisant les données du tableau $_POST
		if ($form_inscription->is_valid($_POST)) {

			// On vérifie si les deux mots de passe correspondent
			if ($form_inscription->get_cleaned_data('mdp') != 
			$form_inscription->get_cleaned_data('mdp_verif')) {
				$erreurs_inscription[] = "Les deux mots de passes entrés sont différents !";
			}

			// Si d'autres erreurs ne sont pas survenues
			if (empty($erreurs_inscription)) {


				// Tentative d'ajout du membre dans la base de données
				list($nom_utilisateur, $prenom, $nom, $mot_de_passe, $adresse_email) =
				$form_inscription->get_cleaned_data('nom_utilisateur','prenom','nom', 'mdp', 'adresse_email');

				// On veut utiliser le modèle de l'inscription (~/modeles/inscription.php)
				include CHEMIN_MODELE.'inscription.php';

				// ajouter_membre_dans_bdd() est défini dans ~/modeles/inscription.php
				$id_utilisateur = ajouter_membre_dans_bdd($nom_utilisateur, $prenom, $nom, sha1($mot_de_passe),
				$adresse_email);

				// Si la base de données a bien voulu ajouter l'utilisateur (pas de doublons)
				if (ctype_digit($id_utilisateur)) {

					// Affichage de la confirmation de l'inscription
					include CHEMIN_VUE . 'inscription_effectuee.php';

				// Gestion des doublons
				} else {
					// Changement de nom de variable (plus lisible)
					$erreur =& $id_utilisateur;

					// On vérifie que l'erreur concerne bien un doublon
					if (23000 == $erreur[0]) {	// Le code d'erreur 23000 signifie "doublon" dans le standard ANSI SQL
						preg_match("`Duplicate entry '(.+)' for key \d+`is", $erreur[2], $valeur_probleme);
						$valeur_probleme = $valeur_probleme[1];

						if ($nom_utilisateur == $valeur_probleme) {
							$erreurs_inscription[] = "Ce nom d'utilisateur est déjà utilisé.";
						} else if ($adresse_email == $valeur_probleme) {
							$erreurs_inscription[] = "Cette adresse e-mail est déjà utilisée.";
						} else {
							$erreurs_inscription[] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
							var_dump($valeur_probleme);
						}
					} else {
						$erreurs_inscription[] = sprintf("Erreur ajout SQL : cas non traité (SQLSTATE = %d).", $erreur[0]);
					}
					// On réaffiche le formulaire d'inscription
					include CHEMIN_VUE.'formulaire_inscription.php';
				}

			} else {
				// On affiche à nouveau le formulaire d'inscription
				include CHEMIN_VUE.'formulaire_inscription.php';
			}

		} else {
			// On affiche à nouveau le formulaire d'inscription
			include CHEMIN_VUE.'formulaire_inscription.php';
		}
	}
