<h2> Gestion du planning </h2>

<h3> Ajouter une recette </h3>

<?php

echo $recette;
echo $gest_planning;

?>

<h3> Planning de la semaine du <?php echo htmlspecialchars($monday)?> au <?php echo htmlspecialchars($sunday)?> </h3>

<?php

echo "Lundi ".$monday."<br>"."<br>";
if(!empty($planning_monday))
{
	foreach($planning_monday as $pm)
	{
		echo $pm["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Mardi ".$tuesday."<br>"."<br>";
if(!empty($planning_tuesday))
{
	foreach($planning_tuesday as $pt)
	{
		echo $pt["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Mercredi ".$wednesday."<br>"."<br>";
if(!empty($planning_wednesday))
{
	foreach($planning_wednesday as $pw)
	{
		echo $pw["id_recette"]." à ".$pm["heure"]."<br>";  
	}
	echo "<br>";
}

echo "Jeudi ".$thursday."<br>"."<br>";
if(!empty($planning_thursday))
{
	foreach($planning_thursday as $pth)
	{
		echo $pth["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Vendredi ".$friday."<br>"."<br>";
if(!empty($planning_friday))
{
	foreach($planning_friday as $pf)
	{
		echo $pf["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Samedi ".$saturday."<br>"."<br>";
if(!empty($planning_saturday))
{
	foreach($planning_saturday as $psa)
	{
		echo $psa["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Dimanche ".$sunday."<br>"."<br>";
if(!empty($planning_sunday))
{
	foreach($planning_sunday as $psu)
	{
		echo $psu["id_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

?>

