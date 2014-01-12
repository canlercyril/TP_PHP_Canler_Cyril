<SCRIPT language="javascript">
	//Fonction permettant de vérifier qu'une personne identifié n'envoie pas un commentaire vide ou correspondant au Placeholder
	function ValiderFormIdenti(formulaire) 
	{
		if (formulaire.texteidentifie.value=="" || formulaire.texteidentifie.value=="Participez à la discussion ...") 
		alert("Vous ne pouvez pas envoyer un commentaire vide !");
      
		else 
		formulaire.submit();
	}

	//Fonction permettant de vérifier qu'une personne non identifié remplisse tous les champs du formulaire ( Pseudo, Mail, Commentaire)
   function ValiderFormAnony(formulaire) 
   {
		if ((formulaire.pseudo.value=="" || formulaire.pseudo.value=="Pseudo" || formulaire.mail.value=="" || formulaire.mail.value=="Adresse Mail" ) || formulaire.mail.texte=="" || formulaire.texte.value=="Participez à la discussion ...") 
		{
			alert("Un ou plusieurs champs n'ont pas été renseignés !");
		}
		
		//Et qui vérifie également si l'adresse mail comporte un @
		else if (formulaire.mail.value.indexOf("@",0)<0 ) 
			alert("L'adresse Mail saisie est incorrecte !");
		
		//Si les deux conditions précédentes sont respectées, le formulaire est envoyé
		else 
		{   
			formulaire.submit();
		}
		  
	}
</SCRIPT> 

<style type="text/css">
{literal}
 
.commentaire
{
clear:both;
background-color:#E4EFFF;
border:1px solid #9FC6FF;
padding:5px;
/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
margin-bottom:15px;
}
  
  
.image {
-moz-border-radius:12px;
-webkit-border-radius:12px;
border-radius:15px;
height :150px;
width :150px;
float:right;
}

.commentairetitre
{
clear:both;
}

.titre
{
border-bottom:1px dashed blue;
}
 
.article{
padding-right:5px;
padding-left:5px;
background-color: rgba(255,255,255, 0.5);
border:1px solid #9FC6FF;
/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
padding-bottom:5px;
min-height:250px;
}

textarea
{ 
resize:none;
}

{/literal}

</style>


<hr> 
<div class="page">
	{foreach from=$data_tab item=data}
		<div class="article">
			<div class="titre">
				<h2>{$data['titre']}</h2>
			</div>
			
			<p style = "text-align: justify;">
			<p>Le : <b>{$data['date_fr']} </b></p>

			<div class="texte">
				{assign var='name' value="img/{$data['id']}.jpg"}
				{if file_exists($name)}
					<img class ="image" src="img/{$data['id']}.jpg" />
				{/if}
				
				<div class="test">
					<p>{$data['texte']}</p>
				</div>
			</div>
		</div>
		
	{/foreach}

	<div class="commentairetitre">
		<hr> 
		
		{if $res_comment == "oui"}
			<b><u>Commentaires :</u></b></br></br>
		{else if}
			<b>Cet article n'a pas encore été commenté, soyez le premier !</b></br>
		{/if}


		{foreach from=$data_tab2 item=data2}
			<div class="commentaire">
				Publié par : <b>{$data2['pseudo_uti']}{$data2['pseudo_com']}</b>
				<p>Le : <b>{$data2['date_fr']} </b></p>
				<p style = "text-align: justify;">
				<p>{$data2['texte']}</p>
			</div>
		{/foreach}

	</div>

	<hr>

	<div class="comm">
		{if $identification == true}

			<form name="form_commentaire_identi" form action="commentaire.php?id={$idGET}" method="POST" enctype="multipart/form-data" >
	
			<div class="clearfix">
				<div class="impact"><textarea style="FONT-SIZE: 12pt; WIDTH: 500px;  FONT-FAMILY: Verdana" rows="5" name="texteidentifie" id="texteidentifie" onFocus="if(this.value=='Participez à la discussion ...')this.value=''">Participez à la discussion ...</textarea>
				</div>
			<br>
			</div>

			<input type="hidden" name="id" id="id" value="{$idGET}" ></textarea>
	
			<div class="form-action">
				<input type="button" name ="Soumettremembre" value="Commenter" class="btn btn-large btn-primary" onClick="ValiderFormIdenti(this.form)" />
			</div>
	
			</form>

		{/if}
	</div>

	{if $identification == false}

		<form name="form_commentaire_anony" form action="commentaire.php?id={$idGET}" method="POST" enctype="multipart/form-data">
 
		<textarea placeholder="Pseudo" style="FONT-SIZE: 12pt; WIDTH: 241px;  FONT-FAMILY: Verdana" rows="1"  type="text" name="pseudo" id="pseudo" /></textarea>

		<textarea placeholder="Adresse Mail" style="FONT-SIZE: 12pt; WIDTH: 241px;  FONT-FAMILY: Verdana" rows="1"  type="text" name="mail" id="mail" /></textarea>

		<div class="clearfix">
			<div class="impact">
				<textarea placeholder="Participez à la discussion ..." style="FONT-SIZE: 12pt; WIDTH: 500px;  FONT-FAMILY: Verdana" rows="5" name="texte"  id="texte" ></textarea>
			</div>
			<br>
		</div>

		<input type="hidden" name="id" id="id" value="{$idGET}" ></textarea>
	
		<div class="form-action">
			<input type="button" name ="Soumettreanonyme" value="Commenter" class="btn btn-large btn-primary" onClick="ValiderFormAnony(this.form)" />
		</div>
	
		</form>
		
	{/if}
	
</div>

<br><br><br>