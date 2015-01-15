-- 文字コードを指定して、データベース作成
CREATE DATABASE db_watching_web_site CHARACTER SET utf8;

-- 使用するデータベースを選択
USE db_watching_web_site;

-- 改ざん検知対象URLを格納するテーブル
CREATE TABLE tb_crawling_url(
    id      INT AUTO_INCREMENT,
    title   VARCHAR(100) NOT NULL,
    url     VARCHAR(255) NOT NULL,
    hash    CHAR(32) NOT NULL,-- ハッシュアルゴリズムがMD5のため
    PRIMARY KEY (id))-- 主キーの設定
    ENGINE=InnoDB;-- ストレージエンジンの設定

-- 改ざん検知時に通知するメールアドレスを格納するテーブル
CREATE TABLE tb_send_mail(
    id      INT AUTO_INCREMENT,
    name    VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    PRIMARY KEY (id))-- 主キーの設定
    ENGINE=InnoDB;-- ストレージエンジンの設定

-- 確認用に表示
SHOW TABLES;
SHOW COLUMNS FROM tb_send_mail;
SHOW COLUMNS FROM tb_crawling_url;
