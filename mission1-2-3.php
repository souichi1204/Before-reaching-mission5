<?php

$hensu="Hello,world";
$filename="mission_1-2.txt";
//ファイルを開いて文字追加
$fp=fopen($filename ,"a");
fwrite($fp,$hensu );
fclose( $fp );


?>