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

function affichage_commentaires($bdd, $id_news)
{
	$req = $bdd -> prepare ('SELECT commentaire FROM commentaires WHERE id_news=? ORDER BY id_commentaire DESC');
	$req -> execute (array ($id_news) );  

	while ($donnees = $req->fetch())
	{
		echo '<p>'.$donnees['commentaire'].'</p>';
	}

	$req -> closeCursor();
}

function affichage_titre_news($bdd,$id)
{
	$req = $bdd->prepare('SELECT id, titre FROM news WHERE id=?');
	$req -> execute(array($id));
	$donnees = $req->fetch();
	$id_news = $donnees['id'];
	echo '<p class="gras">'.$donnees['titre'].'</p>';
	$req -> closeCursor();
	return $id_news;
}

function definition_pseudo($pseudo_indique)
// La variable $pseudo est celle indiquée, ou à défaut "Anonyme".
{
	if ( isset($pseudo_indique) && strlen($pseudo_indique) > 0 )
	{
		$pseudo = htmlspecialchars($pseudo_indique);
	}
	else
	{
		$pseudo = "Anonyme";
	}
return $pseudo;
}

function valeur_si_existante($var)
// évite d'avoir un ressaisir une donnée dans un formulaire HTML.
{
	if ( isset($var) && strlen($var) > 0 )
	{
		echo 'value="'.$var.'"';
	}
}

function verif_pseudo_disponible($bdd,$pseudo_a_tester)
{
	$req = $bdd -> prepare('SELECT pseudo FROM membres WHERE pseudo = ?');
	$req -> execute (array (htmlspecialchars($pseudo_a_tester)) );

	$count = $req->rowCount();
	$req -> closeCursor(); 

	if($count == 1) 
	{
		$retour = 1;
	}
	else
	{
		$retour = 0;
	}
return $retour;
}


?>
