<SCRIPT language="javascript">
//Fonction qui demande confirmation lorsqu'un utilisateur souhaite supprimer un article
function delete() 
{
	confirmation = confirm('Etes-vous sur de vouloir supprimer cet article ?');
	
	if (confirmation) 
	{
		document.location.href = './supprimer.php?id={$data['id']}';
    }
}
</SCRIPT> 

<style type="text/css">

 
   .image {

-moz-border-radius:12px;
-webkit-border-radius:12px;
border-radius:15px;
height :150px;
width :150px;
float:right;
margin-bottom:15px;
}
  .titre{
  border-bottom:1px dashed blue;
  }
 .article{

clear:both;
  background-color: rgba(255,255,255, 0.5);
border:1px solid #9FC6FF;
padding:5px;
/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
margin-bottom:15px;
min-height:250px;
 }

</style>

<!-- On teste si la variable recherche existe, si c'est le cas, on affiche quel mot ou suite de mots a été recherché -->
{if isset($recherche)}
	<hr>
	Votre recherche est : <b> {$recherche} </b><br /><br />
{/if}

<!-- Affichage du nombre de résultats de la recherche grâce à la variable $totalarticle -->
{if isset($totalarticle)}
	{if $totalarticle == 0 }
		<b>Aucun résultat ne correspond à votre recherche</b><br /><hr>
	{elseif $totalarticle == 1}
		<b>un</b> seul résultat correspond à votre recherche</b><hr>
	{else}
		<b>{$totalarticle}</b> résultats correspondent à votre recherche<br /><hr>
	{/if}
{/if}

<!-- On gère ici la phrase affichée si l'on a affaire à la recherche ou à l'affichage normal-->
<!-- On teste d'abord si c'est une recherche -->
{if isset($recherche)}
	<!-- On teste si il y a des résultats à cette recherche -->
	{if $page_pas_articles == 'non'}
		<h2>Articles correspondant à votre recherche :</h2><hr>
	{/if}
{else if}
	<!-- On  gère ici la phrase affichée pour l'affichage normal des articles -->
	<!-- Si il y a des articles publiés dans la bdd -->
	{if $page_pas_articles == 'non'}
		<h2>Derniers Articles :</h2><hr>
	<!-- Si il n'y a pas d'articles publiés dans la bdd -->
	{elseif $page_pas_articles == 'oui'}
		<b>Aucun article n'a été publié pour le moment</b>
	{/if}
{/if}


<div class='article_complet'>
	<!-- La boucle for affiche les articles tant qu'il y a un résultat -->
	{foreach from=$data_tab item=data}
		<div class='article'>
			<div class="titre">
				<a href="commentaire.php?id={$data['id']}"><h3>{$data['titre']}</h3></a>
			</div>
			<p style = "text-align: justify;">
			<p>Le : <b>{$data['date_fr']} </b></p>
			<!-- On crée une variable image qui récupère le nom de l'image-->
			{assign var='image' value="img/{$data['id']}.jpg"}
			<!-- On teste ensuite si une image correspond dans la bdd et on l'affiche si elle existe, elle n'est pas affichée dans le cas contraire -->
			{if file_exists($image)}
				<img class ="image" src="img/{$data['id']}.jpg" />
			{/if}
			<p>{$data['texte']}</p>
		</div>
	<div>

		<table border="0">
			<tr>
			<td width="500px">
				<!-- Si la personne n'est pas identifiée, uniquement le bouton Commentaires est affiché -->
				<a align='left' class="btn btn-primary btn-lg" href="commentaire.php?id={$data['id']}">Commentaires</a>
				</td>
			<td width="300px" align="right">
				<!-- Si la personne est identifiée, les boutons Editer & Supprimer sont affichés sous l'article -->
				{if $identification == true}
					<a class="btn btn-success " href="article.php?id={$data['id']}">Editer</a>
					&nbsp; &nbsp;
					<!--Bouton supprimer pour un article, qui demande confirmation avant suppression -->
					<a class="btn btn-danger " title="Descripotion du site" onclick="return confirm('êtes vous sur de vouloir supprimer cet article ? ');" href="supprimer.php?id={$data['id']}">Supprimer</a> 
				{/if}
			</td>
			</tr>
			</table>
	</div>
	<hr> 
	{/foreach}
</div>


<!-- Gestion de l'affichage du numéro de page en fonction du résultat de la requête de la recherche ou de l'affichage normal -->
<!-- Si il y a un résultat aux requêtes, on affiche les pages en fin de page, sinon non -->
{if $page_pas_articles == 'non'}
	<!-- si la variable $recherche existe, on affiche cette gestion des pages avec la variable recherche dans l'url et le numéro de la page -->
	{if isset($recherche)}
		{if $totalarticle != 0 }
			Page n°
			{for $foo=1 to $nbTotalDePage}
				<a href="index.php?recherche={$recherche}&page={$foo}">{$foo}</a>
			{/for}
		{/if}
	<!-- Si on a affaire à un affichage normal, on affiche les pages avec uniquement la variable page en URL -->
	{elseif $page == 0}
		Page n° 
		{for $foo=1 to $nbTotalDePage}
			<a href="index.php?page={$foo}">{$foo}</a>
		{/for}
	{/if}
{/if}