<?php /* Smarty version Smarty-3.1.15, created on 2013-12-30 16:47:43
         compiled from "template/connexion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13035377252c1e9ff9ce948-31490337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce0e7a0a26ed018fc8f576346f88c042cf66d6a9' => 
    array (
      0 => 'template/connexion.tpl',
      1 => 1388440052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13035377252c1e9ff9ce948-31490337',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_52c1e9ff9e2788_36467176',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c1e9ff9e2788_36467176')) {function content_52c1e9ff9e2788_36467176($_smarty_tpl) {?><h2> Se connecter </h2>

 <form method="POST" action="connexion.php"enctype="multipart/form-data">
 

<td class="gensmall">   Adresse Mail : </td>
<td><input class="post" type="text" name="mail" size="10" /></td><br><br>



<td class="gensmall">   Password:</td>
<td><input class="post" type="password" name="password" size="10" maxlength="32" /></td><br><br>

	
<div class="form-action">
<input type="submit" name ="connexion" value="Connexion" class="btn btn-large btn-primary" />
</div>
	
	
</form><?php }} ?>
