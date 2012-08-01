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
