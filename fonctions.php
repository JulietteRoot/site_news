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

function insertion_news($bdd, $titre, $contenu, $pseudo)
{
	$req = $bdd -> prepare('INSERT INTO news VALUES (\'\',:titre,:contenu)');
	$req -> execute (array (
		'titre' => htmlspecialchars($titre). ' (par ' .$pseudo.')',
		'contenu' => htmlspecialchars($contenu)
		) );

	$req -> closeCursor(); 
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

function affichage_news($bdd)
{
	$req = $bdd->query('SELECT id, titre, contenu FROM news ORDER BY id DESC');

	while ($donnees = $req->fetch())
	{
		echo '<p> <span class="gras" id="'.$donnees['id'].'">'.$donnees['titre'].'</span><br />'
		.$donnees['contenu'].'<br />';
		echo '<a href="ajout_commentaire.php?id='.$donnees['id'].'">commentaires</a></p><br />';	
	}	
	$req -> closeCursor();	
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

function identification_sur_le_site($bdd,$pseudo,$password)
{

	$req = $bdd -> prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo AND password = :password');
	$req -> execute (array (
		'pseudo' => htmlspecialchars($pseudo),
		'password' => hash('sha1',htmlspecialchars($password))
		) );

	$count = $req->rowCount();
	$req -> closeCursor(); 

		if($count == 1) 
		{
			$retour = 0;
		}
		else
		{
			     $retour = 1;
		}
return $retour;
}

?>
