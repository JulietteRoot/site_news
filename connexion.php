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
<?php include_once("classes/Membre.class.php"); ?>

<!--La personne se connecte via un formulaire.-->
<form method="POST" action="">
<fieldset><legend>Connexion</legend>
<p> <label for="pseudo">Pseudo :</label> <input type="text" name="pseudo" id="pseudo" size="30" maxlength="25"
<?php valeur_si_existante($_POST['pseudo']); ?>
/> </p>
<p> <label for="password">Mot de passe :</label> <input type="password" name="password" id="password" size="30" maxlength="25"/> </p>
<input class="validation" type="submit" value="valider" /> <input class="annulation" type="reset" value="annuler" />
</fieldset>
</form>

<?php

// On vérifie que le pseudo et le mot de passe ont été saisis.
if (
	isset($_POST['pseudo'], $_POST['password']) &&
	strlen($_POST['pseudo']) > 0 &&
	strlen($_POST['password']) > 0
   )
{
	try
	{	
		$membre = new Membre();
		$est_identifie = $membre->identification_sur_le_site($_POST['pseudo'],$_POST['password']);

// Si l'identification est correcte, la personne est connectée et renvoyée vers l'index.
		if($est_identifie == 0) 
		{
			$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
			header('Location:index.php');
		}

// Sinon, elle doit s'identifier à nouveau.
		else
		{
			echo '<p class="rouge">Attention, le pseudo et/ou le mot de passe sont erronés.<br />
			     Vérifiez votre saisie !</p>'; 
		}
	}
	catch (Exception $e)
	{
		die('Erreur:'.$e->getMessage());
	}
}
else
{
	echo '<p class="rouge">Vous devez renseigner votre pseudo et votre mot de passe !</p>';
}
?>

<p><a href="index.php">retour à l'accueil</a></p>

</body>

</html>



