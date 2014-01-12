<?php
//On inclut le header et la page de connexion
include ('Includes/haut.inc.php');
include ('Includes/connexion.inc.php');

 //on inclut la classe Smarty
require_once("libs/Smarty.class.php");
$smarty = new Smarty();

//on teste si l'on récupère la variable mail du formulaire d'inscription de la page incription.tpl via la méthode POST
if ( isset($_POST["mail"]))
	{
		//On récupère les variables du formulaire via la méthode POST auxquelles on affecte une variable
		$pseudo=$_POST["pseudo"];
		$mail=$_POST["mail"];
		$password=$_POST["password"];

		//On vérifie si l'adresse mail est déjà présente dans la bdd via une requête
		$req_verif="select * from utilisateurs where adresse_mail='$mail'";
		$sql=mysql_query($req_verif)  or die(mysql_error());
		
		
			//Si la requête retourne un résultat, on indique à l'utilisateur qu'il doit utiliser une autre adresse mail pour se connecter
		if ( $exe=mysql_fetch_array($sql))
			{
				//On crée une variable inscription_echec que l'on assigne à Smarty et qui permet de gérer l'affichage en cas d'échec de l'inscription
				$inscription_echec="oui";
				$smarty->assign('inscription_echec',$inscription_echec);
			}
			//Si la requête ne retourne rien, on insert les informations dans la bdd afin de créer l'utilisateur
		else
			{
				//On crée une variable inscription_reussie que l'on assigne à Smarty et qui permet de gérer l'affichage en cas de réussite de l'inscription
				$inscription_reussie="oui";
				$smarty->assign('inscription_reussie',$inscription_reussie);
				//Requête permettant de créer l'utilisateur
				$req="INSERT INTO utilisateurs (`pseudo_uti` ,`adresse_mail` ,`mdp`) VALUES ('". $pseudo ."',  '". $mail ."', '". $password ."');";
				$sql=mysql_query($req)  or die(mysql_error());
				//On redirige l'utilisateur vers la page de connexion
				header('Refresh: 3; url=index.php');
			}	
	}

//Dans le cas où l'on ne récupère pas la variable Mail via la méthode poste	
else 
	{
	//On crée une variable formulaire que l'on assigne à Smarty et qui permet de gérer l'affichage du formulaire d'inscription
		$formulaire="oui";
		$smarty->assign('formulaire',$formulaire);
	}

//affichage de la page inscription.tpl
$smarty->display("template/inscription.tpl");

include ('Includes/bas.inc.php');
?>