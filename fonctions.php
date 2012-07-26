<?php

function connection()
{
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');
	}
	catch (Exception $e)
	{
		die('Erreur:'.$e->getMessage());
	}
	return $bdd;
}

function insertion_commentaire($bdd,$id_news,$commentaire,$pseudo)
{
	$req = $bdd -> prepare('INSERT INTO commentaires VALUES (\'\',:id_news,:commentaire)');
	$req -> execute (array (
		'id_news' => $id_news,
		'commentaire' => htmlspecialchars($commentaire).' ('.$pseudo.')'
		) );

	$req -> closeCursor(); 
	header('Refresh:5;url=index.php#'.$id_news);
	echo '<p class="rouge gras">Votre commentaire a bien été posté !<br />
	Vous allez être automatiquement redirigé(e) vers la news...</p>';
}

function valeur_si_existante($var)
{
	if ( isset($var) )
	{
		echo 'value="'.$var.'"';
	}
}

?>
