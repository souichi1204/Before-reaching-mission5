<?php
$filename="mission_1-2.txt";
//�ǂݍ��݃��[�h��filename�ɑ������Ă�����̂��J��
$fp=fopen($filename,"r");

//fgets()��p���āA�s�P�ʂœǂݍ���
$line=fgets($fp);

//�\��
echo $line;

//�t�@�C�������
fclose($fp);

?>