<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/js/jquery.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css">
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
        <header>
            <nav class="navbar navbar-default">
                <div class="container">
                    <a class="navbar-brand" href="#">Brand</a>
                    <ul class="nav navbar-nav">
                        <li><a href="/top">TOP</a></li>
                        <li class="active"><a href="/select">新規登録</a></li>
                        <li><a href="/events">出欠の確認</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <div id="containerId">
            <form action="/select" name="selectEvent" method="post">
                <div class="form-group">
                    <label for="eventTitle">イベントのタイトルを入力してください。</label><span class="attention">（必須）</span>
                    <!--{if $arrErr.eventTitle}--><span class="attention"><!--{$arrErr.eventTitle}--></span><!--{/if}-->
                    <input type="text" name="eventTitle" maxlength="50" class="form-control" id="eventTitle" value="<!--{$forms.eventTitle|default:''|escape}-->" placeholder="根本会" />
                </div>

                <div class="form-group">
                    <label for="adminEmail">メールアドレスを入力して下さい。</label><span class="attention">（必須）</span>
                    <!--{if $arrErr.adminEmail}--><span class="attention"><!--{$arrErr.adminEmail}--></span><!--{/if}-->
                    <input type="text" name="adminEmail" maxlength="50" class="form-control" id="adminEmail" value="<!--{$forms.adminEmail|default:''|escape}-->" placeholder="hogehoge@lepra.jp" />
                    <span id="helpBlock" class="help-block">※イベントの管理者として登録するものとなります。</span>
                </div>

                <div class="form-group">
                    <label for="eventDate">イベントの日付を選択してください。</label><span class="attention">（必須）</span>
                    <!--{if $arrErr.eventDate}--><span class="attention"><!--{$arrErr.eventDate}--></span><!--{/if}-->
                    <input type="text" name="eventDate" id="datetimepicker" class="form-control" id="eventDate" value="<!--{$forms.eventDate|default:''|escape}-->" placeholder="2015/12/18 19:30" />
                </div>

                <p></p>
                <a href="/top"><button type="button" class="marT20 top">TOPへ</button></a>
                <input type="submit" id="eventSubmit" class="marT20" value="登録する！">
            </form>
        </div>
    </body>
</html>
