<?php
header("Content-Type: text/html; charset=UTF-8");
require_once('func.php');

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES);

    if (empty($mail) && empty($name)) {
        echo ' 名前とアドレスを入力して下さい<br>';
        $output_form = true;
    }
    
    if (!empty($mail) && empty($name)) {
        echo ' 名前を入力して下さい<br>';
        $output_form = true;
    }
    
    if (empty($mail) && !empty($name)) {
        echo ' アドレスを入力して下さい<br>';
        $output_form = true;
    }
    
} else {
    $output_form = true;
}

if (!empty($mail) && !empty($name)) {
    $db = getDb();

    //tb_send_mailテーブルにフォームから入力された名前とメールアドレスを挿入する
    $stmt = $db->prepare('INSERT INTO tb_send_mail (name, mail) values(:name, :mail)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);

    $stmt->execute();
    echo $mail . $name . "を登録しました" . "<br>";
    echo '<a href="menu.php">メニュー画面へ</a>';
}

if ($output_form) {
    ?>
    <p>通知メールアドレス登録</p>
    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        名前：<input type="text" name="name"/><br>
        メール：<input type="text" name="mail"/><br>
        <input type="submit" name="submit" value="メールアドレス登録"/>
    </form>
    <a href="menu.php">メニュー画面へ</a>
    <?php
}
?>
