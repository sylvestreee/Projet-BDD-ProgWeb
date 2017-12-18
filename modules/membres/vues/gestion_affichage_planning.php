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
		echo $pm["nom_recette"]." à ".$pm["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Mardi ".$tuesday."<br>"."<br>";
if(!empty($planning_tuesday))
{
	foreach($planning_tuesday as $pt)
	{
		echo $pt["nom_recette"]." à ".$pt["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Mercredi ".$wednesday."<br>"."<br>";
if(!empty($planning_wednesday))
{
	foreach($planning_wednesday as $pw)
	{
		echo $pw["nom_recette"]." à ".$pw["heure"]."<br>";  
	}
	echo "<br>";
}

echo "Jeudi ".$thursday."<br>"."<br>";
if(!empty($planning_thursday))
{
	foreach($planning_thursday as $pth)
	{
		echo $pth["nom_recette"]." à ".$pth["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Vendredi ".$friday."<br>"."<br>";
if(!empty($planning_friday))
{
	foreach($planning_friday as $pf)
	{
		echo $pf["nom_recette"]." à ".$pf["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Samedi ".$saturday."<br>"."<br>";
if(!empty($planning_saturday))
{
	foreach($planning_saturday as $psa)
	{
		echo $psa["nom_recette"]." à ".$psa["heure"]."<br>"; 
	}
	echo "<br>";
}

echo "Dimanche ".$sunday."<br>"."<br>";
if(!empty($planning_sunday))
{
	foreach($planning_sunday as $psu)
	{
		echo $psu["nom_recette"]." à ".$psu["heure"]."<br>"; 
	}
	echo "<br>";
}

?>

