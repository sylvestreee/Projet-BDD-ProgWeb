<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

// PLANNING

$monday = date('d/m', strtotime('monday this week'));
$tuesday = date('d/m', strtotime('tuesday this week'));
$wednesday = date('d/m', strtotime('wednesday this week'));
$thursday = date('d/m', strtotime('thursday this week'));
$friday = date('d/m', strtotime('friday this week'));
$saturday = date('d/m', strtotime('saturday this week'));
$sunday = date('d/m', strtotime('sunday this week'));

echo "Planning de la semaine du ".$monday." au ".$sunday."<br>"."<br>";

echo "Lundi ".$monday."<br>"."<br>";
echo "Mardi ".$tuesday."<br>"."<br>";
echo "Mercredi ".$wednesday."<br>"."<br>";
echo "Mardi ".$thursday."<br>"."<br>";
echo "Lundi ".$friday."<br>"."<br>";
echo "Lundi ".$saturday."<br>"."<br>";
echo "Lundi ".$sunday."<br>"."<br>";


