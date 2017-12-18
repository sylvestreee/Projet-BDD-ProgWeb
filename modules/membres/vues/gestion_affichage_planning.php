<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

?>

<h3> Planning de la semaine du <?php echo htmlspecialchars($monday)?> au <?php echo htmlspecialchars($sunday)?> </h3>

<?php

echo "Lundi ".$monday."<br>"."<br>";
echo "Mardi ".$tuesday."<br>"."<br>";
echo "Mercredi ".$wednesday."<br>"."<br>";
foreach($planning as $p)
{
	echo "Heure : ".$e["heure"]."<br>"."<br>"; 
}

echo "Jeudi ".$thursday."<br>"."<br>";
echo "Vendredi ".$friday."<br>"."<br>";
echo "Samedi ".$saturday."<br>"."<br>";
echo "Dimanche ".$sunday."<br>"."<br>";

?>

