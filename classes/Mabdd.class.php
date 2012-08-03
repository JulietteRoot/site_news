<?php

class Mabdd
{
	protected $bdd;	

	public function __construct()
	// fonction de connection à la base de données.
	{
		try
		{
			$this->bdd = new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');
		}
		catch (Exception $e)
		{
			die('Erreur:'.$e->getMessage());
		}
		return $this->bdd;
	}
}
