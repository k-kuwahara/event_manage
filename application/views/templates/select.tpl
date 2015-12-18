<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=1024">
        <title>レプラホーン調整さん</title>

        <link rel="stylesheet" type="text/css" href="/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css">
        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.datetimepicker.full.min.js"></script>
        <script>
        $(function() {
            $.datetimepicker.setLocale('ja');
            $( "#datetimepicker" ).datetimepicker({
                format: 'Y/m/d H:i',
                step: 30
            });
        });
        </script>
    </head>
    <body>
        <div id="container">
            <form action="/select" name="selectEvent" method="post">
                <p>イベントのタイトルを入力してください。<span class="attention">（必須）</span></p>
                <!--{if $arrErr.eventTitle}--><span class="attention"><!--{$arrErr.eventTitle}--></span><!--{/if}-->
                <input type="text" name="eventTitle" maxlength="50" value="<!--{$forms.eventTitle|default:''|escape}-->" placeholder="イベントタイトル" />

                <p>メールアドレスを入力して下さい。<span class="attention">（必須）</span><br />
                ※イベントの管理者として登録するものとなります。</p>
                <!--{if $arrErr.adminEmail}--><span class="attention"><!--{$arrErr.adminEmail}--></span><!--{/if}-->
                <input type="text" name="adminEmail" maxlength="50" value="<!--{$forms.adminEmail|default:''|escape}-->" placeholder="hogehoge@lepra.jp" />

                <p>イベントの日付を選択してください。<span class="attention">（必須）</span></p>
                <!--{if $arrErr.eventDate}--><span class="attention"><!--{$arrErr.eventDate}--></span><!--{/if}-->
                <input type="text" name="eventDate" id="datetimepicker" value="<!--{$forms.eventDate|default:''|escape}-->" placeholder="yyyy/mm/dd H:i" />

                <p></p>
                <a href="/top"><button type="button" class="marT20 top">TOPへ</button></a>
                <input type="submit" id="eventSubmit" class="marT20" value="登録する！">
            </form>
        </div>
    </body>
</html>
