<?php
//On inclut le header et la page de connexion
include ('Includes/haut.inc.php');
include ('Includes/connexion.inc.php');

//on inclut la classe Smarty
require_once("libs/Smarty.class.php"); 
$smarty = new Smarty();

//On teste si l'on récupère dans l'url la variable deconnexion via la méthode GET 
//Cette Url est envoyé lorsque l'on clique sur le lien déconnexion du menu
if (isset($_GET["deconnexion"]))
{
	//On crée une variable qui récupère la variable deconnexion dans l'url via la méthode GET
	$deconnexion=$_GET["deconnexion"];
	//On supprime le cookie
	unset($_COOKIE['sid']);
	setcookie('sid', NULL, -1);
	//On redirige vers la page deconnexion 
	header('Refresh: 3; url=index.php');
}

//On assigne la variable deconnexion à Smarty afin de gérer l'affichage en fonction de l'action demandée
//Ici la deconnexion
$smarty->assign('deconnexion',$deconnexion);

//on teste si on récupère les variables mail & password du formulaire de connexion via la méthode POST
if ( isset($_POST["mail"]) && ($_POST["password"]))
	{
		//Récupération des variables mail & password via la méthode POST
		$mail=$_POST["mail"];
		$password=$_POST["password"];

		//On analyse dans la base de données si ce mail & ce password existent
		//On récupère le résultat de la requête
		$req="select * from utilisateurs where adresse_mail='$mail' AND mdp='$password'";
		$sql=mysql_query($req)  or die(mysql_error());

		
		//La variable $exe récupère le résultat de la requête et met à jour le sid de l'utilisateur dans la BDD si la requête renvoit quelque chose.
		if ( $exe=mysql_fetch_array($sql))
			{
				//On crée une variable qui indique que la connexion a réussi, que l'on envoie vers Smarty
				$connexion_reussie="oui";
				$smarty->assign('connexion_reussie',$connexion_reussie);
				
				//On met à jour le sid de l'utilisateur dans la BDD
				$sid=md5($exe['adresse_mail'].time());
				$update="UPDATE utilisateurs SET sid ='$sid' WHERE adresse_mail='$mail';";
				mysql_query($update)  or die(mysql_error());
				setcookie('sid', $sid, time() + 24 * 60 * 60); 
				
				//On redirige l'utilisateur connecté vers la page d'accueil
				header('Refresh: 3; url=index.php');
			}

		else
			{
				//Dans le cas où la requête $sql ne renvoie pas de résultat
				//On crée une variable connexion echec qui va permettre de gérer chez Smarty l'affichage de l'utilisateur en cas d'échec de l'authentification
				$connexion_echec="oui";
				$smarty->assign('connexion_echec',$connexion_echec);
			}	
	}
		
//Création d'une variable formulaire qui indique quand afficher le formulaire de connexion sur la page connexion.tpl,
//c'est à dire quand les variables Mail & Password ne sont pas récupérées via la méthode POST.	
else 
		{
		//On assigne la variable formulaire à Smarty
		$formulaire="oui";
		$smarty->assign('formulaire',$formulaire);
		}
		
//Affichage de la page connexion.tpl
$smarty->display("template/connexion.tpl");

//Affichage du footer de la page
include ('Includes/bas.inc.php');
?>