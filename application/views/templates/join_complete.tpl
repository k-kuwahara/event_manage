<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>レプラホーン調整さん</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link rel="stylesheet" href="/css/top.css" />
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
                            <li><a href="/events">出欠の確認</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <h3>登録が完了しました。</h3>
            <a href="/top"><button class="top">TOPへ</button></a>
            <a href="/detail?id=<!--{$eId|escape}-->"><button class="marA20 event">イベントへ</button></a>
        </div>
        <!--{include file="./footer.tpl"}-->
    </body>
</html>
