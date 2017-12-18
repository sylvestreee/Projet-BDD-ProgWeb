<h2> Résultat de la recherche : <?php echo htmlspecialchars($phrase_ingr)?> </h2>

<?php

if(empty($id_ingr))
{
	echo "Aucune recette trouvée"."<br>"."<br>";
}

else
{
	foreach($id_ingr as $r)
	{
		echo $r["nom_recette"]."<br>"."<br>"; 
	}
}