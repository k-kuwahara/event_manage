<?php /* Smarty version 3.1.27, created on 2015-12-14 19:56:50
         compiled from "/vagrant/schedule/application/views/templates/top.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:92615021566ea0724c3390_34224554%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4c230c3f469af5ccd6cfc5cb97872265846edc6' => 
    array (
      0 => '/vagrant/schedule/application/views/templates/top.tpl',
      1 => 1450086050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92615021566ea0724c3390_34224554',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_566ea0726d1fd9_01213807',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_566ea0726d1fd9_01213807')) {
function content_566ea0726d1fd9_01213807 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '92615021566ea0724c3390_34224554';
?>
<!doctype html>
<html lang="ja">
    <!--
 _                           _
| |                         | |
| | ___ _ __  _ __ __ _  ___| |__   __ _ _   _ _ __
| |/ _ \ '_ \| '__/ _` |/ __| '_ \ / _` | | | | '_ \
| |  __/ |_) | | | (_| | (__| | | | (_| | |_| | | | |
|_|\___| .__/|_|  \__,_|\___|_| |_|\__,_|\__,_|_| |_|
       | |
       |_|

          the power of advanced technology


【レプラホーン】とはアイルランド伝承に登場する靴職人の妖精の名前です。
レプラホーン株式会社は、システム開発という【ものづくり】を事業のベースに据え、
社名の由来にかなうコンピュータシステム職人集団を目指しています。

    -->
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1024">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            <div id="container">
                <p>選択してください。</p>
                <a href="/select"><button class="marA10 register">新規登録</button></a>
                <a href="/event"><button class="marA10 event">出欠の確認</button></a>
            </div>
        <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    </body>
</html>
<?php }
}
?>