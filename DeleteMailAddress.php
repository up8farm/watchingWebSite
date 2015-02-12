<h1>通知メールアドレス削除</h1>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">

    <?php
    header("Content-Type: text/html; charset=UTF-8");
    require_once('func.php');

    $db = getDb();

    if (isset($_POST['submit'])) { // 通知メールアドレス削除ボタンが押された時
    
        // チェックが付けられた通知メールアドレスを削除
        foreach ($_POST['todelete'] as $delete_id) {
            $db->query("DELETE FROM tb_send_mail WHERE id = $delete_id");
        }
    }

    // 通知メールアドレス一覧を取得
    $stmt = $db->query('SELECT id, name, mail FROM tb_send_mail');
    
    // 通知メールアドレス一覧を表示
    foreach ($stmt as $row) {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]">';
        echo $row['name'] . " : ";
        echo $row['mail'];
        echo '<br>';
    }
    ?>

    <input type="submit" name="submit" value="通知メールアドレス削除">
</form>
<a href="menu.php">メニュー画面へ</a>
