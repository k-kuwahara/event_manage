<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1024">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
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
        <div id="container">
            <!--{if $arrEvent|@count > 0}-->
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
                </table>
            <!--{else}-->
                <p>現在登録されているイベントはありません。</p>
            <!--{/if}-->
            <a href="/top"><button class="marT20 top">TOPへ</button></a>
        </div>
    </body>
</html>
