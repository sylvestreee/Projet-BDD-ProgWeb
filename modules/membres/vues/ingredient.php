<h3>Ajouter un ingrédient</h3>

<h4>Choix du type :</h4>
<ul>
  <li>1 = unité</li>
  <li>2 = gramme</li>
  <li>3 = millilitre</li>
</ul>

<?php

if (!empty($erreurs_ingredient)) 
{
	echo '<ul>' . "\n";
	foreach ($erreurs_ingredient as $e) 
	{
		echo ' <li>' . $e . '</li>' . "\n";
	}
	echo '</ul>';
}

echo $crea_ingredient;