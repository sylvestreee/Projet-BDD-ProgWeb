<?php

// Identifiants pour la base de données. Nécessaires a PDO2.
define('SQL_DSN',      'mysql:host=osr-mysql.unistra.fr;dbname=martin_heitz');
define('SQL_USERNAME', 'martin_heitz');
define('SQL_PASSWORD', 'bddlove68');

// Chemins à utiliser pour accéder aux vues/modeles/librairies
$module = empty($module) ? !empty($_GET['module']) ? $_GET['module'] : 'index' : $module;
define('CHEMIN_VUE',    		'modules/'.$module.'/vues/');
define('CHEMIN_MODELE', 		'modeles/');
define('CHEMIN_LIB',    		'libs/');
define('CHEMIN_VUE_GLOBALE', 	'vues_globales/');

