## サービスの概要
これは「調整さん」を参考にした__イベント管理ツール__です。  

#### 機能仕様

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
[こちら](https://github.com/k-kuwahara/event_manage/archive/master.zip)より圧縮したソースをダウンロードしてください。

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

#### データベース接続設定
`application/config/***/database.php`を編集してください。※`development, testing, production`の三つとも編集する必要があります。主に変更するのは以下の部分です。

```php
<?php
'hostname' => 'localhost',
'username' => 'hogeuser',
'password' => 'hogepass',
'database' => 'hogedb',
'dbdriver' => 'mysql',
```

開発用(development)、テスト用(testing)、本番用(production)と分かれていますので、適宜`index.php`の`define('ENVIRONMENT', 'development');`の部分を変更してください。

#### マイグレーションの設定
`application/config/migration.php`ファイルより、マイグレーションの有効化・バージョンの設定を行ってください。

```php
<?php
$config['migration_enabled'] = TRUE;
$config['migration_version'] = 2;	// カスタマイズした際は適宜変更
```

#### マイグレーションの実行
このアプリケーションでは、マイグレーションをコマンドラインから実行するため、先にデータベースを作成してください。
作成後、以下のコマンドをコマンドラインから実行してください。

```bash
# ディレクトリ移動
$ cd APP_ROOT

# マイグレーションの実行
$ php index.php migrate current

# 以下のコマンドでも実行できます
# ※このコマンドではマイグレーションの設定は不要です
$ php index.php migrate latest
```

## テストの実行
`PHPUnit`をベースにユニットテストを行います。テスト作成には[`ci-phpunit-test`](https://github.com/kenjis/ci-phpunit-test)を利用させていただきました。
以下のコマンドを実行してください。

```bash
$ cd applications/tests/
$ ../../vendor/bin/phpunit	// --color=auto --testdox-textなどのオプションは適宜付与
```

## ライセンス
ライセンスは「[MIT License](https://github.com/k-kuwahara/event_manage/blob/master/LICENSE.md)」です。

## その他
コードレビューをいつでもお待ちしております！
