<?php /* Smarty version 3.1.27, created on 2015-12-14 17:18:12
         compiled from "/vagrant/schedule/application/views/templates/detail.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1552675302566e7b44465384_90873646%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b123822ea6bb647a37a4d41ece82c94a793c51c' => 
    array (
      0 => '/vagrant/schedule/application/views/templates/detail.tpl',
      1 => 1450080240,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1552675302566e7b44465384_90873646',
  'variables' => 
  array (
    'eventMembers' => 0,
    'member' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566e7b4482b3b2_57790837',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566e7b4482b3b2_57790837')) {
function content_566e7b4482b3b2_57790837 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1552675302566e7b44465384_90873646';
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
    </head>
    <body>
        <div id="container">
            <?php if (count($_smarty_tpl->tpl_vars['eventMembers']->value) > 0) {?>
                <p>現在の回答：　<?php echo htmlspecialchars(count($_smarty_tpl->tpl_vars['eventMembers']->value), ENT_QUOTES, 'UTF-8', true);?>
人</p>

                <div id="wrapper">
                    <table summary="参加者出欠">
                        <tr>
                            <td class="alignC first">名前</td>
                            <?php
$_from = $_smarty_tpl->tpl_vars['eventMembers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["member"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["member"]->_loop = false;
$_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["key"]->value => $_smarty_tpl->tpl_vars["member"]->value) {
$_smarty_tpl->tpl_vars["member"]->_loop = true;
$foreach_member_Sav = $_smarty_tpl->tpl_vars["member"];
?>
                                <td class="alignC"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['member']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <?php
$_smarty_tpl->tpl_vars["member"] = $foreach_member_Sav;
}
?>
                        </tr>
                        <tr>
                            <td class="alignC first">出欠</td>
                            <?php
$_from = $_smarty_tpl->tpl_vars['eventMembers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["member"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["member"]->_loop = false;
$_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["key"]->value => $_smarty_tpl->tpl_vars["member"]->value) {
$_smarty_tpl->tpl_vars["member"]->_loop = true;
$foreach_member_Sav = $_smarty_tpl->tpl_vars["member"];
?>
                                <td class="alignC"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['member']->value['answer'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <?php
$_smarty_tpl->tpl_vars["member"] = $foreach_member_Sav;
}
?>
                        </tr>
                        <tr>
                            <td class="alignC first">備考</td>
                            <?php
$_from = $_smarty_tpl->tpl_vars['eventMembers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["member"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["member"]->_loop = false;
$_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["key"]->value => $_smarty_tpl->tpl_vars["member"]->value) {
$_smarty_tpl->tpl_vars["member"]->_loop = true;
$foreach_member_Sav = $_smarty_tpl->tpl_vars["member"];
?>
                                <td class="alignC"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['member']->value['memo'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                            <?php
$_smarty_tpl->tpl_vars["member"] = $foreach_member_Sav;
}
?>
                        </tr>
                        <tr>
                            <td class="alignC first">変更</td>
                            <?php
$_from = $_smarty_tpl->tpl_vars['eventMembers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["member"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["member"]->_loop = false;
$_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["key"]->value => $_smarty_tpl->tpl_vars["member"]->value) {
$_smarty_tpl->tpl_vars["member"]->_loop = true;
$foreach_member_Sav = $_smarty_tpl->tpl_vars["member"];
?>
                                <td class="alignC">
                                    <a href="/join?e_id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['member']->value['event_id'], ENT_QUOTES, 'UTF-8', true);?>
&a_id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['member']->value['answer_id'], ENT_QUOTES, 'UTF-8', true);?>
"><button class="change">変更</button></a>
                                </td>
                            <?php
$_smarty_tpl->tpl_vars["member"] = $foreach_member_Sav;
}
?>
                        </tr>
                    </table>
                </div>
            <?php } else { ?>
                <p>現在回答者はいません。</p>
            <?php }?>
            <div class="btnWrap">
                <a href="/event"><button type="button" class="marT20 marR20 top">一覧へ戻る</button></a>
                <a href="/top"><button class="marT20 top">TOPへ</button></a>
            </div>
        </div>
    </body>
</html>
<?php }
}
?>