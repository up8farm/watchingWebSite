<h1>監視URL削除</h1>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <?php
    header("Content-Type: text/html; charset=UTF-8");
    require_once('func.php');

    $db = getDb();

    if (isset($_POST['submit'])) { // 監視URL削除ボタンが押された時
        
        //　チェックが付けられた監視URLを削除
        foreach ($_POST['todelete'] as $delete_id) {
            $db->query("DELETE FROM tb_crawling_url WHERE id = $delete_id");
        }
    }

    // 監視URL一覧を取得
    $stmt = $db->query('SELECT id, title, url, hash FROM tb_crawling_url');

　　// 監視URL一覧を表示
    foreach ($stmt as $row) {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]">';
        echo $row['title'] . " : ";
        echo $row['url'] . " : ";
        echo $row['hash'];
        echo '<br>';
    }
    ?>

    <input type="submit" name="submit" value="監視URL削除">
</form>
<a href="menu.php">メニュー画面へ</a>
