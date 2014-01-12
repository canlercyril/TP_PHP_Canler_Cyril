<?php
//On inclut la page de connexion
include ('Includes/connexion.inc.php');

//On crée la fonction identification qui permet de vérifier si le cookie de l'utilisateur correspond à un cookie présent dans la BDD
function identification ()  
{
	//On teste si le navigateur de l'utilisateur dispose de notre cookie
	if (isset ($_COOKIE['sid']))
	{	
		//On affecte une variable au cookie
		$maVariable=$_COOKIE['sid'];
		//On execute une requête permettant de compter si un sid dans la bdd correspond à celui récupéré
		$sql=mysql_query("select count(*) as total FROM utilisateurs where sid='$maVariable'");
		//On execute la requête dont on récupère le résultat dans la variable $data
		$data=mysql_fetch_array($sql);
		
		//Si la variable total correspondant au count de la requête existe, la fonction retourne TRUE
		if ($data['total'])
		{
			return true;
		}
		//Si la variable total n'existe pas, la fonction renvoie False 
		else
		{
			return false;
		}
	}
	
	//Si l'on ne récupère pas de cookie, la foncton retourne False
	else 
	{
		return false;
	}
}
?>