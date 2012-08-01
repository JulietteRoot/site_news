<?php

class News
{
	public function insertion_news($bdd, $titre, $contenu, $pseudo)
	{
		$req = $bdd -> prepare('INSERT INTO news VALUES (\'\',:titre,:contenu)');
		$req -> execute (array (
			'titre' => htmlspecialchars($titre). ' (par ' .$pseudo.')',
			'contenu' => htmlspecialchars($contenu)
			) );

		$req -> closeCursor(); 
	}

	public function affichage_news($bdd)
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
}
