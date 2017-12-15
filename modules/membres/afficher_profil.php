<?php

session_start();

// Pas de vérification de droits d'accès nécessaire

// Si le paramètre id est manquant ou invalide
if (empty($_SESSION['id'])) {

    include CHEMIN_VUE.'erreur_parametre_profil.php';

} else {

    include CHEMIN_MODELE.'membres.php'; 
    $infos_utilisateur = lire_infos_utilisateur($_SESSION['id']);
        
    // Si le profil existe
    if (false !== $infos_utilisateur) {
        list($nom_utilisateur, $email, ) = $infos_utilisateur;
        include CHEMIN_VUE.'profil_infos_utilisateur.php';

    } else {

        include CHEMIN_VUE.'erreur_profil_inexistant.php';
    }
}


