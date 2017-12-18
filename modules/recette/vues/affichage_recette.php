<?php

if(empty($info_recette))
{
	echo "Aucune recette trouvée"."<br>";
}

else
{
	echo "Nom de la recette : ".$info_recette["nom_recette"]."<br>"; 
	echo "Auteur : ".$info_recette["auteur"]."<br>"; 
	echo "Descriptif : ".$info_recette["descriptif"]."<br>"; 
	echo "Difficulte : ".$info_recette["difficulte"]."<br>"; 
	echo "Prix : ".$info_recette["prix"]."<br>";
	echo "Nombre de personnes : ".$info_recette["nb_personnes"]."<br>"."<br>"; 

	if(empty($info_etapes))
	{
		echo "Aucune étape affiliée à cette recette"."<br>";
	}

	else
	{
		$nb = 1;

		foreach($info_etapes as $e)
		{
			echo "Etape n°".$nb."<br>"; 
			$nb++;

			echo "Description : ".$e["description"]."<br>"; 
			echo "Nom de l'ingrédient : ".$e["nom_ingr"]."<br>";
			echo "Régime de l'ingrédient : ".$e["nom_regime"]."<br>"; 
			echo "Quantité d'ingrédients : ".$e["quantite_etape"]."<br>"; 
			echo "Temps : ".$e["temps"]."<br>"; 
			echo "Type : ".$e["type_etape"]."<br>"."<br>"; 
		}
	}
}

