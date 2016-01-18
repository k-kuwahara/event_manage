<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--{include file="./header.tpl" }-->
        <div id="containerId">
            <!--{if $eventMembers|@count > 0}-->
                <p>現在の回答：　<!--{$eventMembers|@count|escape}-->人</p>

                <div id="wrapper">
                    <div class="container">
                        <div class="table-responsive">
                            <table summary="参加者出欠" class="table table-bordered">
                                <tr>
                                    <td class="alignC first">名前</td>
                                    <!--{foreach from=$eventMembers item="member" key="key"}-->
                                        <td class="alignC"><!--{$member.name|escape}--></td>
                                    <!--{/foreach}-->
                                </tr>
                                <tr>
                                    <td class="alignC first">出欠</td>
                                    <!--{foreach from=$eventMembers item="member" key="key"}-->
                                        <td class="alignC"><!--{$member.answer|escape}--></td>
                                    <!--{/foreach}-->
                                </tr>
                                <tr>
                                    <td class="alignC first">備考</td>
                                    <!--{foreach from=$eventMembers item="member" key="key"}-->
                                        <td class="alignC"><!--{$member.memo|escape}--></td>
                                    <!--{/foreach}-->
                                </tr>
                                <tr>
                                    <td class="alignC first">変更</td>
                                    <!--{foreach from=$eventMembers item="member" key="key"}-->
                                        <td class="alignC">
                                            <a href="/join?e_id=<!--{$member.event_id|escape}-->&a_id=<!--{$member.answer_id|escape}-->"><button class="change">変更</button></a>
                                        </td>
                                    <!--{/foreach}-->
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            <!--{else}-->
                <p class="alignC">現在回答者はいません。</p>
            <!--{/if}-->
            <div class="btnWrap">
                <a href="/events"><button type="button" class="marT20 marR20 top">一覧へ戻る</button></a>
                <a href="/top"><button class="marT20 top">TOPへ</button></a>
            </div>
        </div>
    </body>
</html>
