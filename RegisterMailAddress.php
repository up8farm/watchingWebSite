<?php
header("Content-Type: text/html; charset=UTF-8");
require_once('func.php');

if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES);

    if (empty($address) && empty($name)) {
        echo ' 名前とアドレスを入力して下さい<br>';
        $output_form = true;
    }
    
    if (!empty($address) && empty($name)) {
        echo ' 名前を入力して下さい<br>';
        $output_form = true;
    }
    
    if (empty($address) && !empty($name)) {
        echo ' アドレスを入力して下さい<br>';
        $output_form = true;
    }
    
} else {
    $output_form = true;
}

if (!empty($address) && !empty($name)) {
    $db = getDb();

    //tb_send_mailテーブルにフォームから入力された名前とメールアドレスを挿入する
    $stmt = $db->prepare('INSERT INTO tb_send_mail (name, address) values(:name, :address)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);

    $stmt->execute();
    echo $address . $name . "を登録しました";
}

if ($output_form) {
    ?>
    <p>通知メールアドレス登録</p>
    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        名前：<input type="text" name="name"/><br>
        メール：<input type="text" name="address"/><br>
        <input type="submit" name="submit" value="メールアドレス登録"/>
    </form>
    <?php
}
?>
