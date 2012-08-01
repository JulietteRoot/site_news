<?php

class Commentaire
{
	public function insertion_commentaire($bdd,$id_news,$commentaire,$pseudo)
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

	public function affichage_commentaires($bdd, $id_news)
	{
		$req = $bdd -> prepare ('SELECT commentaire FROM commentaires WHERE id_news=? ORDER BY id_commentaire DESC');
		$req -> execute (array ($id_news) );  

		while ($donnees = $req->fetch())
		{
			echo '<p>'.$donnees['commentaire'].'</p>';
		}

		$req -> closeCursor();
	}
}
