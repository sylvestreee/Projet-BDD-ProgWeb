<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

// Si le paramètre id est manquant ou invalide
if (empty($_GET['id']) or !is_numeric($_GET['id'])) {

    include CHEMIN_VUE.'erreur_parametre_profil.php';

} else {

    include CHEMIN_MODELE.'membres.php'; //<3 ne pas laisser les gens modifier ton code pendant que tu es parti :D
    
    $infos_utilisateur = lire_infos_utilisateur($_GET['id']);
        
    // Si le profil existe
    if (false !== $infos_utilisateur) {
        list($nom_utilisateur, $adresse_email, ) = $infos_utilisateur;
        include CHEMIN_VUE.'profil_infos_utilisateur.php';

    } else {

        include CHEMIN_VUE.'erreur_profil_inexistant.php';
    }
}


