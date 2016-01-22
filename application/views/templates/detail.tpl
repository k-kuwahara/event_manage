<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>調整くん</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/jquery.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Brand</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="/top">TOP</a></li>
                            <li><a href="/select">新規登録</a></li>
                            <li><a href="/events">イベント一覧</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <!--{if $eventMembers|@count > 0}-->
                <p class="lead">現在の回答：　<!--{$eventMembers|@count|escape}-->人</p>
                <div class="table-responsive">
                    <table summary="参加者出欠" class="table table-bordered">
                        <tr>
                            <td class="alignC first">名前</td>
                            <!--{foreach from=$eventMembers item="member" key="key"}-->
                                <!--{if $member.answer == "出席"}-->
                                    <td class="alignC info"><!--{$member.name|escape}--></td>
                                <!--{elseif $member.answer == "欠席"}-->
                                    <td class="alignC active"><!--{$member.name|escape}--></td>
                                <!--{else}-->
                                    <td class="alignC warning"><!--{$member.name|escape}--></td>
                                <!--{/if}-->
                            <!--{/foreach}-->
                        </tr>
                        <tr>
                            <td class="alignC first">出欠</td>
                            <!--{foreach from=$eventMembers item="member" key="key"}-->
                                <!--{if $member.answer == "出席"}-->
                                    <td class="alignC info"><!--{$member.answer|escape}--></td>
                                <!--{elseif $member.answer == "欠席"}-->
                                    <td class="alignC active"><!--{$member.answer|escape}--></td>
                                <!--{else}-->
                                    <td class="alignC warning"><!--{$member.answer|escape}--></td>
                                <!--{/if}-->
                            <!--{/foreach}-->
                        </tr>
                        <tr>
                            <td class="alignC first">備考</td>
                            <!--{foreach from=$eventMembers item="member" key="key"}-->
                                <!--{if $member.answer == "出席"}-->
                                    <td class="alignC info"><!--{$member.memo|escape}--></td>
                                <!--{elseif $member.answer == "欠席"}-->
                                    <td class="alignC active"><!--{$member.memo|escape}--></td>
                                <!--{else}-->
                                    <td class="alignC warning"><!--{$member.memo|escape}--></td>
                                <!--{/if}-->
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
            <!--{else}-->
                <p class="lead">現在回答者はいません。</p>
            <!--{/if}-->
            <a href="/events"><button type="button" class="marR20 top">一覧へ戻る</button></a>
            <a href="/top"><button class="marB30 top">TOPへ</button></a>
        </div>
        <!--{include file="./footer.tpl"}-->
    </body>
</html>
