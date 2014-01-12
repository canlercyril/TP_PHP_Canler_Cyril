<SCRIPT language="javascript">
   function ValiderConn(formulaire) {
      if (formulaire.mail.value=="" || formulaire.password.value=="") alert("Un des champs est vide !");
      else 
         formulaire.submit();
   }
</SCRIPT> 

<style type="text/css">
{literal}
 
.titre
{
border-bottom:1px dashed blue;
}
  
.mise_en_page{
padding-right:5px;
padding-left:5px;
background-color: rgba(255,255,255, 0.5);
border:1px solid #9FC6FF;
width:400px;
/*arrondir les coins en haut à gauche et en bas à droite*/
-moz-border-radius:10px 0;
-webkit-border-radius:10px 0;
border-radius:10px 0;
margin-left:auto;
margin-right:auto;
width:400px;
text-align: center;
}

{/literal}
</style>

{* On teste si la variable $deconnexion existe, variable généré sur la page connexion.php et indiquant que l'utilisateur souhaite se déconnecter *}
{if isset($deconnexion)}
	{* On affiche le succès de la deconnexion *}
	<div class="mise_en_page">
	Déconnexion réussie !</br>
	Vous allez être redirigé vers la page d'accueil.
	</div>
{/if}

{* On teste si la variable $connexion_reussie existe, variable générée sur la pagge connexion.php
Cette variable est générée si la requête de connexion est executée *}
{if isset($connexion_reussie)}
	<div class="mise_en_page">
	Connexion réussie ! </br>
	Vous allez être redirigé vers la page d'accueil.
	</div>

{* On teste si l'on récupère la variable $connexion_echec qui est générée en cas d'échec de l'authentification sur la page connexion.php *}	
{elseif $connexion_echec == "oui"}
	<div class="mise_en_page">
	Connexion échouée. Identifiant ou mot de passe incorrect !</br>
	Veuillez réessayer. 
	</div>
{/if}

{* On teste si la variable $formulaire ou $Connexion_echec existe
La première est créée si l'on ne récupère pas les variables Pseudo & Adresse Mail sur la page connexion.php
La seconde est crée en cas d'échec de l'authentification *}
{if isset($formulaire) || $connexion_echec == "oui"}

	{* On teste si la variable deconnexion existe, dans ce cas, on affiche rien *}
	{if isset($deconnexion)}
	
	{* Dans le cas contraire, on affiche le formulaire de connexion *}
	{else}
		<div class="mise_en_page">
			<div class="titre">
				<h2> Formulaire de connexion </h2>
			</div>
			</br>
		
			<form method="POST" action="connexion.php"enctype="multipart/form-data">
 
			<td><input placeholder="Adresse Mail" class="post" type="text" name="mail" size="10" /></td><br><br>

			<td><input placeholder="Mot de passe" class="post" type="password" id="password" name="password" size="10" maxlength="32" /></td><br><br>

			<div class="form-action">
				<input type="button" name ="connexion" value="Se Connecter" class="btn btn-large btn-primary" onClick="ValiderConn(this.form)"/>
			</div>
	
			</form>
		</div>
	{/if}
{/if}
