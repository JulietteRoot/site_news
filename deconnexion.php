<?php
session_start();
session_unset();
?>
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

// Une fois les variables de session détruites, l'internaute est redirigé vers l'index.
header('Refresh:4;url=index.php');
echo '<p><span class="gras">Merci de votre visite !</span><br />
	Vous êtes maintenant déconnecté(e).<br />
	Vous allez être redirigé(e) vers la page d\'accueil...</p><br />
	<a href="index.php">Retour direct à l\'accueil</a>';
?>

</body>

</html>



