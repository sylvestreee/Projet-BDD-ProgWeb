<h2>Création d'une recette</h2>

<h3>Ajouter une recette</h3>

<h4>Choix de la difficulté :</h4>
<ul>
  <li>1 = très facile</li>
  <li>2 = facile</li>
  <li>3 = moyen</li>
  <li>4 = difficile</li>
</ul>

<?php

if (!empty($erreurs_recette)) 
{
	echo '<ul>' . "\n";
	foreach ($erreurs_recette as $e) 
	{
		echo ' <li>' . $e . '</li>' . "\n";
	}
	echo '</ul>';
}

echo $crea_recette;