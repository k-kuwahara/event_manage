<?php /* Smarty version 3.1.27, created on 2015-12-11 17:07:44
         compiled from "/vagrant/schedule/application/views/templates/select.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1373054262566a845022b608_52358913%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '216a8ac1c537b7e118fc9a7f676ca670f1c22a5c' => 
    array (
      0 => '/vagrant/schedule/application/views/templates/select.tpl',
      1 => 1449821262,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1373054262566a845022b608_52358913',
  'variables' => 
  array (
    'arrErr' => 0,
    'forms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566a8450526255_94968467',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566a8450526255_94968467')) {
function content_566a8450526255_94968467 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1373054262566a845022b608_52358913';
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1024">
        <title>レプラホーン調整さん</title>

        <link rel="stylesheet" type="text/css" href="/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css">
        <?php echo '<script'; ?>
 src="/js/jquery.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/js/jquery.datetimepicker.full.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
        $(function() {
            $.datetimepicker.setLocale('ja');
            $( "#datetimepicker" ).datetimepicker({
                format: 'Y/m/d H:i',
                step: 30
            });
        });
        <?php echo '</script'; ?>
>
    </head>
    <body>
        <div id="container">
            <form action="/select" name="selectEvent" method="post">
                <p>イベントのタイトルを入力してください。<span class="attention">（必須）</span></p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['eventTitle']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['eventTitle'];?>
</span><?php }?>
                <input type="text" name="eventTitle" maxlength="50" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['eventTitle'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="根本会" />

                <p>メールアドレスを入力して下さい。<span class="attention">（必須）</span><br />
                ※イベントの管理者として登録するものとなります。</p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['adminEmail']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['adminEmail'];?>
</span><?php }?>
                <input type="text" name="adminEmail" maxlength="50" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['adminEmail'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="hogehoge@lepra.jp" />

                <p>イベントの日付を選択してください。<span class="attention">（必須）</span></p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['eventDate']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['eventDate'];?>
</span><?php }?>
                <input type="text" name="eventDate" id="datetimepicker" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['eventDate'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="2015/12/18 19:30" />

                <p></p>
                <a href="/top"><button type="button" class="marT20 top">TOPへ</button></a>
                <input type="submit" id="eventSubmit" class="marT20" value="登録する！">
            </form>
        </div>
    </body>
</html>
<?php }
}
?>