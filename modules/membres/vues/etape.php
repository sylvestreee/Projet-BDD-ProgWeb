<h3>Ajouter une étape</h3>

<h4>Choix du type :</h4>
<ul>
  <li>1 = cuisson</li>
  <li>2 = repos</li>
  <li>3 = autre</li>
</ul>

<?php

if (!empty($erreurs_etape)) 
{
	echo '<ul>' . "\n";
	foreach ($erreurs_etape as $e) 
	{
		echo ' <li>' . $e . '</li>' . "\n";
	}
	echo '</ul>';
}

echo $etape_uti;
echo $crea_etape;