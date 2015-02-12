<?php
header("Content-Type: text/html; charset=UTF-8");
require_once('func.php');

if (isset($_POST['submit'])) { // 通知メールアドレス登録ボタンが押された時

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES);
    $output_form = false;

    if (!isMail($mail) && empty($name)) {
        echo ' 名前とメールアドレスを確認して下さい<br>';
        $output_form = true;
    }
    
    if (isMail($mail) && empty($name)) {
        echo ' 名前を確認して下さい<br>';
        $output_form = true;
    }
    
    if (!isMail($mail) && !empty($name)) {
        echo ' メールアドレスを確認して下さい<br>';
        $output_form = true;
    }
    
} else {　// 初回表示
    $output_form = true;
}

if (isMail($mail) && !empty($name)) {
    $db = getDb();

    // tb_send_mailテーブルにフォームから入力された名前とメールアドレスを挿入する
    $stmt = $db->prepare('INSERT INTO tb_send_mail (name, mail) values(:name, :mail)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);

    $stmt->execute();
    echo '名前：' . $name . '<br>';
    echo 'メール：' . $mail . '<br>';
    echo 'を登録しました' . '<br>';
    echo '<a href="menu.php">メニュー画面へ</a>';
}

if ($output_form) {
    ?>
    <h1>通知メールアドレス登録</h1>
    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        名前：<input type="text" name="name"/><br>
        メール：<input type="text" name="mail"/><br>
        <input type="submit" name="submit" value="通知メールアドレス登録"/>
    </form>
    <a href="menu.php">メニュー画面へ</a>
    <?php
}
?>
