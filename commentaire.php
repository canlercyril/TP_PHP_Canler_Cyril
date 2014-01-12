<?php
//On inclut la page de connexion et le header
include ('Includes/connexion.inc.php');
include ('Includes/haut.inc.php');

//on inclut la classe Smarty
require_once("libs/Smarty.class.php"); 
$smarty = new Smarty();

//On récupère l'ID correspondant à l'article via la méthode GET que l'on assigne à Smarty
$idGET = $_GET["id"];
$smarty->assign("idGET", $idGET);

//On teste si l'on recupère via la méthode POST la variable texteidentifie provenant du formulaire pour les utilisateurs identifiéess de la page commentaire.tpl
//Cette condition s'applique aux personnes qui postent un commentaire en étant identifiés
if (isset($_POST['texteidentifie']))
{
	//récupération du cookie de l'utilisateur 
	$sid=$_COOKIE['sid'];
	
	//Création d'un tableau 
	$result = array();

	//On compare dans la base de données le sid récupéré avec ceux présent dans la bdd
	$sql_cookie="Select id from utilisateurs where sid='$sid'";
	$req_cookie = mysql_query($sql_cookie);

	//On affecte à la variable $cookie le résultat de la requête $req_cookie 
	//On récupère uniquement la première donnée qui correspond à l'id de l'utilisateur
	$cookie=mysql_result($req_cookie,0);

	//On récupère l'ID de l'article
	$id = $_POST["id"];
	//On récupère le commentaire
	$texte = $_POST["texteidentifie"];
	//On récupère la date de publication du commentaire
	$date = date("Y-m-d");

	//On stocke dans une variable la requête permettant l'ajout d'un commentaire 
	//On utilise la variable $cookie afin d'identifier l'utilisateur qui a posté ce commentaire
	$sql= "INSERT INTO  `u360651689_php`.`commentaires` (`texte` ,`date`,`uti_id`, `arti_id`)VALUES ('". $texte ."',  '". $date ."', '". $cookie ."', '". $id ."');";
	//On execute la requête
	$req=mysql_query($sql);
	print_r($sql);

}

//On teste si l'on récupère la variable pseudo via la méthode POST, variable présente uniquement dans le formulaire Anonyme de la page commentaire.tpl
//Condition qui s'applique aux personnes non identifiées
else if (isset($_POST['pseudo']))

{
	//On récupère les variables du formulaire via la méthode POST auxquelles on attribut une variable
	$id = $_POST["id"];
	$pseudo =$_POST["pseudo"];
	$mail = $_POST["mail"];
	$texte = $_POST["texte"];
	$date = date("Y-m-d");

	//Requête permettant l'ajout d'un commentaire à un article pour un utilisateur non identifié
	//La table commentaire est lié à la table utilisateurs via le champ id de la table utilisateur et le champ uti_id de la table commentaire
	//Un utilisateur anonyme a été créé dans la table utilisateur, celui-ci dispose comme ID le chiffre 1 qui est présent de façon statique dans la requête
	$sql= "INSERT INTO  `u360651689_php`.`commentaires` (`texte` ,`date`,`uti_id`, `arti_id`, `pseudo_com`, `mail`)VALUES ('". $texte ."',  '". $date ."', '1', '". $id ."', '". $pseudo ."', '". $mail ."');";

	//On execute la requête
	$req=mysql_query($sql);
}

//On récupère si elle existe la variable id via la méthode GET
$id = $_GET["id"];

//On affecte la fonction identification présente dans la page fonctions.php, cette page est appelé dans la page connexion.php
//On lui assigne ensuite une variable pour Smarty
$identification=identification();
$smarty->assign('identification',$identification);

//Requête permettant l'affichage de l'article que l'utilisateur souhaite commenter ou pour lequel il souhaite consulter les commentaires
//On identifie l'article en fonction de son id, on vérifie si celui-ci est publié et donc accessible à l'utilisateur
$sqlarticle = "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr, statut FROM articles WHERE statut=1 AND id=$id ORDER BY date DESC";

//On stocke le résultat de la requête dans la variable $req
$req = mysql_query($sqlarticle) or die(mysql_error()."\n".$req);

//On crée un tableau que l'on stocke dans la variable $data_tab
$data_tab = array();

//Boucle permettant de récupérer les informations de l'article à commenter dans un tableau $data_tab
while ($res = mysql_fetch_array($req))
{
	$data_tab[] = $res;	
}
//On assigne ensuite une variable au tableau à Smarty pour gérer l'affichage des informations
$smarty->assign('data_tab',$data_tab);

//Requête permettant de récupérer les commentaires correspondants à l'article
//Il y a une jointure entre la table utilisateurs & Commentaires afin de gérer les commentaires des utilisateurs identifiés ou non
//On les trie par ordre Décroissant via la date
$sqlcomment = "SELECT commentaires.texte, utilisateurs.pseudo_uti, commentaires.pseudo_com, DATE_FORMAT(commentaires.date, '%d/%m/%Y') as date_fr FROM commentaires, articles, utilisateurs WHERE articles.id = commentaires.arti_id AND utilisateurs.id=commentaires.uti_id AND articles.id = $id ORDER BY commentaires.date DESC";
//On stocke le résultat de la requête dans la variable $reqcomment
$reqcomment = mysql_query($sqlcomment);

//On déclare un second tableau
$data_tab2 = array();
//Boucle permettant de récupérer les informations de chaque commentaire correspondant à l'article dans un tableau $data_tab2
while ($rescomment = mysql_fetch_array($reqcomment))
{
	//On crée une variable si la boucle s'execute qui prend la valeur "oui"
	$data_tab2[] = $rescomment;	
	$res_comment="oui";
}
//On assigne le tableau à Smarty
$smarty->assign('data_tab2',$data_tab2);
//On assigne la variable de la boucle while à Smarty, celle-ci va permettre d'afficher une phrase différente si l'article possède ou non des commentaires
$smarty->assign('res_comment',$res_comment);

//affichage de la page index.tpl qui se charge de la mise en page de notre page index.php
$smarty->display("template/commentaire.tpl");

//On inclut le footer
include ('Includes/bas.inc.php');
?>