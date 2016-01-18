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
        <script type="text/javascript">
        function lfDeleteEvent(eventId) {
            if (window.confirm('削除しますがよろしいですか？')) {
                document.deleteEvent.eventId.value = eventId;
                document.deleteEvent.submit();
            }
        }
        </script>
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
                            <li class="active"><a href="/events">出欠の確認</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!--{if $arrEvent|@count > 0}-->
            <p>確認するイベントを選択してください。</p>
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-bordered" summary="登録イベント">
                        <thead>
                            <tr>
                                <th class="alignC">イベント日時</th>
                                <th class="alignC">イベント名</th>
                                <th class="alignC">管理者メールアドレス</th>
                                <th class="alignC">出欠</th>
                                <th class="alignC">メンバー確認</th>
                                <th class="alignC">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="/event" name="deleteEvent" method="post">
                                <input type="hidden" name="mode" value="delete">
                                <input type="hidden" name="eventId" value="">

                                <!--{foreach from=$arrEvent item="event" key="key"}-->
                                    <tr>
                                        <td class="alignC"><!--{$event.event_date|escape}--></td>
                                        <td class="alignC"><!--{$event.event_title|escape}--></td>
                                        <td class="alignC"><a href="mailto:<!--{$event.email|escape}-->"><!--{$event.email|escape}--></a></td>
                                        <td class="alignC"><a href="/join?e_id=<!--{$event.event_id}-->"><button type="button" class="detail">出欠</button></a></td
                                        >
                                        <td class="alignC"><a href="/detail?id=<!--{$event.event_id}-->"><button type="button" class="detail">確認</button></a></td>
                                            <td class="alignC"><button type="button" class="detail" onclick="lfDeleteEvent(<!--{$event.event_id|escape}-->);">削除</button></td>
                                    </tr>
                                <!--{/foreach}-->
                            </form>
                        </tbody>
                    </table>
                </div>
            <!--{else}-->
                <p>現在登録されているイベントはありません。</p>
            <!--{/if}-->
            <a href="/top"><button class="marT20 marB30 top">TOPへ</button></a>
        </div>
        <!--{include file="./footer.tpl"}-->
    </body>
</html>
