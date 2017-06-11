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
                            <li class="default"><a href="/create">新規登録</a></li>
                            <li class="default"><a href="/events">イベント一覧</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
             <form action="/join" name="update_join" method="post">
                <input type="hidden" name="a_id" value="<?= $a_id ?>">
                <input type="hidden" name="e_id" value="<?= $e_id ?>">

                <p class="lead">イベント名：　<?= $event_info['event_title'] ?></p>
                <div class="form-group">

                    <label for="join_name">参加者名を入力して下さい。</label><span class="attention">（必須）</span>
                    <?php if (isset($errors['join_name'])): ?><span class="attention"><?= $errors['join_name'] ?></span><?php endif; ?>
                    <input type="text" name="join_name" maxlength="50" class="form-control" id="join_name" value="<?php if (isset($forms['join_name'])): ?><?= $forms['join_name'] ?><?php endif; ?>" placeholder="桑原（ニックネーム可）" />
                </div>

                <div class="form-group">
                    <label for="join_email">メールアドレスを入力して下さい。</label><span class="attention">（必須）</span>
                    <?php if (isset($errors['join_email'])): ?><span class="attention"><?= $errors['join_email'] ?></span><?php endif; ?>
                    <input type="text" name="join_email" maxlength="50" class="form-control" id="join_email" size="20" value="<?php if (isset($forms['join_email'])): ?><?= $forms['join_email'] ?><?php endif; ?>" placeholder="hogehoge@lepra.jp" />
                </div>

                <div class="form-group">
                    <p>出席 / 欠席 / 保留 を選択してください。<span class="attention">（必須）</span></p>
                    <?php if (isset($errors->join_result)): ?><span class="attention"><?= $errors->join_result ?></span><?php endif; ?>
                    <div class="marB95">
                        <ul class="select-join">
                            <li>
                                <input type="radio" name="join_result" id="select1" class="form-control" value="1" <?php if ($forms['join_result'] == 1): ?>checked = "" <?php endif; ?> />
                                <label for="select1">出席</label></li>
                            </li>
                            <li>
                                <input type="radio" name="join_result" id="select2" class="form-control" value="2" <?php if ($forms['join_result'] == 2): ?>checked = "" <?php endif; ?> />
                                <label for="select2">欠席</label>
                            </li>
                            <li>
                                <input type="radio" name="join_result" id="select3" class="form-control" value="3" <?php if ($forms['join_result'] == 3): ?>checked = "" <?php endif; ?> />
                                <label for="select3">保留</label>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label for="join_memo">メモ</label>
                    <textarea name="join_memo" cols="70" rows="8" class="form-control" id="join_memo" placeholder="何か伝えることがありました記入してください。"><?php if (isset($forms['join_memo'])): ?><?= $forms->join_memo ?><?php endif; ?></textarea>
                </div>

                    <div class="btn-submit">
                        <a href="/events"><button type="button" class="marR20 top">一覧へ戻る</button></a>
                        <input type="submit" id="event-submit" class="marT20 marB30" value="登録する！">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>