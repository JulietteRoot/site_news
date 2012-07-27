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
	if ( isset($var) && strlen($var) > 0 )
	{
		echo 'value="'.$var.'"';
	}
}

/*
$req = $bdd->query('SELECT id, titre, contenu FROM news ORDER BY id DESC');

while ($donnees = $req->fetch())
{
	echo '<p> <span class="gras" id="'.$donnees['id'].'">'.$donnees['titre'].'</span><br />'
	.$donnees['contenu'].'<br />';
	echo '<a href="ajout_commentaire.php?id='.$donnees['id'].'">commentaires</a></p><br />';	
}	
$req -> closeCursor();	
*/

function insertion_news($bdd, $titre, $contenu, $pseudo)
{
	$req = $bdd -> prepare('INSERT INTO news VALUES (\'\',:titre,:contenu)');
	$req -> execute (array (
		'titre' => htmlspecialchars($titre). ' (par ' .$pseudo.')',
		'contenu' => htmlspecialchars($contenu)
		) );

	$req -> closeCursor(); 
}

?>
