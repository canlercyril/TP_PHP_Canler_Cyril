<?php
//On inclut le header de la page ainsi que la page connexion permettant la connexion à la BDD
include ('Includes/haut.inc.php');
include ('Includes/connexion.inc.php');

//on inclut la classe Smarty
require_once("libs/Smarty.class.php"); 
$smarty = new Smarty();

//On teste si l'utilisateur est identifié afin de vérifier qu'il puisse poster un article
//grâce à la fonction identification présente sur la page fonctions.php et appelée sur la page de connexion
if (identification()==true)
{
	//On teste si l'on recupère la variable texte_ajouter du formulaire Ajouter un Article via la méthode POST
	if (isset($_POST['texte_ajouter'])) 
	{
		//On récupère les variables du formulaire via la méthode POST que l'on poste dans des variables
		$titre = $_POST["titre"];
		$texte= $_POST["texte_ajouter"];
		$option= $_POST["option"];
		$date = date("Y-m-d");

		//On stocke la requête dans une variable $sql_ajouter_article
		$sql= "INSERT INTO  `u360651689_php`.`articles` (`titre` ,`texte` ,`date`, `statut`)VALUES ('". $titre ."',  '". $texte ."', '". $date ."','". $option ."');";
		
		//On execute la requête et l'on stocke les résultats dans la variable $req
		$req_ajouter_article=mysql_query($sql_ajouter_article);
		
		//On teste si le rédacteur de l'article a uploadé une image
		if (!empty($_POST['datafile'])) 
		{
			$erreur_image = $_FILES['datafile']['error'];
		} 
		else
		{ 
		$erreur_image = "";
		}
		
		//on affecte à la variable id, l'id de l'article à laquelle correspond l'image
		$id = mysql_insert_id();
		//On déplace le fichier vers le répertoire img et celui-ci prend la valeur de l'id de l'article
		move_uploaded_file($_FILES['datafile']['tmp_name'], dirname(__FILE__) ."/img/$id.jpg");
		//on redirige vers la page d'accueil une fois que l'article est envoyé
		header("Location: index.php");
	
	} 
	
	//Si l'on ne récupère pas la variable texte_ajouter via la méthode POST, le else s'execute
	else 
	{
		//On teste si l'on recupère la variable id via la méthode POST, celle ci correspond à l'id de l'article que l'on souhaite modifier
		if ( isset($_POST["id"]) )
		{
			//On récupère les variables du formulaire via la méthode POST que l'on poste dans des variables
			$id = $_POST["id"];
			$titre = $_POST["titre"];
			$texte= $_POST["texte"];
			$option = $_POST["option"];
	
			// On stocke la requête de modification dans une variable
			$sql_modification = "UPDATE `u360651689_php`.`articles` SET `titre` = '".$_POST["titre"]."', `texte` = '".$_POST["texte"]."', `statut` = '".$option."' WHERE `articles`.`id` = '".$_POST["id"]."';";
			
			//On teste si l'on récupère la variable datafile via la méthode POST
			if (!empty($_POST['datafile'])) 
			{
				$erreur_image = $_FILES['datafile']['error'];
			} 
			else
			{ 
			$erreur_image = "";
			}
			//On déplace l'image vers le répertoire img en renommant le fichier en fonction de l'ID de l'article
			move_uploaded_file($_FILES['datafile']['tmp_name'], dirname(__FILE__) ."/img/$id.jpg");
			
			//Si la requête fonctionne, on redirige vers la page index.php
			if ( mysql_query($sql_modification))
			{
				header("Location: index.php");
				
			} 
			//Sinon on affiche l'erreur mysql
			else 
			{
				mysql_error();
			}
			
		}	
		
		//Cette instruction IF gère l'affichage du Formulaire en fonction de la création ou de la modification d'un article
		//On teste si l'on récupère une variable id via la méthode GET
		if ( isset($_GET["id"])) 
		{ 
			//On teste dans le bdd si un article correspond à l'ID récupéré
			$sql_formulaire="SELECT * FROM articles WHERE id=".$_GET["id"]."";
			$req_formulaire = mysql_query($sql_formulaire);
			$res_formulaire = mysql_fetch_array($req_formulaire);
			extract($res_formulaire);
		
			// on récupère la variable id que l'on obtient dans l'url
			//Pour tester dans article.tpl si la valeur idGET existe et donc quel formulaire afficher
			$idGET = $_GET["id"];
			$smarty->assign("idGET", $idGET);
		
			//On récupère les valeurs de notre $res_formulaire pour les utiliser dans article.tpl
			//Afin de récupérer les valeurs correspondant aux champs Titre & Texte
			$smarty->assign("dataForm", $res_formulaire);
		
			//On affiche la page article.tpl
			$smarty->display("template/article.tpl");

		} 
		else 
		{
			//On affiche le formulaire d'ajout d'un nouvel article
			$smarty->display("template/article.tpl");
		}
	}
}

//Si la personne n'est pas identifiée, on affiche un message lui indiquant qu'elle n'est pas autorisée à consulter et cette page 
//On la renvoie vers la page d'accueil par la suite
else
{
	echo "Vous n'êtes pas autorisés à accéder à cette page !</br></br>";
	echo "Vous allez être redirigés vers la page d'accueil.";
	header('Refresh: 3; url=index.php');
}


//On inclut le footer
include ('Includes/bas.inc.php');
?>

