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
                            <li class="default"><a href="/top">TOP</a></li>
                            <li class="active"><a href="/create">新規登録</a></li>
                            <li class="default"><a href="/events">イベント一覧</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <form action="/create" name="selectEvent" method="post">
                <div class="form-group">
                    <label for="event_title">イベントのタイトルを入力してください。</label><span class="attention">（必須）</span>
                    <!--{if $errors.event_title}--><span class="attention"><!--{$errors.event_title}--></span><!--{/if}-->
                    <input type="text" name="event_title" maxlength="50" class="form-control" id="event_title" value="<!--{$forms.event_title|default:''|escape}-->" placeholder="根本会" />
                </div>

                <div class="form-group">
                    <label for="admin_email">メールアドレスを入力して下さい。</label><span class="attention">（必須）</span>
                    <!--{if $errors.admin_email}--><span class="attention"><!--{$errors.admin_email}--></span><!--{/if}-->
                    <input type="text" name="admin_email" maxlength="50" class="form-control" id="admin_email" value="<!--{$forms.admin_email|default:''|escape}-->" placeholder="hogehoge@lepra.jp" />
                    <span id="helpBlock" class="help-block">※イベントの管理者として登録するものとなります。</span>
                </div>

                <div class="form-group">
                    <label for="event_date">イベントの日付を選択してください。</label><span class="attention">（必須）</span>
                    <!--{if $errors.event_date}--><span class="attention"><!--{$errors.event_date}--></span><!--{/if}-->
                    <input type="text" name="event_date" id="datetimepicker" class="form-control" id="event_date" value="<!--{$forms.event_date|default:''|escape}-->" placeholder="2015/12/18 19:30" />
                </div>

                <p></p>
                <a href="/top"><button type="button" class="marR20 top">TOPへ</button></a>
                <input type="submit" id="eventSubmit" class="marT20 marB30" value="登録する！">
            </form>
        </div>
        <!--{include file="./footer.tpl"}-->
    </body>
</html>
