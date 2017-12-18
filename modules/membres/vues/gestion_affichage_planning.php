<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

$monday = date('d/m', strtotime('monday this week'));
$sunday = date('d/m', strtotime('sunday this week'));

echo "Planning de la semaine du ".$monday." au ".$sunday;
