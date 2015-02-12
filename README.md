#このプログラムについて
登録したURLを定期的に巡回し、変更があればメールで通知します。

DeleteMailAddress.php
通知メールアドレス削除フォーム生成

DeleteUrl.php
監視URL削除フォーム生成

RegisterMailAddress.php
通知メールアドレス登録フォーム生成

RegisterUrl.php
監視URL登録フォーム生成

crawling.php
クーロンに登録し監視URLを定期的に巡回

create_db_table.sql
データベース作成用スクリプト

func.php



##動作環境

* Raspberry Pi Model B+ (Plus)
* RASPBIAN 3.12.28+
* PHP 5.4.35

##準備
    $ sudo apt-get update
    $ sudo apt-get upgrade

Apacheをインストール

    $ sudo apt-get install apache2

PHP5をインストール

    $ sudo apt-get install php5
    
PHP5のMySQLモジュールをインストール

    $ sudo apt-get install php5-mysql
    
MySQLをインストール

    $ sudo apt-get install mysql-server

ssmtpのインストール

    $ sudo install ssmtp


gmailアカウントからのメール送信設定

参考サイトURL
http://www.limemo.net/blog/2013/09/%E3%83%A9%E3%82%BA%E3%83%99%E3%83%AA%E3%83%BC%E3%83%91%E3%82%A4raspbian%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%A6%E3%81%BF%E3%82%8B-5%E5%88%86%E3%81%A7%E3%83%A1%E3%83%BC%E3%83%AB%E3%82%92%E9%80%81.html

    $ cd /etc/ssmtp
    $ mv ssmtp.conf bak_ssmtp.conf
    $ vi ssmtp.conf
    
新規ファイルに以下の内容を記入
    
    mailhub=smtp.gmail.com:587
    root=ユーザ名@gmail.com
    AuthUser=ユーザ名@gmail.com
    AuthPass=パスワード
    AuthMethod=LOGIN
    UseSTARTTLS=YES
    UseTLS=Yes

Apacheのルートディレクトリにファイルを取得

    $ cd /var/www
    $ git clone https://github.com/up8farm/watchingWebSite.git
    
データベースの作成

    $ mysql -u root -p
    
    mysql> source /var/www/watchingWebSite/create_db_table.sql
    
func.phpをエディタで開き、getDb関数の中にあるユーザ名($user)、パスワード($pass)を変更
    
    $ vi /var/www/watchingWebSite/func.php

crawling.phpをクーロンに登録し、監視間隔を設定

    $ crontab -e
    
クーロン設定例

5分毎に実行

    */5 * * * * /usr/bin/php /var/www/watchingWebSite/crawling.php

30分毎に実行

    */30 * * * * /usr/bin/php /var/www/watchingWebSite/crawling.php

ブラウザからアクセスし、通知メールアドレス、監視URLを登録

    http://IPアドレス/watchingWebSite/menu.php
