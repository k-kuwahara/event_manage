## サービスの概要
これは「調整さん」を真似た__社内スケジュール管理ツール__です。  
※主に飲み会の参加者を把握するためのものです。  

__■機能仕様__

- イベントの作成
    - イベント日時の指定
    - イベントタイトルの指定
    - イベント作成者のメールアドレスの指定
- 登録済みイベント一覧表示
- イベントの出欠一覧表示
- イベントへの出欠登録
    - 回答者名の指定
    - 出席or欠席の指定
    - 備考欄
- 出欠の変更


## 開発環境
以下を想定しています。  

- PHP >= 5.4
- Apache >= 2.2
- MySQL >= 5.6.28
- Codeigniter 3.0.2
- Composer 1.0-dev
- PHPUnit 4.8.*
- ci-phpunit-test 0.10.0


## 使用方法
※composerがインストールされている前提

#### ソースのダウンロード
[こちら](https://github.com/k-kuwahara/event_manage.git)より圧縮したソースをダウンロードしてください。

#### パッケージ・ライブラリのインストール

```bash
$ composer self-update
$ composer install
```

#### Apacheの設定

```apache
# ディレクティブの追記
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteCond %{REQUEST_URI} !\.(css|pdf|png|jpe?g|gif|js|swf|txt|ico|s?html?)$
    RewriteRule ^(.*)$ /index.php/$1 [L]
</IfModule>
```

## その他
コードレビューをいつでもお待ちしております！
