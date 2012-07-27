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

<form method="POST" action="">
<fieldset><legend>Inscription</legend>
<p> <label for="pseudo">Choisissez un pseudo :</label> <input type="text" name="pseudo" id="pseudo" size="30" maxlength="25" 
<?php
valeur_si_existante($_POST['pseudo']);
?>
/> </p>
<p> <label for="password">Choisissez un mot de passe :</label> <input type="password" name="password" id="password" size="30" maxlength="25"/> </p>
<p> <label for="password2">Répétez le mot de passe :</label> <input type="password" name="password2" id="password2" size="30" maxlength="25"/> </p>
<input class="validation" type="submit" value="s'inscrire" /> <input class="annulation" type="reset" value="annuler" />
</fieldset>
</form>

<?php
if (
	isset($_POST['pseudo'], $_POST['password'], $_POST['password2']) &&
	strlen($_POST['pseudo']) > 0 &&
	strlen($_POST['password']) > 0 &&
	strlen($_POST['password2']) > 0
   )
{
	if ( $_POST['password'] != $_POST['password2'] )
	{
		echo '<p class="rouge">Attention, les 2 mots de passe ne coïncident pas !</p>';
	}
	else
	{
		try
		{	
			$bdd = connection();

			$i = verif_pseudo_disponible($bdd,$_POST['pseudo']);
			if($i == 1) 
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
 
				$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
				header('Refresh:4;url=index.php');
				echo '<p class="rouge"><span class="gras">Merci de vous être enregistré(e) !</span><br />
				Vous allez être redirigé(e) vers la page d\'accueil...</p>';
			}
		}
		catch (Exception $e)
		{
			die('Erreur:'.$e->getMessage());
		}
	}
}
else
{
	echo '<p class="rouge">Vous devez remplir toutes les données demandées !</p>';
}

?>

<p><a href="index.php">retour à l'accueil</a></p>

</body>

</html>



