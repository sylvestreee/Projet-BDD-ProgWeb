<?php

foreach($info_recette as $r)
{
	echo $r["nom_recette"]."<br>"; 
	echo $r["descriptif"]."<br>"; 
	echo $r["difficulte"]."<br>"; 
	echo $r["prix"]."<br>"; 
	echo $r["nb_personnes"]."<br>"; 
}
