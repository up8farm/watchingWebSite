<?php
/**
 * JavaScriptのalertを呼び出す
 * @param string $massage 表示するメッセージ
 */hh
function callAlert($massage) {
    echo '<script type="text/javascript">';
    echo 'alert("' . $massage . '")';
    echo '</script>';
}

callAlert("222")
?>
