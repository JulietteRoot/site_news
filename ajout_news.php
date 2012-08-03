<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Mon site</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="LeStyle.css" />
</head>

<body>
<?php include_once("fonctions.php"); ?>
<?php include_once("classes/News.class.php"); ?>

<?php

// On vérifie que la personne est connectée.
if ( isset ( $_SESSION['pseudo'] ) )
{
	?>

<!--On affiche un formulaire pour créer une nouvelle news.-->
	<form method="POST" action="">
	<fieldset><legend>Ajout d'une nouvelle news</legend>
	<p> <label for="titre">Titre de la news :</label> <input type="text" name="titre" id="titre" size="70" maxlength="60"
		<?php
		valeur_si_existante($_POST['titre']);
		?>
	/> </p>
	<p> <textarea name="contenu" id="contenu" rows="25" cols="105"><?php
	if ( isset($_POST['contenu']) && strlen($_POST['contenu']) > 0 )
	{
		echo $_POST['contenu'];
	}
	else
	{
		echo 'Écrivez votre news ici.';
	}
	?>
	</textarea> </p>
	<input class="validation" type="submit" value="poster" /> <input class="annulation" type="reset" value="annuler" />
	</fieldset>
	</form>
	<?php

// On vérife que toutes les données sont remplies.
	if (	isset($_POST['titre'], $_POST['contenu']) &&
		strlen($_POST['titre']) > 0 &&
		strlen($_POST['contenu']) > 0	 )
	{
		try
		{	

// Si tout est ok, on insère la news dans la base de données, et on renvoie automatiquement vers la page d'accueil.
			$news = new News();
			$news->insertion_news($_POST['titre'],$_POST['contenu'],$_SESSION['pseudo']);
		
			header('Location:index.php?news=ok');
		}
		catch (Exception $e)
		{
			die('Erreur:'.$e->getMessage());
		}
	}

// S'il manque une donnée, on affiche un message d'erreur.
	else
	{
	echo '<p class="rouge">Vous devez écrire un titre, et du texte pour votre news !</p>';
	}

}
// Si la personne n'est pas connectée, on inscrit un message d'erreur.
else
{
	echo '<p class="rouge gras">Vous devez être connecté(e) pour accéder à cette page !</p>';
}

?>

<p><a href="index.php">retour à l'accueil</a></p>

</body>

</html>



