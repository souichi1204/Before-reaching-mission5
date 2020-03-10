<?php
$filename="mission_1-2.txt";
//読み込みモードでfilenameに代入されているものを開く
$fp=fopen($filename,"r");

//fgets()を用いて、行単位で読み込む
$line=fgets($fp);

//表示
echo $line;

//ファイルを閉じる
fclose($fp);

?>