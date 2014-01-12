
<?php
//On inclut la page de connexion et le header
include ('Includes/connexion.inc.php');
include ('Includes/haut.inc.php');

//on inclut la classe Smarty
require_once("libs/Smarty.class.php"); 
$smarty = new Smarty();

//
$req = mysql_query("SELECT * FROM articles WHERE statut=1 ORDER BY date DESC");

//On teste si la variable recherche est présente dans l'url via la méthode GET
if (isset($_GET['recherche'])) 
{
	//On crée une variable qui récupère la valeur de la variable recherche récupérée via la méthode GET
	$recherche = $_GET["recherche"];

	//On affecte à la variable $nbarticleParPage le nombre d'articles que l'on souhaite avoir par pages
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$nbarticleParPage = 2;

	//Traitement du COUNT qui compte le nombre d'articles ayant un titre ou un texte correspondant à la recherche
	$count = ("SELECT COUNT(*) AS nbarticle FROM articles WHERE statut='1' AND (titre LIKE '%$recherche%' OR texte LIKE '%$recherche%')");

	//On execute la requête et on stocke le résultat dans une variable
	$reqcount = mysql_query($count);
	$resultat=mysql_fetch_array($reqcount);
	//On récupère la valeur de nbarticle de la requête
	$totalarticle=$resultat["nbarticle"];

	//calcul du nombre de pages selon le nombre d'articles
	$nbTotalDePage = ceil($totalarticle / $nbarticleParPage);
	$debut=($page - 1) * $nbarticleParPage;

	//On assigne la valeur total article à Smarty afin de gérer l'affichage du nombre de pages sur index.tpl
	$smarty->assign('totalarticle',$totalarticle);

	//Requête qui permet de récupérer tous les articles correspondant à la recherche, ceux-ci sont récupérés par ordre décroissant
	$sql="SELECT id, titre, texte, DATE_FORMAT(DATE,'%d/%m/%Y') AS date_fr, statut FROM articles WHERE statut='1' AND (titre LIKE '%$recherche%' OR texte LIKE '%$recherche%') ORDER BY DATE DESC LIMIT $debut, $nbarticleParPage";

}

//Si l'on ne récupère pas la variable Recherche dans l'Url
else
{
	//traitement du nombre de pages
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

	//Variable récupérant le nombre d'articles que l'on désire avoir par page
	$nbarticleParPage = 2;
	//Requête permettant de compter le nombre d'articles publiés
	$count = ("SELECT COUNT(*) AS nbarticle FROM articles WHERE statut=1");
	$reqcount = mysql_query($count);
	//On execute la requête
	$resultat=mysql_fetch_array($reqcount);
	//On affecte le résultat de la requête à une variable
	$totalarticle2=$resultat["nbarticle"];
	//On divise le nombre d'articles par le nombre d'articles que l'on souhaite par pages
	$nbTotalDePage = ceil($totalarticle2 / $nbarticleParPage);
	//On gère ici le nombre de pages qui en résultent et on les insère dans la requête afin de récupérer 
	//le nombre d'articles voulus dans la requête
	$debut=($page - 1) * $nbarticleParPage;

	//Requête permettant de récupérer toutes les articles publiés en fonction de la page
	$sql=("SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr, statut FROM articles WHERE statut=1 ORDER BY date DESC LIMIT $debut, $nbarticleParPage");
}

//Execution de la requête permettant l'affichage des articles pour la recherche ou l'affichage normal en fonction du résultat de la condition précédente
$req = mysql_query($sql);

//Création d'un tableau et d'une variable $page_pas_articles qui indique qu'il n'y a pour l'instant aucun résultat
//Permet de gérer l'affichage du choix des pages en bas de page dans smarty
$data_tab = array();
$page_pas_articles="oui";

//Boucle qui récupère le nombre de résultats de la requête
while ($res = mysql_fetch_array($req))
{
	//On affecte la valeur "non" à la variable $page_pas_articles afin d'indiquer dans Smarty qu'il y au moins un résultat
	$data_tab[] = $res;
	$page_pas_articles="non";
}

//On affecte une  variable à la fonction identification de la page fonctions, appelé dans le fichier connexion.inc.php
$identification=identification();
$smarty->assign('identification',$identification);
//On assigne une variable smarty au tableau qui contient les résultats de la requête afin de gérer l'affichage des articles
$smarty->assign('data_tab',$data_tab);
//On assigne la variable $page_pas_articles à Smarty afin de gérer l'affichage du nombre de pages dans Smarty
$smarty->assign('page_pas_articles',$page_pas_articles);

//Test qui permet de gérer l'affichage du nombre de pages pour la recherche
//Si la variable Recherche existe, on récupère la variable recherche sur la page index.tpl 
if (isset($_GET['recherche']))
{
	$recherche = $_GET['recherche'];
	$smarty->assign('recherche',$recherche);
}
//Dans le cas où la variable recherche n'existe pas, on crée une variable page qui permet de gérer l'affichage normal des articles
else
{
	$page = 0;
	$smarty->assign('page',$page);
}

//On assigne la variable NbTotalDePage à Smarty afin de gérer l'affichage des pages
$smarty->assign('nbTotalDePage',$nbTotalDePage);

//affichage de la page index.tpl qui se charge de la mise en page de notre page index
$smarty->display("template/index.tpl");

//On inclut le footer
include ('Includes/bas.inc.php');
?>