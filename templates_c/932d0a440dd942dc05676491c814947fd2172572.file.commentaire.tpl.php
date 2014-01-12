<?php /* Smarty version Smarty-3.1.15, created on 2014-01-02 08:25:45
         compiled from "template/commentaire.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192660033552c568d9c800c6-34006273%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '932d0a440dd942dc05676491c814947fd2172572' => 
    array (
      0 => 'template/commentaire.tpl',
      1 => 1388440814,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192660033552c568d9c800c6-34006273',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_tab' => 0,
    'data' => 0,
    'data_tab2' => 0,
    'data2' => 0,
    'identification' => 0,
    'idGET' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_52c568d9d9e096_88412120',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c568d9d9e096_88412120')) {function content_52c568d9d9e096_88412120($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_tab']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value) {
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>

<h2><?php echo $_smarty_tpl->tpl_vars['data']->value['titre'];?>
</h2>
<p style = "text-align: justify;">
<p>Le : <?php echo $_smarty_tpl->tpl_vars['data']->value['date_fr'];?>
 </p>
<p><?php echo $_smarty_tpl->tpl_vars['data']->value['texte'];?>
</p>
<p><img src="img/<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
.jpg" alt="image"/>
<hr> 
<?php } ?>

<p>Commentaires : </p>
<hr> 
<?php  $_smarty_tpl->tpl_vars['data2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data_tab2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data2']->key => $_smarty_tpl->tpl_vars['data2']->value) {
$_smarty_tpl->tpl_vars['data2']->_loop = true;
?>
Publié par : <b><?php echo $_smarty_tpl->tpl_vars['data2']->value['pseudo_uti'];?>
<?php echo $_smarty_tpl->tpl_vars['data2']->value['pseudo_com'];?>
</b>
<p>Le : <?php echo $_smarty_tpl->tpl_vars['data2']->value['date_fr'];?>
 </p>
<p style = "text-align: justify;">
<p><?php echo $_smarty_tpl->tpl_vars['data2']->value['texte'];?>
</p>
<hr> 
<?php } ?>

<?php if ($_smarty_tpl->tpl_vars['identification']->value==true) {?>
<h2> Poster un commentaire </h2>

 <form action="commentaire.php" method="POST" enctype="multipart/form-data">
	
	<div class="clearfix">
		<label for="text">Commentaire :</label>
		<div class="impact"><textarea name="texte" id="texte"></textarea></div><br>
	</div>

	<input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['idGET']->value;?>
" ></textarea>
	
	<div class="form-action">
	
		<input type="submit" name ="Soumettre" value="Soumettremembre" class="btn btn-large btn-primary" />
	</div>
	
	
</form>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['identification']->value==false) {?>
<h2> Poster un commentaire </h2>

 <form action="commentaire.php" method="POST" enctype="multipart/form-data">
 
 <div class="clearfix">
		<label for="text">Pseudo :</label>
		<div class="impact"><input type="text" name="pseudo" id="pseudo" /></div>
	</div>
	
	<div class="clearfix">
		<label for="text">Adresse mail :</label>
		<div class="impact"><input type="text" name="mail" id="mail" /></div>
	</div>
	
	<div class="clearfix">
		<label for="text">Commentaire :</label>
		<div class="impact"><textarea name="texte" id="texte"></textarea></div><br>
	</div>

	<input type="hidden" name="id" id="id" value="<?php echo $_smarty_tpl->tpl_vars['idGET']->value;?>
" ></textarea>
	
	<div class="form-action">
	
		<input type="submit" name ="Soumettre" value="Soumettreanonyme" class="btn btn-large btn-primary" />
	</div>
	
	
</form>
<?php }?><?php }} ?>
