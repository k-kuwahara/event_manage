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
以下の環境を想定しています。

- PHP >= 7.0
- Apache or Nginx
- MySQL >= 5.6.28
- Codeigniter 4（developブランチ）
- Composer 1.0-dev
- PHPUnit 4.8.*
- ci-phpunit-test 0.10.0


## 使用方法
※composerがインストールされている前提

#### ソースのダウンロード
[こちら](https://github.com/k-kuwahara/event_manage/archive/ci4.zip)より圧縮したソースをダウンロードしてください。

#### パッケージ・ライブラリのインストール

```bash
$ composer self-update
$ composer install
```

#### データベース接続設定
`application/Config/Database.php`を編集してください。※既にDB・ユーザの作成が完了していることを前提とします。

```php
<?php
'hostname' => 'localhost',
'username' => 'hogeuser',
'password' => 'hogepass',
'database' => 'hogedb',
'dbdriver' => 'mysqli',	// 環境毎に変更してください。
```

```php
<?php
define('ENVIRONMENT', 'development');
```

の部分を変更してください。

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

※もしテスト実行速度が遅いと感じる場合は、`phpunit`のバージョンを`4.6.3`に変更してください。

## ライセンス
ライセンスは「[MIT License](https://github.com/k-kuwahara/event_manage/blob/ci4/LICENSE.md)」です。

## その他
コードレビューをいつでもお待ちしております！
