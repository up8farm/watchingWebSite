<?php
    require_once('connectDb.php');

    if(isset($_POST['submit'])){//メールアドレス登録ボタンが押されたら
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES)
        $url = htmlspecialchars($_POST['url'], ENT_QUOTES)
        $hash = hash_file('md5', $url);
  
        $db = getDb();

        $stmt = $db->prepare('INSERT INTO tb_crawling_url (title, url, hash) values(:title, :url, :hash)');
        $stmt->bindValue(':title', $title ,PDO::PARAM_STR);
        $stmt->bindValue(':url', $url ,PDO::PARAM_STR);
        $stmt->bindValue(':hash', $hash ,PDO::PARAM_STR);

        $stmt->execute();
    }

    /**
     * URLとして正しいか判定
     * @param string $url チェックするメールアドレス
     * @return boolean 正しければtrueを返す
     */
    function isUrl($text) {
        if (preg_match("/^http(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/", $text)) {
            return true;
        } else {
            return false;
        }
    }
?>

<p>クローリングURL登録</p>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
    タイトル：<input type="text" name="title"/><br>
    URL：<input type="text" name="url"/><br>
    <input type="submit" name="submit" value="クローリングURL登録"/>
</form>
