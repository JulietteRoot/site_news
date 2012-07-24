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
		}
		else
		{
		?>
		<p> <label for="pseudo">Votre pseudo :</label> <input type="text" name="pseudo" id="pseudo" size="30" maxlength="25" /> </p>
		<?php
		}
		?>
		<p> <textarea name="contenu" id="contenu" rows="10" cols="50">Écrivez votre commentaire ici.</textarea> </p>
		<input class="validation" type="submit" value="envoyer" /> <input class="annulation" type="reset" value="annuler" />
		</fieldset>
		</form>

		<?php
/*
			$bdd = new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');
			$req = $bdd -> prepare('SELECT pseudo FROM membres WHERE pseudo = ?');
			$req -> execute (array (htmlspecialchars($_POST['pseudo'])) );  
			
			$count = $req->rowCount();
			$req -> closeCursor(); 

			if($count == 1) 
			{
				echo '<p class="rouge">Ce pseudo est déjà utilisé par un autre membre !<br />
				     Veuiller choisir un autre pseudo !</p>';
			}
			else
			{
				$req = $bdd -> prepare('INSERT INTO membres VALUES (:pseudo,:password)');
				$req -> execute (array (
					'pseudo' => htmlspecialchars($_POST['pseudo']),
					'password' => hash('sha1',htmlspecialchars($_POST['password']))
					) );
				$req -> closeCursor();
 			}
*/
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



