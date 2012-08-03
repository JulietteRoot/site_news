<?php

class Mabdd
{
	private $bdd;	

	public function connection()
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
