<?php
header("Content-Type: text/html; charset=UTF-8");
require_once('func.php');

if (isset($_POST['submit'])) { // 監視URL登録ボタンが押された時

    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $url = htmlspecialchars($_POST['url'], ENT_QUOTES);

    $output_form = false;

    if (empty($title) && !isUrl($url)) {
        echo ' タイトルとURLを確認して下さい<br>';
        $output_form = true;
    }

    if (empty($title) && isUrl($url)) {
        echo ' タイトルを確認して下さい<br>';
        $output_form = true;
    }

    if (!empty($title) && !isUrl($url)) {
        echo ' URLを確認して下さい<br>';
        $output_form = true;
    }
} else { // 初回表示
    $output_form = true;
}

if (!empty($title) && isUrl($url)) {

    $hash = hash_file('md5', $url);

    $db = getDb();

    $stmt = $db->prepare('INSERT INTO tb_crawling_url (title, url, hash) values(:title, :url, :hash)');
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);
    $stmt->bindValue(':hash', $hash, PDO::PARAM_STR);

    $stmt->execute();

    echo 'タイトル：' . $title . '<br>';
    echo 'URL：' . $url . '<br>';
    echo 'を登録しました' . '<br>';
    echo '<a href="menu.php">メニュー画面へ</a>';
}

if ($output_form) {
    ?>
    <h1>監視URL登録</h1>
    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        タイトル：<input type="text" name="title"/><br>
        URL：<input type="text" name="url"/><br>
        <input type="submit" name="submit" value="監視URL登録"/>
    </form>
    <a href="menu.php">メニュー画面へ</a>
    <?php
}
?>
