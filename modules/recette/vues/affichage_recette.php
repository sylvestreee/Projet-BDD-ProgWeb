<?php

echo "Nom de la recette : ".$info_recette["nom_recette"]."<br>"; 
echo "Auteur : ".$info_recette["auteur"]."<br>"; 
echo "Descriptif : ".$info_recette["descriptif"]."<br>"; 
echo "Difficulte : ".$info_recette["difficulte"]."<br>"; 
echo "Prix : ".$info_recette["prix"]."<br>";
echo "Nombre de personnes : ".$info_recette["nb_personnes"]."<br>"; 

foreach($info_etapes as $e)
{
	echo $e["description"]."<br>"; 
	echo $e["nom_ingr"]."<br>";
	echo $e["nom_regime"]."<br>"; 
	echo $e["quantite_etape"]."<br>"; 
	echo $e["temps"]."<br>"; 
	echo $e["type_etape"]."<br>"."<br>"; 
}

