<?php
    require_once('func.php');

    if (isset($_POST['submit'])
        and isset($_POST['name'])
        and isset($_POST['address'])){//メールアドレス登録ボタンが押されたら
        
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $address = htmlspecialchars($_POST['address'], ENT_QUOTES);
        
        $db = getDb();
        
        //tb_send_mailテーブルにフォームから入力された名前とメールアドレスを挿入する
        $stmt = $db->prepare('INSERT INTO tb_send_mail (name, address) values(:name, :address)');
        $stmt->bindValue(':name', $name ,PDO::PARAM_STR);
        $stmt->bindValue(':address', $address ,PDO::PARAM_STR);

        $stmt->execute();
    }
    if (!isset($_POST['name']){
        callAlert('名前を入力してください');
    }
?>

<p>通知メールアドレス登録</p>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
    名前：<input type="text" name="name"/><br>
    メール：<input type="text" name="address"/><br>
    <input type="submit" name="submit" value="メールアドレス登録"/>
</form>
