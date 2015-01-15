<?php

/**
 * データベースをPDO接続で取得する
 * @return PDO $db
 */
function getDb() {
    $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=db_watching_web_site;charset=utf8;';
    $user = 'root';
    $pass = '1qazxsw2';
    try {
        $db = new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
    return $db;
}

/**
 * URLとして正しいか判定
 * @param string $url チェックするメールアドレス
 * @return boolean 正しければtrueを返す
 */
    function isUrl($url) {
        if (preg_match("/^http(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/", $url)) {
            return true;
        } else {
            return false;
        }
    }

/**
 * メールアドレスとして正しいか判定
 * @param string $mail チェックするメールアドレス
 * @return boolean 正しければtrueを返す
 */
    function isMail($mail) {
      if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)) {
        return true;
      } else {
        return false;
      }
    }
