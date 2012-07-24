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
		echo '<p class="gras">'.$donnees['titre'].'</p>';
		?>
		
		<?php
		echo '<a href="index.php#'.$donnees['id'].'">retour à la news</a>';
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



