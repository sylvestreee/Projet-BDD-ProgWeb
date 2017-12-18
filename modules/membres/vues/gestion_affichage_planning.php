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
		echo "Heure : ".$pm["heure"]."<br>"; 
	}
}

echo "Mardi ".$tuesday."<br>"."<br>";
if(!empty($planning_tuesday))
{
	foreach($planning_tuesday as $pt)
	{
		echo "Heure : ".$pt["heure"]."<br>"; 
	}
}

echo "Mercredi ".$wednesday."<br>"."<br>";
if(!empty($planning_wednesday))
{
	foreach($planning_wednesday as $pw)
	{
		echo "Heure : ".$pw["heure"]."<br>"; 
	}
}

echo "Jeudi ".$thursday."<br>"."<br>";
if(!empty($planning_thursday))
{
	foreach($planning_thursday as $pth)
	{
		echo "Heure : ".$pth["heure"]."<br>"; 
	}
}

echo "Vendredi ".$friday."<br>"."<br>";
if(!empty($planning_friday))
{
	foreach($planning_friday as $pf)
	{
		echo "Heure : ".$pf["heure"]."<br>"; 
	}
}

echo "Samedi ".$saturday."<br>"."<br>";
if(!empty($planning_saturday))
{
	foreach($planning_saturday as $psa)
	{
		echo "Heure : ".$psa["heure"]."<br>"; 
	}
}

echo "Dimanche ".$sunday."<br>"."<br>";
if(!empty($planning_sunday))
{
	foreach($planning_sunday as $psu)
	{
		echo "Heure : ".$psu["heure"]."<br>"; 
	}
}


?>

