<?php

class Membre
{
	public function ajout_membre ($bdd,$pseudo,$password)
	{
		$req = $bdd -> prepare('INSERT INTO membres VALUES (:pseudo,:password)');
		$req -> execute (array (
			'pseudo' => htmlspecialchars($pseudo),
			'password' => hash('sha1',htmlspecialchars($password))
			) );
		$req -> closeCursor();
	}

	public function identification_sur_le_site($bdd,$pseudo,$password)
// renvoie "0" si l'identification est correcte, sinon renvoie "1".
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
}
