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
            <nav class="navbar navbar-default">
                <div class="container">
                    <a class="navbar-brand" href="#">Brand</a>
                    <ul class="nav navbar-nav">
                        <li><a href="/top">TOP</a></li>
                        <li><a href="/select">新規登録</a></li>
                        <li><a href="/events">出欠の確認</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <div id="container">
            <h3>登録が完了しました。</h3>
            <a href="/top"><button class="marA20 top">TOPへ</button></a>
            <a href="/detail?id=<!--{$eId|escape}-->"><button class="marA20 event">イベントへ</button></a>
        </div>
    </body>
</html>
