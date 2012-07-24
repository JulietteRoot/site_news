<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Mon site</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="LeStyle.css" />
</head>

<body>

<?php

try
{
	$bdd=new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');
}
catch (Exception $e)
{
	die('Erreur:'.$e->getMessage());
}

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
$req = $bdd->query('SELECT id, titre, contenu FROM news ORDER BY id DESC');

while ($donnees = $req->fetch())
{
	echo '<p> <span class="gras">'.$donnees['titre'].'</span><br />'
	.$donnees['contenu'].'<br />';
	echo '<a href="ajout_commentaire.php?id='.$donnees['id'].'">commentaires</a></p><br />';	
}	
$req -> closeCursor();	

?>

</p>

</body>

</html>



