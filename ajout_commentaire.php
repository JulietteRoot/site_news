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
if ( isset ($_GET['id']) )
{
	$bdd = connection();

	$id_news = affichage_titre_news($bdd,$_GET['id']);
	?>
	
	<form method="POST" action="">
	<fieldset><legend>Ajout d'un nouveau commentaire</legend>
	<?php
	if ( isset ( $_SESSION['pseudo'] ) )
	{
		echo 'Votre pseudo : <span class="gras">'.$_SESSION['pseudo'].'</span><br />';
		$pseudo = $_SESSION['pseudo'];
	}
	else
	{
		?>
		<p> <label for="pseudo">Votre pseudo (<acronym class="italique" title='Si vous ne mentionnez pas de pseudo, vous apparaîtrez en tant que "Anonyme".'>facultatif</acronym>) : </label> <input type="text" name="pseudo" id="pseudo" size="30" maxlength="25"
		<?php
		valeur_si_existante($_POST['pseudo']);
		$pseudo = definition_pseudo($_POST['pseudo']);
		
		echo '/> </p>';
	}
	?>
	<p> <textarea name="commentaire" id="commentaire" rows="10" cols="50"><?php
	if ( isset($_POST['commentaire']) && strlen($_POST['commentaire']) > 0 )
	{
		echo $_POST['commentaire'];
	}
	else
	{
		echo 'Écrivez votre commentaire ici.';
	}
	?>
	</textarea> </p>
	<input class="validation" type="submit" value="envoyer" /> <input class="annulation" type="reset" value="annuler" />
	</fieldset>
	</form>

	<?php
	if ( isset ($_POST['commentaire']) &&
	     strlen($_POST['commentaire']) > 0 )
	{
		if (isset ($_POST['pseudo']) )
		{
			$i = verif_pseudo_disponible($bdd,$_POST['pseudo']);
			if($i == 1) 
			{
				echo '<p class="rouge gras">Ce pseudo est déjà utilisé par un membre !<br />
				     Veuiller choisir un autre pseudo !</p>';
			}
			else
			{
				insertion_commentaire($bdd,$id_news,$_POST['commentaire'],$pseudo);
			}
	
		}
		else
		{
			insertion_commentaire($bdd,$id_news,$_POST['commentaire'],$pseudo);
		}

	}
	else
	{
		echo '<p class="rouge gras">Vous devez saisir un commentaire !</p>';

	}	

	echo '<a href="index.php#'.$id_news.'">retour à la news</a>';

	echo '<p class="gras">Les commentaires déjà postés</p>'; 
	affichage_commentaires($bdd,$id_news);
}
else
{
	echo '<p class="rouge gras">Erreur. Le lien que vous avez suivi n\'est pas valide...</p>';
	echo '<p><a href="index.php">retour à l\'accueil</a></p>';
}

?>


</body>

</html>



