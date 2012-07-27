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
if ( isset ( $_SESSION['pseudo'] ) )
{
	?>
	<form method="POST" action="">
	<fieldset><legend>Ajout d'une nouvelle news</legend>
	<p> <label for="titre">Titre de la news :</label> <input type="text" name="titre" id="titre" size="70" maxlength="60"/> </p>
	<p> <textarea name="contenu" id="contenu" rows="25" cols="105">Écrivez votre news ici.</textarea> </p>
	<input class="validation" type="submit" value="poster" /> <input class="annulation" type="reset" value="annuler" />
	</fieldset>
	</form>
	<?php
}
else
{
	echo '<p class="rouge gras">Vous devez être connecté(e) pour accéder à cette page !</p>';
}

if (
	isset($_POST['titre'], $_POST['contenu']) &&
	strlen($_POST['titre']) > 0 &&
	strlen($_POST['contenu']) > 0
   )
{
	try
	{	
		$bdd = connection();
		insertion_news($bdd,$_POST['titre'],$_POST['contenu'],$_SESSION['pseudo']);
		
		header('Location:index.php?news=ok');
	}
	catch (Exception $e)
	{
		die('Erreur:'.$e->getMessage());
	}
}
else
{
	echo '<p class="rouge">Vous devez écrire un titre, et du texte pour votre news !</p>';
}

?>

<p><a href="index.php">retour à l'accueil</a></p>

</body>

</html>



