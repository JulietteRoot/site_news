<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Mon site - Commentaires</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="LeStyle.css" />
</head>

<body>
<?php include_once("fonctions.php"); ?>
<?php include_once("classes/Commentaire.class.php"); ?>
<?php include_once("classes/News.class.php"); ?>
<?php include_once("classes/Membre.class.php"); ?>

<?php

// On vérifie qu'on peut récupérer le numéro de la news (via l'url).
if ( isset ($_GET['id']) )
{
	
	$news = new News();
	$id_news = $news->affichage_titre_news($_GET['id']);
	?>
	
<!-- On affiche un formulaire pour la saisie d'un commentaire.-->
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

// Le pseudo est celui choisi, ou "anonyme" par défaut si rien n'a été inscrit. 
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

	$commentaire = new Commentaire();

// On vérifie qu'un commentaire a été saisi.
	if ( isset ($_POST['commentaire']) &&
	     strlen($_POST['commentaire']) > 0 )
	{

// Si un pseudo a été indiqué, on vérifie qu'il n'appartient pas déjà à un membre.

/* Remarque : dans le cas d'un _vrai_ site, il ne faudrait pas le gérer comme cela.
En effet, si un membre s'inscrit ultérieurement avec un pseudo "x", les commentaires postés sous ce même pseudo lui seront rétroactivement attribués, ce qui n'est pas correct.
De plus, un membre pourrait très bien s'inscrire sous le pseudo "anonyme"...
*/
		if (isset ($_POST['pseudo']) )
		{
			$membre = new Membre();
			$pseudo_dispo = $membre->verif_pseudo_disponible($_POST['pseudo']);
			if($pseudo_dispo == 1) 
			{
				echo '<p class="rouge gras">Ce pseudo est déjà utilisé par un membre !<br />
				     Veuiller choisir un autre pseudo !</p>';
			}
			else
			{
				$commentaire->insertion_commentaire($id_news,$_POST['commentaire'],$pseudo);
			}
	
		}
		else
		{
			$commentaire->insertion_commentaire($id_news,$_POST['commentaire'],$pseudo);
		}

	}

// Un message est inscrit pour demander la saisie d'un commentaire si ça n'est pas fait.
	else
	{
		echo '<p class="rouge gras">Vous devez saisir un commentaire !</p>';

	}	

	echo '<a href="index.php#'.$id_news.'">retour à la news</a>';

	echo '<p class="gras">Les commentaires déjà postés</p>'; 
	$commentaire->affichage_commentaires($id_news);
}

// En l'absence de numéro de news, on inscrit simplement un message d'erreur.
else
{
	echo '<p class="rouge gras">Erreur. Le lien que vous avez suivi n\'est pas valide...</p>';
	echo '<p><a href="index.php">retour à l\'accueil</a></p>';
}

?>


</body>

</html>



