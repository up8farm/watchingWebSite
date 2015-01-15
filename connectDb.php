<?php
/**
 * データベースをPDO接続で取得する
 * @return PDO $db
 */
function getDb() {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=db_watching_web_site;charset=utf8;';
    $user = 'root';
    $pass = 'password';

    try {
        $db = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
    return $db;
}
