<?php /* Smarty version 3.1.27, created on 2015-12-07 17:37:06
         compiled from "/vagrant/schedule/application/views/templates/event.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1686868741566545326d7164_67521306%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2df288d5ac930a9b63f2a35637e6ddb786d8dad6' => 
    array (
      0 => '/vagrant/schedule/application/views/templates/event.tpl',
      1 => 1449476747,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1686868741566545326d7164_67521306',
  'variables' => 
  array (
    'arrEvent' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56654532aab6a5_55955227',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56654532aab6a5_55955227')) {
function content_56654532aab6a5_55955227 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1686868741566545326d7164_67521306';
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1024">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
        <?php echo '<script'; ?>
 type="text/javascript">
        function lfDeleteEvent(eventId) {
            if (window.confirm('削除しますがよろしいですか？')) {
                document.deleteEvent.eventId.value = eventId;
                document.deleteEvent.submit();
            }
        }
        <?php echo '</script'; ?>
>
    </head>
    <body>
        <div id="container">
            <?php if (count($_smarty_tpl->tpl_vars['arrEvent']->value) > 0) {?>
                <p>確認するイベントを選択してください。</p>
                <table class="event" summary="登録イベント">
                    <col width="15%" />
                    <col width="20%" />
                    <col width="30%" />
                    <col width="10%" />
                    <col width="15%" />
                    <col width="10%" />
                    <tr>
                        <th class="alignC">イベント日時</th>
                        <th class="alignC">イベント名</th>
                        <th class="alignC">管理者メールアドレス</th>
                        <th class="alignC">出欠</th>
                        <th class="alignC">メンバー確認</th>
                        <th class="alignC">削除</th>
                    </tr>
                    <form action="/event" name="deleteEvent" method="post">
                        <input type="hidden" name="mode" value="delete">
                        <input type="hidden" name="eventId" value="">

                        <?php
$_from = $_smarty_tpl->tpl_vars['arrEvent']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["event"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["event"]->_loop = false;
$_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["key"]->value => $_smarty_tpl->tpl_vars["event"]->value) {
$_smarty_tpl->tpl_vars["event"]->_loop = true;
$foreach_event_Sav = $_smarty_tpl->tpl_vars["event"];
?>
                            <tr>
                                <td class="alignC"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['event']->value['event_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td class="alignC"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['event']->value['event_title'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td class="alignC"><a href="mailto:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['event']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['event']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</a></td>
                                <td class="alignC"><a href="/join?e_id=<?php echo $_smarty_tpl->tpl_vars['event']->value['event_id'];?>
"><button type="button" class="detail">出欠</button></a></td
                                >
                                <td class="alignC"><a href="/detail?id=<?php echo $_smarty_tpl->tpl_vars['event']->value['event_id'];?>
"><button type="button" class="detail">確認</button></a></td>
                                    <td class="alignC"><button type="button" class="detail" onclick="lfDeleteEvent(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['event']->value['event_id'], ENT_QUOTES, 'UTF-8', true);?>
);">削除</button></td>
                            </tr>
                        <?php
$_smarty_tpl->tpl_vars["event"] = $foreach_event_Sav;
}
?>
                    </form>
                </table>
            <?php } else { ?>
                <p>現在登録されているイベントはありません。</p>
            <?php }?>
            <a href="/top"><button class="marT20 top">TOPへ</button></a>
        </div>
    </body>
</html>
<?php }
}
?>