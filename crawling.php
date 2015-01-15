<?php
require_once('func.php');

//crontabに登録し、定期的に実行

$db = getDb();
$sql = 'SELECT id, title, url, hash FROM tb_crawling_url';
$stmt = $db->query($sql);

foreach($stmt as $row){
        $title = $row['title'];
        $url = $row['url'];
        $hash = $row['hash'];
        $id = $row['id'];

        $re_hash = hash_file('md5', $url);

        
        if($hash !== $re_hash){// 前回クローリング時からハッシュ値が変化している
           echo 'changed';
           sendMail();
           $sql ="
               UPDATE tb_crawling_url
               SET hash = '$re_hash'
               WHERE id = '$id'
           ";
                $db->query($sql);
        }
}

/**
 * tb_send_mailテーブルに登録されたアドレスへメールを送信する
 * @param string $subject メールの件名
 * @param string $msg メールの内容
 * @return
 */
function sendMail($subject, $msg) {
    mb_internal_encoding("UTF-8");
    $from = 'From:raspberrypi777@gmail.com';
    $dbh = dbConnect();
    $sql = 'SELECT address FROM tb_send_mail';
    foreach($dbh->query($sql) as $row){
        $to = $row['address'];
        mb_send_mail($to, $subject, $msg, $from);
    }
}
