<h2> Resultat de la recherche pour des recettes dont le nom contient <?php echo htmlspecialchars($phrase)?> </h2>

<?php
var_dump($id_recette);
foreach($id_recette as $r)
{
	echo $r["nom_recette"];
	var_dump($r);
}
