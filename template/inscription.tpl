<SCRIPT language="javascript">
//Fonction permettant de valider le formulaire d'inscription
function ValiderInscri(formulaire) 
{
	//On teste si les champs Mail & Password ne sont pas vides ou égales au PlaceHolder
	if (formulaire.mail.value=="" || formulaire.password.value.lenght<1 ) 
		alert("Un des champs est vide !");
		
	//On teste si l'adresse Mail comporte un @  
	else if (formulaire.mail.value.indexOf("@",0)<0) 
		alert("L'adresse Mail saisie est incorrecte !");
	  
	//Dans le cas où les deux conditions précédentes sont respectées, on envoit le formulaire 
	else 
		formulaire.submit();
}
</SCRIPT> 

<style type="text/css">
 {literal}
 
 .titre{
  border-bottom:1px dashed blue;
  }
 
.formulaire{


 padding-right:5px;
 padding-left:5px;
  background-color: rgba(255,255,255, 0.5);
border:1px solid #9FC6FF;

/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
text-align: center;
margin-left:auto;
margin-right:auto;
width:400px;
 }
 textarea{ resize:none;}


{/literal}
</style>

{* On teste si la variable $inscription_reussie existe, celle ci est crée lorsque la requête d'inscription est executée *}
{if isset($inscription_reussie)}
	<div class="formulaire">
		Inscription réussie ! Vous allez être redirigé vers la page d'accueil.
	</div>
{* On teste si la variable $inscription_echec est égale à "oui", celle ci est crée lorsque la requête d'inscription échoue *}
{elseif $inscription_echec == "oui"}
	<div class="formulaire">
		Inscription échouée. L'adresse mail que vous avez utilisée existe déjà dans notre base de données !
		</br>
		Veuillez en choisir une autre et remplir de nouveau le formulaire d'inscription. 
	</div>	</br>
{/if}

{* On teste si la variable $inscription_echec est égale à "oui" ou si la variable $formulaire existe
La variable formulaire est crée dans le cas où l'on ne récupère la variable mail via la méthode POST dans incription.php *}
{if isset($formulaire) || $inscription_echec == "oui"}

	<div class="formulaire">
		<div class="titre">
			<h2> Formulaire d'inscription </h2>
		</div></br>

		<form method="POST" action="inscription.php"enctype="multipart/form-data">
 
		<td><input placeholder="Pseudo" class="post" type="text" name="pseudo" size="10" /></td><br><br>

		<td><input placeholder="Adresse Mail" class="post" type="text" name="mail" size="10" /></td><br><br>

		<td><input placeholder="Mot de passe" class="post" type="password" id="password" name="password" size="10" maxlength="32" /></td><br><br>

		<div class="form-action">
			<input type="button" name ="Inscription" value="S'inscrire" class="btn btn-large btn-primary" onClick="ValiderInscri(this.form)"/>
		</div>
		</form>
	</div>
{/if}