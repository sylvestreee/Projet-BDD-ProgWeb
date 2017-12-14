<div id="menu">
	<h2>Menu</h2>

	<ul>
		<li><a href="index.php">Accueil</a></li>
	</ul>

	<h3>Espace membre</h3>

	<?php if (!utilisateur_est_connecte()) { ?>
	<ul>
		<li><a href="index.php?module=membres&amp;action=inscription">Inscription</a></li>
		<li><a href="index.php?module=membres&amp;action=connexion">Connexion</a></li>
		<li><a href="index.php?module=membres&amp;action=recherche_recette">Recherche d'une recette</a></li>

	</ul>
	<?php } else { ?>
	<p>Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?>.</p>
	<ul>
		<li><a href="index.php?module=membres&amp;action=deconnexion">Déconnexion</a></li>
		<li><a href="index.php?module=membres&amp;action=afficher_profil">Profil</a></a></li>
		<li><a href="index.php?module=membres&amp;action=creation_recette">Creation de recette</a></a></li>
	</ul>
	<?php } ?>
</div>
