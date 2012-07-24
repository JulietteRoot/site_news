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
if ( isset ($_GET['id']) )
{
	try
	{	
		$bdd = new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');

		$req = $bdd->query('SELECT id, titre FROM news WHERE id='.$_GET['id']);
		$donnees = $req->fetch();
		$id_news = $donnees['id'];
		echo '<p class="gras">'.$donnees['titre'].'</p>';
		
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
			<p> <label for="pseudo">Votre pseudo (<span class="italique">facultatif</span>) : </label> <input type="text" name="pseudo" id="pseudo" size="30" maxlength="25"
			<?php
			if ( isset($_POST['pseudo']) && strlen($_POST['pseudo']) > 0 )
			{
				echo 'value="'.$_POST['pseudo'].'"';
				$pseudo = htmlspecialchars($_POST['pseudo']);
			}
			else
			{
				$pseudo = "Anonyme";
			}
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
				$req = $bdd -> prepare('SELECT pseudo FROM membres WHERE pseudo = ?');
				$req -> execute (array ($_POST['pseudo']));
			
				$count = $req->rowCount();
				$req -> closeCursor(); 
	
				if($count == 1) 
				{
					echo '<p class="rouge gras">Ce pseudo est déjà utilisé par un membre !<br />
					     Veuiller choisir un autre pseudo !</p>';
				}
				else
				{
					$req = $bdd -> prepare('INSERT INTO commentaires VALUES (\'\',:id_news,:commentaire)');
					$req -> execute (array (
						'id_news' => $_GET['id'],
						'commentaire' => htmlspecialchars($_POST['commentaire']).' ('.$pseudo.')'
						) );

					$req -> closeCursor(); 
					header('Refresh:5;url=index.php#'.$id_news);
					echo '<p class="rouge gras">Votre commentaire a bien été posté !<br />
					Vous allez être automatiquement redirigé(e) vers la news...</p>';
				}
		
			}
			else
			{
				$req = $bdd -> prepare('INSERT INTO commentaires VALUES (\'\',:id_news,:commentaire)');
				$req -> execute (array (
					'id_news' => $_GET['id'],
					'commentaire' => htmlspecialchars($_POST['commentaire']).' ('.$pseudo.')'
					) );

				$req -> closeCursor(); 
				header('Refresh:5;url=index.php#'.$id_news);
				echo '<p class="rouge gras">Votre commentaire a bien été posté !<br />
				Vous allez être automatiquement redirigé(e) vers la news...</p>';
			}

		}
		else
		{
			echo '<p class="rouge gras">Vous devez saisir un commentaire !</p>';

		}	

		echo '<a href="index.php#'.$id_news.'">retour à la news</a>';
		$req -> closeCursor();

		echo '<p class="gras">Les commentaires déjà postés</p>'; 
		$req = $bdd -> prepare ('SELECT commentaire FROM commentaires WHERE id_news=? ORDER BY id_commentaire DESC');
		$req -> execute (array ($id_news) );  

		while ($donnees = $req->fetch())
		{
			echo '<p>'.$donnees['commentaire'].'</p>';
		}
	
		$req -> closeCursor();	

	}
	catch (Exception $e)
	{
		die('Erreur:'.$e->getMessage());
	}
}
else
{
	echo '<p class="rouge gras">Erreur. Le lien que vous avez suivi n\'est pas valide...</p>';
	echo '<p><a href="index.php">retour à l\'accueil</a></p>';
}

?>


</body>

</html>



