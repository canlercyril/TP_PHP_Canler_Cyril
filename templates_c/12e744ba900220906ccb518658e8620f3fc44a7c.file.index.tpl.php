<?php /* Smarty version Smarty-3.1.15, created on 2014-01-02 08:25:33
         compiled from "template/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210947905852c1ed9876ea40-39926309%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12e744ba900220906ccb518658e8620f3fc44a7c' => 
    array (
      0 => 'template/index.tpl',
      1 => 1388669130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210947905852c1ed9876ea40-39926309',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_52c1ed987ddf95_96912129',
  'variables' => 
  array (
    'recherche' => 0,
    'totalarticle' => 0,
    'data_tab' => 0,
    'data' => 0,
    'identification' => 0,
    'nbTotalDePage' => 0,
    'foo' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c1ed987ddf95_96912129')) {function content_52c1ed987ddf95_96912129($_smarty_tpl) {?>﻿<?php if (isset($_smarty_tpl->tpl_vars['recherche']->value)) {?>
<hr>
Votre recherche est : <b> <?php echo $_smarty_tpl->tpl_vars['recherche']->value;?>
 </b><br /><br />
<?php }?>



<?php if (isset($_smarty_tpl->tpl_vars['totalarticle']->value)) {?>
<?php if ($_smarty_tpl->tpl_vars['totalarticle']->value==0) {?>
Aucun résultat ne correspond à votre recherche<br /><hr>
<?php } elseif ($_smarty_tpl->tpl_vars['totalarticle']->value==1) {?>
<b>un</b> seul résultat correspond à votre recherche</b><hr>
<?php } else { ?>
<b><?php echo $_smarty_tpl->tpl_vars['totalarticle']->value;?>
</b> résultats correspondent à votre recherche<br /><hr>
<?php }?>
<?php }?>


<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
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

<?php if ($_smarty_tpl->tpl_vars['identification']->value==true) {?>
<div align="right"><a class="btn btn-success " href="article.php?id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">Editer</a>
&nbsp; &nbsp;
<a class="btn btn-danger " href="supprimer.php?id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">Supprimer</a>
&nbsp; &nbsp;
</div>
<?php }?>
&nbsp;&nbsp;
<br /><a class="btn btn-danger " href="commentaire.php?id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">Commentaires</a><br />

<hr> 




<?php } ?>


<?php if (isset($_smarty_tpl->tpl_vars['recherche']->value)) {?>
<?php if ($_smarty_tpl->tpl_vars['totalarticle']->value!=0) {?>
Page n° 
<?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['nbTotalDePage']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbTotalDePage']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
<a href="index.php?recherche=<?php echo $_smarty_tpl->tpl_vars['recherche']->value;?>
&page=<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a>
<?php }} ?>
<?php }?>

<?php } elseif ($_smarty_tpl->tpl_vars['page']->value==0) {?>
Page n° 
<?php $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['foo']->step = 1;$_smarty_tpl->tpl_vars['foo']->total = (int) ceil(($_smarty_tpl->tpl_vars['foo']->step > 0 ? $_smarty_tpl->tpl_vars['nbTotalDePage']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbTotalDePage']->value)+1)/abs($_smarty_tpl->tpl_vars['foo']->step));
if ($_smarty_tpl->tpl_vars['foo']->total > 0) {
for ($_smarty_tpl->tpl_vars['foo']->value = 1, $_smarty_tpl->tpl_vars['foo']->iteration = 1;$_smarty_tpl->tpl_vars['foo']->iteration <= $_smarty_tpl->tpl_vars['foo']->total;$_smarty_tpl->tpl_vars['foo']->value += $_smarty_tpl->tpl_vars['foo']->step, $_smarty_tpl->tpl_vars['foo']->iteration++) {
$_smarty_tpl->tpl_vars['foo']->first = $_smarty_tpl->tpl_vars['foo']->iteration == 1;$_smarty_tpl->tpl_vars['foo']->last = $_smarty_tpl->tpl_vars['foo']->iteration == $_smarty_tpl->tpl_vars['foo']->total;?>
<a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value;?>
</a>
<?php }} ?>
<?php }?><?php }} ?>
