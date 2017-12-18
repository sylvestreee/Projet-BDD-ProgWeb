<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

?>

<h3> Planning de la semaine du <?php echo htmlspecialchars($monday)?> au <?php echo htmlspecialchars($sunday)?> </h3>

// PLANNING

<?php

echo "Lundi ".$monday."<br>"."<br>";
echo "Mardi ".$tuesday."<br>"."<br>";
echo "Mercredi ".$wednesday."<br>"."<br>";
echo "Mardi ".$thursday."<br>"."<br>";
echo "Lundi ".$friday."<br>"."<br>";
echo "Lundi ".$saturday."<br>"."<br>";
echo "Lundi ".$sunday."<br>"."<br>";

?>

