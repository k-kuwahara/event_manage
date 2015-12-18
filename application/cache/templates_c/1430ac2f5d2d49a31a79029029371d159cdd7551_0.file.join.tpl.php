<?php /* Smarty version 3.1.27, created on 2015-12-14 18:34:30
         compiled from "/vagrant/schedule/application/views/templates/join.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1655551803566e8d26663e76_59187642%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1430ac2f5d2d49a31a79029029371d159cdd7551' => 
    array (
      0 => '/vagrant/schedule/application/views/templates/join.tpl',
      1 => 1450086202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1655551803566e8d26663e76_59187642',
  'variables' => 
  array (
    'aId' => 0,
    'eId' => 0,
    'eventInfo' => 0,
    'arrErr' => 0,
    'forms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566e8d26a8ded1_21954621',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566e8d26a8ded1_21954621')) {
function content_566e8d26a8ded1_21954621 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1655551803566e8d26663e76_59187642';
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
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
             <form action="/join" name="updateJoin" method="post">
                <input type="hidden" name="aId" value="<?php echo $_smarty_tpl->tpl_vars['aId']->value;?>
">
                <input type="hidden" name="eId" value="<?php echo $_smarty_tpl->tpl_vars['eId']->value;?>
">
                <p>イベント名：　<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['eventInfo']->value['event_title'], ENT_QUOTES, 'UTF-8', true);?>
</p>

                <p>参加者名を入力して下さい。<span class="attention"></span></p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['joinName']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['joinName'];?>
</span><?php }?>
                <input type="text" name="joinName" maxlength="50" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['joinName'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="桑原（ニックネーム可）" />

                <p>メールアドレスを入力して下さい。<span class="attention">（必須）</span></p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['joinEmail']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['joinEmail'];?>
</span><?php }?>
                <input type="text" name="joinEmail" maxlength="50" size="20" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['joinEmail'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" placeholder="hogehoge@lepra.jp" />

                <p>出席 / 欠席 / 保留 を選択してください。<span class="attention">（必須）</span></p>
                <?php if ($_smarty_tpl->tpl_vars['arrErr']->value['joinResult']) {?><span class="attention"><?php echo $_smarty_tpl->tpl_vars['arrErr']->value['joinResult'];?>
</span><?php }?>
                <div class="marB30">
                    <ul class="selectJoin marLm40">
                        <li>
                            <input type="radio" name="joinResult" id="select1" value="1" <?php if ($_smarty_tpl->tpl_vars['forms']->value['joinResult'] == 1) {?>checked = "" <?php }?> />
                            <label for="select1">出席</label>
                        </li>
                        <li>
                            <input type="radio" name="joinResult" id="select2" value="2" <?php if ($_smarty_tpl->tpl_vars['forms']->value['joinResult'] == 2) {?>checked = "" <?php }?> />
                            <label for="select2">欠席</label>
                        </li>
                        <li>
                            <input type="radio" name="joinResult" id="select3" value="3" <?php if ($_smarty_tpl->tpl_vars['forms']->value['joinResult'] == 3) {?>checked = "" <?php }?> />
                            <label for="select3">保留</label>
                        </li>
                    </ul>
                </div><br>

                <p class="marT30">メモ</p>
                <textarea name="joinMemo" cols="70" rows="8" placeholder="何か伝えることがありました記入してください。"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['forms']->value['joinMemo'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</textarea>


                <div class="btnSubmit">
                    <a href="/event"><button type="button" class="marT20 top">一覧へ戻る</button></a>
                    <input type="submit" id="eventSubmit" class="marT20" value="登録する！">
                </div>
            </form>
        </div>
    </body>
</html>
<?php }
}
?>