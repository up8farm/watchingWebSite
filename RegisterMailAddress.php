<?php
    require_once('connectDb.php');

    if(isset($_POST['submit'])){//メールアドレス登録ボタンが押されたら
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
        $address = htmlspecialchars($_POST['address'], ENT_QUOTES);
        
        $hoge = '<script>alert("アラート表示テスト");</script>';

        $db = getDb();
        
        //tb_send_mailテーブルにフォームから入力された名前とメールアドレスを挿入する
        $stmt = $db->prepare('INSERT INTO tb_send_mail (name, address) values(:name, :address)');
        $stmt->bindValue(':name', $name ,PDO::PARAM_STR);
        $stmt->bindValue(':address', $address ,PDO::PARAM_STR);

        $stmt->execute();
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
?>

<p>通知メールアドレス登録</p>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
    名前：<input type="text" name="name"/><br>
    メール：<input type="text" name="address"/><br>
    <input type="submit" name="submit" value="メールアドレス登録"/>
</form>
