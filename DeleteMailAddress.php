<p>通知メールアドレス削除</p>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <?php
    header("Content-Type: text/html; charset=UTF-8");
    require_once('func.php');

    $db = getDb();

    if (isset($_POST['submit'])) {
    //削除するクエリ

        echo '削除しました';
    }

    //一覧を表示
    $stmt = $db->query('SELECT id, name, mail FROM tb_send_mail');

    foreach ($stmt as $row) {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]">';
        echo $row['name'];
        echo $row['mail'];
        echo '<br>';
    }
    ?>

    <input type="submit" name="submit" value="通知メールアドレス削除">
</form>
<a href="menu.php">メニュー画面へ</a>
