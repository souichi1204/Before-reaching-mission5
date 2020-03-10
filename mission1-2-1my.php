<?php
//自分で書いてみた
//$hensuに文字列代入
$hensu="Hello World";

//テキストファイル読み込み
$filename="mission_1-2.txt";
$fp=fopen($filename,"w");

//書き込み
fwrite( $fp, $hensu);

//閉じる
fclose($fp);

?>