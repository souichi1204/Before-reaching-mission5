<?php

$hensu="Hello,world";
$filename="mission_1-2.txt";
//�t�@�C�����J���ĕ����ǉ�
$fp=fopen($filename ,"a");
fwrite($fp,$hensu );
fclose( $fp );


?>