<h2> Résultat de la recherche : <?php echo htmlspecialchars($phrase)?> </h2>

<?php

if(empty($id_recette))
{
	echo "Aucune recette trouvée"."<br>";
}

else
{
	foreach($id_recette as $r)
	{
		echo $r["nom_recette"]."<br>"; 
	}
}
