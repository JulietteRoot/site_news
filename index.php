<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Mon site</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="LeStyle.css" />
</head>

<body>
<?php include("fonctions.php"); ?>

<?php

$bdd = connection();

?>

<p>
<span class="gras">Bienvenue 
<?php
if ( isset ( $_SESSION['pseudo'] ) )
{
	echo $_SESSION['pseudo'].' !</span> <br />
	<a href="deconnexion.php">Se déconnecter</a> <br />
	<br />
	<a href="ajout_news.php">Ajouter une news</a>';
}
else
{
	echo ' ! Connectez-vous en cliquant <a href="connexion.php">ici</a>.</span><br />
	<span class="italique">Pas encore inscrit ? Inscrivez-vous en cliquant <a href="inscription.php">ici</a>.</span>';
}

if ( isset ($_GET['news']) && $_GET['news'] == "ok" )
{
	echo '<p class="rouge gras">Votre news a bien été ajoutée !</p>';
}

echo '<br /> <br />';

affichage_news($bdd);

?>

</p>

</body>

</html>



