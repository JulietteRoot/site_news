<?php
include_once("Mabdd.class.php");

class News extends Mabdd
{
	public function insertion_news($titre, $contenu, $pseudo)
	{
		$req = $this->bdd -> prepare('INSERT INTO news VALUES (\'\',:titre,:contenu)');
		$req -> execute (array (
			'titre' => htmlspecialchars($titre). ' (par ' .$pseudo.')',
			'contenu' => htmlspecialchars($contenu)
			) );

		$req -> closeCursor(); 
	}

	public function affichage_news()
	{
		$req = $this->bdd -> query('SELECT id, titre, contenu FROM news ORDER BY id DESC');

		while ($donnees = $req->fetch())
		{
			echo '<p> <span class="gras" id="'.$donnees['id'].'">'.$donnees['titre'].'</span><br />'
			.$donnees['contenu'].'<br />';
			echo '<a href="ajout_commentaire.php?id='.$donnees['id'].'">commentaires</a></p><br />';	
		}	
		$req -> closeCursor();	
	}

	public function affichage_titre_news($id)
	{
		$req = $this->bdd -> prepare('SELECT id, titre FROM news WHERE id=?');
		$req -> execute(array($id));
		$donnees = $req->fetch();
		$id_news = $donnees['id'];
		echo '<p class="gras">'.$donnees['titre'].'</p>';
		$req -> closeCursor();
		return $id_news;
	}

}
