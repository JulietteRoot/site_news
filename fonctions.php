<?php

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

?>
