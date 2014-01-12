<?php
//On inclut la page de connexion et le header
include ('Includes/connexion.inc.php');
include ('Includes/haut.inc.php');

//on inclut la classe Smarty
require_once("libs/Smarty.class.php"); 
$smarty = new Smarty();

//On récupère l'ID présent dans l'url via la méthode GET, qui est inséré dans le bouton de suppression de la page index.tpl
$id = $_GET['id'];
//On affecte la requête permettant de supprimer l'article correspondant à cet ID
//Les commentaires correspondant à cet article sont supprimés automatiquement puisqu'une relation a été crée entre l'id de l'article
//et le champ arti_id de la table commentaire afin d'effectuer une suppression en cascade lorsque l'id de l'article est supprimé 
//grâce au moteur de stockage InnoDB
$SQL = "DELETE FROM articles Where id='$id';";
$req = mysql_query($SQL);

//On redirige l'utilisateur vers la page index.php
header('Refresh: 3; url=index.php');

//On affiche la page supprimer.tpl
$smarty->display("template/supprimer.tpl");

include ('Includes/bas.inc.php');
?>