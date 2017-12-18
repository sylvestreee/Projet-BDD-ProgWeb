<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

$monday = date('dd/mm', strtotime('monday this week'));
$sunday = date('dd/mm', strtotime('sunday this week'));

echo "Planning de la semaine du".$monday." au ".$sunday;
