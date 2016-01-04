<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
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
             <form action="/join" name="updateJoin" method="post">
                <input type="hidden" name="aId" value="<!--{$aId}-->">
                <input type="hidden" name="eId" value="<!--{$eId}-->">
                <p>イベント名：　<!--{$eventInfo.event_title|escape}--></p>

                <p>参加者名を入力して下さい。<span class="attention"></span></p>
                <!--{if $arrErr.joinName}--><span class="attention"><!--{$arrErr.joinName}--></span><!--{/if}-->
                <input type="text" name="joinName" maxlength="50" value="<!--{$forms.joinName|default:''|escape}-->" placeholder="桑原（ニックネーム可）" />

                <p>メールアドレスを入力して下さい。<span class="attention">（必須）</span></p>
                <!--{if $arrErr.joinEmail}--><span class="attention"><!--{$arrErr.joinEmail}--></span><!--{/if}-->
                <input type="text" name="joinEmail" maxlength="50" size="20" value="<!--{$forms.joinEmail|default:''|escape}-->" placeholder="hogehoge@lepra.jp" />

                <p>出席 / 欠席 / 保留 を選択してください。<span class="attention">（必須）</span></p>
                <!--{if $arrErr.joinResult}--><span class="attention"><!--{$arrErr.joinResult}--></span><!--{/if}-->
                <div class="marB30">
                    <ul class="selectJoin marLm40">
                        <li>
                            <input type="radio" name="joinResult" id="select1" value="1" <!--{if $forms.joinResult == 1}-->checked = "" <!--{/if}--> />
                            <label for="select1">出席</label>
                        </li>
                        <li>
                            <input type="radio" name="joinResult" id="select2" value="2" <!--{if $forms.joinResult == 2}-->checked = "" <!--{/if}--> />
                            <label for="select2">欠席</label>
                        </li>
                        <li>
                            <input type="radio" name="joinResult" id="select3" value="3" <!--{if $forms.joinResult == 3}-->checked = "" <!--{/if}--> />
                            <label for="select3">保留</label>
                        </li>
                    </ul>
                </div><br>

                <p class="marT30">メモ</p>
                <textarea name="joinMemo" cols="70" rows="8" placeholder="何か伝えることがありました記入してください。"><!--{$forms.joinMemo|default:''|escape}--></textarea>


                <div class="btnSubmit">
                    <a href="/events"><button type="button" class="marT20 top">一覧へ戻る</button></a>
                    <input type="submit" id="eventSubmit" class="marT20" value="登録する！">
                </div>
            </form>
        </div>
    </body>
</html>
