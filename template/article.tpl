<SCRIPT language="javascript">
//Fonction qui teste si les champs Titre & Texte de modification d'un article ne soient pas vides
//La fonction envoie une alerte dans le cas où une des conditions n'est pas respectée
function ValiderModifier(formulaire) 
{
	if ((formulaire.titre.value=="" || formulaire.texte.value=="" )) 
	{
		alert("Un ou plusieurs champs sont vides !");
	}
	else
	{
		formulaire.submit();
	}
}
//Fonction qui teste si les champs Titre & Texte de modification d'un article ne soient pas vides ou égales au Placeholder
//La fonction envoie une alerte dans le cas où une des conditions n'est pas respectée
function ValiderRediger(formulaire) 
{
	if ((formulaire.titre.value=="" || formulaire.titre.value=="Titre" || formulaire.texte_ajouter.value=="" || formulaire.texte_ajouter.value=="Texte de votre article"  )) 
	{
	alert("Un ou plusieurs champs n'ont pas été renseignés !");
	}
	else
	{
	formulaire.submit();
	}
}
</SCRIPT> 


<style type="text/css">
{literal}

.formulaire{
padding-right:5px;
padding-left:5px;
background-color: rgba(255,255,255, 0.5);
border:1px solid #9FC6FF;
/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
}

{/literal}
</style>

{* On teste si l'on récupère la variable idGET précédemment déclarée sur la page Index.php
Celle-ci permet d'afficher le formulaire de modification d'un article dans le cas où la variable est bien récupérée *}
{if isset($idGET)}

	<h2> Modifier un article </h2>

	<div class="formulaire">
		<form action="article.php" method="POST" enctype="multipart/form-data">

			<div class="clearfix">
				<label for="titre">Titre</label>
				<div class="impact"><input type="text" name="titre" id="titre" value="{$dataForm['titre']}" /></div>
			</div>
			
			<div class="clearfix">
				<label for="text">Texte</label>
					<div class="impact">
					<textarea style="FONT-SIZE: 12pt; WIDTH: 450px;  FONT-FAMILY: Verdana" rows="10" name="texte" id="texte">{$dataForm['texte']}</textarea>
				</div>
			</div>
			
			<input type="checkbox" name="option" id='option' value="1"> Cochez pour publier votre article<br /><br />
			
			<label for="text"> Fichier :</label><br />
			<input type="file" id="datafile" name="datafile" size="40">
			
			<br /><br />
			
			<input type="hidden" name="id" id="id" value="{$idGET}" ></textarea>

			<div class="form-action">
				<input type="button" value="modifier" class="btn btn-large btn-primary" onClick="ValiderModifier(this.form)" />
			</div>

		</form>
			</div>
			
{* Dans le cas où la variable idGET n'est pas récupérée, le formulaire de rédaction d'un article est affiché *}
{else}
		
	<div class="formulaire">
		
		<h2> Rédiger un article </h2>

		<form method="POST" action="article.php"enctype="multipart/form-data" onsubmit="return verifier();">

		<div class="clearfix">
			<div class="impact">
				<input style="FONT-SIZE: 12pt; WIDTH: 450px;  FONT-FAMILY: Verdana" placeholder="Titre" type="text" name="titre" id="titre" />
			</div>
		</div>
	
		<div class="clearfix">
			<div class="impact">
				<textarea style="FONT-SIZE: 12pt; WIDTH: 450px;  FONT-FAMILY: Verdana" rows="10" placeholder="Texte de votre article" name="texte_ajouter" id="texte_ajouter"></textarea>
			</div>
		</div>
	
		<br>
	
		<input type="checkbox" name="option" id='option' value="1"> Cochez pour publier votre article<br /><br />

	
		<input type="file" id="datafile" name="datafile" size="40">
		
		<br /><br />
	
		<div class="form-action">
	
		<input type="button" name ="Ajouter" value="Ajouter" class="btn btn-large btn-primary" onClick="ValiderRediger(this.form)" />
		
		</div>
	
		</form>
		
	</div>
	
{/if}