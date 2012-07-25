<?php

function connection()
{
	return new PDO('mysql:host=localhost;dbname=site_news','root','meat_boy');
}

?>
